<?php
// save_review.php

// Connect to your database
$servername = "localhost";
$username = "root";         // your database username
$password = "";             // your database password
$dbname = "mechaniconwheel_db"; // your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect and sanitize form data
    $name = trim($_POST['name']);
    $rating = (int)$_POST['rating'];
    $review = trim($_POST['review']);
    $created_at = date('Y-m-d H:i:s');

    // Basic validation
    if (empty($name) || empty($rating) || empty($review)) {
        echo "Please fill in all fields.";
        exit;
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO reviews (name, rating, review, created_at) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $name, $rating, $review, $created_at);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
