<?php
session_start();

// Ensure config.php is loaded
$configPath = __DIR__ . '/config.php';
if (!file_exists($configPath)) {
    die('Error: Configuration file not found. Please create config.php in ' . __DIR__ . '.');
}
require_once $configPath;

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name       = trim($_POST['name'] ?? '');
    $emailRaw   = trim($_POST['email'] ?? '');
    $password   = $_POST['password'] ?? '';
    $confirm    = $_POST['confirm_password'] ?? '';

    // Validate email format strictly
    $isEmailFormatValid = preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(com|org|net|in)$/', $emailRaw);
    $hasExtraAfterDomain = preg_replace('/.*\.(com|org|net|in)/i', '', $emailRaw);
    
    if (empty($name) || empty($emailRaw) || empty($password) || empty($confirm)) {
        $error = 'All fields are required.';
    } elseif (!filter_var($emailRaw, FILTER_VALIDATE_EMAIL) || !$isEmailFormatValid || !empty($hasExtraAfterDomain)) {
        $error = 'Invalid email format. Example: user@example.com';
    } elseif ($password !== $confirm) {
        $error = 'Passwords do not match.';
    } else {
        $email = $emailRaw; // only assign after validation passes

        // Database connection
        $conn = new mysqli($servername, $db_user, $db_pass, $dbname);
        if ($conn->connect_error) {
            die('Database connection failed: ' . $conn->connect_error);
        }

        // Check if email already exists
        $stmt = $conn->prepare('SELECT id FROM users WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $error = 'Email is already registered.';
        } else {
            // Insert new user
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $ins    = $conn->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');
            $ins->bind_param('sss', $name, $email, $hashed);
            if ($ins->execute()) {
                $_SESSION['user_id'] = $ins->insert_id;
                header('Location: profile.php');
                exit;
            } else {
                $error = 'Registration error: please try again.';
            }
            $ins->close();
        }
        $stmt->close();
        $conn->close();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mechanic On Wheel - Sign Up</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/jpg" href="./web.jpg">
    <link rel="stylesheet" href="https://unpkg.com/lucide-static@0.344.0/font/lucide.css">
    <style>
        /* Sign‑up (and Login) Page — shared styles */
.login-page {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: var(--background-color);
    padding: 2rem;
}

.login-card {
    background-color: var(--card-background);
    padding: 2.5rem 2rem;
    border-radius: 1rem;
    box-shadow: 0 4px 12px rgba(0,0,0,0.5);
    max-width: 400px;
    width: 100%;
    text-align: center;
}

.login-card h2 {
    color: var(--primary-color);
    margin-bottom: 1.5rem;
    font-size: 2rem;
}

.error-message {
    background-color: var(--error-color);
    color: var(--secondary-color);
    padding: 0.75rem 1rem;
    border-radius: 5px;
    margin-bottom: 1rem;
    font-weight: bold;
}

.form-group {
    margin-bottom: 1.25rem;
    text-align: left;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: bold;
    color: var(--text-color);
}

.form-group input {
    width: 100%;
    padding: 0.75rem 1rem;
    background-color: var(--background-color);
    border: 1px solid var(--accent-color);
    border-radius: 5px;
    color: var(--text-color);
    font-size: 1rem;
    transition: border-color 0.3s;
}

.form-group input:focus {
    outline: none;
    border-color: var(--primary-color);
}

.primary-btn.full-width {
    width: 100%;
    font-size: 1rem;
    padding: 0.75rem;
    margin-top: 0.5rem;
}

.signup-prompt {
    margin-top: 1rem;
    color: var(--text-color);
    font-size: 0.9rem;
}

.signup-prompt a {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s;
}

.signup-prompt a:hover {
    color: #ffed4a;
}

    </style>
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="nav-container">
            <div class="logo">
                <i class="lucide-wrench"></i>
                <img src="logo.png" alt="Logo">
                <span>Mechanic On Wheel</span>
            </div>
            <div class="nav-links">
                <a href="index.php">Home</a>
                <a href="about.html">About</a>
                <a href="index.php#services">Services</a>
                <a href="index.php#contact">Contact</a>
                <?php if (!empty($_SESSION['user_id'])): ?>
                    <button class="text-btn" onclick="location.href='logout.php'">Logout</button>
                <?php else: ?>
                    <button class="login-btn" onclick="location.href='login.php'">Login</button>
                <?php endif; ?>
            </div>
            <button class="menu-btn" onclick="toggleMenu()">
                <i class="lucide-menu"></i>
            </button>
        </div>
    </nav>

    <!-- Signup Section -->
    <section class="login-page">
        <div class="login-card">
            <h2>Create Your Account</h2>

            <?php if ($error): ?>
                <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <form action="signup.php" method="POST">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>" placeholder="John Doe" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" placeholder="you@example.com" required>
                    <span id="emailError" style="color:red; font-size: 0.9em;"></span>

                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter a password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Repeat your password" required>
                </div>
                <button type="submit" class="primary-btn full-width">Sign Up</button>
            </form>
            <p class="signup-prompt">Already have an account? <a href="login.php" class="text-btn">Login</a></p>
        </div>
    </section>

    <footer>
        <div class="footer-content">
            <div class="footer-logo">
                <i class="lucide-wrench"></i>
                <span>24/7 Auto Care</span>
            </div>
            <p>&copy; 2025 24/7 Auto Care. All rights reserved.</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>
