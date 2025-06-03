<!DOCTYPE html>
<html lang="en">
<?php
session_start();

// Ensure config.php is loaded from the same directory
// Ensure config.php exists
$configPath = __DIR__ . '/config.php';
if (!file_exists($configPath)) {
    die('Error: Configuration file not found. Please create a config.php in ' . __DIR__ . ' with your database settings.');
}
require_once $configPath;  // config.php defines $servername, $db_user, $db_pass, $dbname

// Initialize error message
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'] ?? '';

    if (!$email || empty($password)) {
        $error = 'Please enter both email and password.';
    } else {
        // Create database connection
        $conn = new mysqli($servername, $db_user, $db_pass, $dbname);
        if ($conn->connect_error) {
            die('Database connection failed: ' . $conn->connect_error);
        }

        // Prepare and execute statement
        $stmt = $conn->prepare('SELECT id, name, password FROM users WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows === 1) {
            $stmt->bind_result($user_id, $username, $hashed_password);
            $stmt->fetch();
            if (password_verify($password, $hashed_password)) {
                // Store both ID and username in session
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $username;
        
                header('Location: profile.php');
                exit;
            } else {
                $error = 'Incorrect email or password.';
            }
        } else {
            $error = 'Incorrect email or password.';
        }
        
        $stmt->close();
        $conn->close();
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mechanic On Wheel - Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/jpg" href="./web.jpg">
    <link rel="stylesheet" href="https://unpkg.com/lucide-static@0.344.0/font/lucide.css">
    <style>
        /* Login Page */
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
                <a href="about.php">About</a>
                <a href="index.php#services">Services</a>
                <a href="index.php#contact">Contact</a>
                <button class="primary-btn" onclick="location.href='signup.php'">Sign Up</button>

            </div>
            <button class="menu-btn" onclick="toggleMenu()">
                <i class="lucide-menu"></i>
            </button>
        </div>
    </nav>

    <!-- Login Section -->
    <section class="login-page">
        <div class="login-card">
            <h2>Login to Your Account</h2>
            <?php if ($error): ?>
                <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <form action="login.php" method="POST">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" placeholder="you@example.com" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="primary-btn full-width">Login</button>
            </form>
            <p class="signup-prompt">Don't have an account? <a href="signup.php" class="text-btn">Sign Up</a></p>
            <div class="form-footer">
               <a href="forgot-password.php" class="forgot-password-link">Forgot Password?</a>
            </div>

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
