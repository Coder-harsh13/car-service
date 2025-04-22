<?php
$servername = "localhost";
$db_user = "root";        // default user for XAMPP
$db_pass = "";            // default password is empty
$dbname = "mechaniconwheel_db"; // your database name

// Create connection
$conn = new mysqli($servername, $db_user, $db_pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
