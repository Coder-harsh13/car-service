<?php
// Start session if needed
session_start();

// Step 1: Connect to the database
$host = "localhost";
$db_user = "root";       // Change if needed
$db_pass = "";           // Change if your root user has a password
$db_name = "mechaniconwheel_db";

// Create connection
$conn = new mysqli($host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 2: Collect and sanitize form data
$name = $conn->real_escape_string($_POST['Name']);
$email = $conn->real_escape_string($_POST['Email']);
$message = $conn->real_escape_string($_POST['Message']);

// Step 3: Create table if not exists
$conn->query("
CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)
");

// Step 4: Insert data into the table
$sql = "INSERT INTO contact_messages (name, email, message)
        VALUES ('$name', '$email', '$message')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Message sent successfully!'); window.location.href = 'index.php';</script>";
} else {
    echo "Error: " . $conn->error;
}

// Step 5: Close the connection
$conn->close();
?>
