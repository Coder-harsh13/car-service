<?php
// Database connection settings
$servername = "localhost";
$username = "root"; // your MySQL username
$password = "";     // your MySQL password
$database = "mechaniconwheel_db";

// Connect to MySQL
$conn = new mysqli($servername, $username, $password, $database);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect data from form
$name = $_POST['Name'];
$mobile = $_POST['Mobile'];
$carNumber = $_POST['CarNumber'];
$email = $_POST['Email'];
$latitude = $_POST['latitude'] ?? null;
$longitude = $_POST['longitude'] ?? null;

// Validate required fields
if (empty($name) || empty($mobile) || empty($carNumber) || empty($email)) {
    die("Please fill in all required fields.");
}

// Prepare SQL query
$sql = "INSERT INTO emergency_bookings (name, mobile, car_number, email, latitude, longitude)
        VALUES ('$name', '$mobile', '$carNumber', '$email', '$latitude', '$longitude')";

// Run the query
if ($conn->query($sql) === TRUE) {
    echo "Emergency booking saved successfully.Thank you! Our agent will call you shortly.";
    

} else {
    echo "Error: " . $conn->error;
}

// Close connection
$conn->close();
?>
