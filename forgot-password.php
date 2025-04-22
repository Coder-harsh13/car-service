<?php
// Start session and include config
session_start();
require_once 'config.php';

// Handle form submission
$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);

    if (empty($email)) {
        $message = 'Please enter your email.';
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows > 0) {
            // You should send an actual reset link via email here.
            $message = 'A password reset link has been sent to your email.';
        } else {
            $message = 'Email not found.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="forget-password.css">
    <link rel="stylesheet" href="style.css">
    <style>/* forget-password.css */

/* Dark Theme Background */
body {
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', sans-serif;
    background-color: #121212;
    color: #f0f0f0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Form Container */
.form-container {
    background-color: #1e1e1e;
    padding: 2.5rem 2rem;
    border-radius: 1rem;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
    max-width: 400px;
    width: 100%;
    text-align: center;
}

/* Heading */
.form-container h2 {
    margin-bottom: 1.5rem;
    font-size: 2rem;
    color: #ffffff;
}

/* Input Label */
form label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: bold;
    text-align: left;
    color: #dddddd;
}

/* Input Field */
form input[type="email"] {
    width: 100%;
    padding: 0.75rem 1rem;
    margin-bottom: 1.5rem;
    border-radius: 8px;
    border: 1px solid #444;
    background-color: #2a2a2a;
    color: #f0f0f0;
    font-size: 1rem;
    transition: border-color 0.3s;
}

form input[type="email"]:focus {
    outline: none;
    border-color: #e91e63;
}

/* Button */
.primary-btn {
    width: 100%;
    padding:
}
</style>


</head>
<body>
    <div class="form-container">
        <h2>Forgot Password</h2>
        <?php if ($message) echo "<p class='message'>$message</p>"; ?>
        <form method="POST" action="">
            <label for="email">Enter your email:</label>
            <input type="email" name="email" required>
            <button type="submit" class="primary-btn">Send Reset Link</button>
        </form>
        <div class="bottom-links">
            <a href="login.php" class="text-btn">Back to Login</a>
        </div>
    </div>
</body>
</html>
