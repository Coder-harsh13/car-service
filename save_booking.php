<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login if not logged in
    header("Location: login.php");
    exit();
}

// Connect to your database
$servername = "localhost";
$username = "root"; // or your DB user
$password = "";     // your DB password
$dbname = "mechaniconwheel_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// If form submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and get form data
    $user_id = $_SESSION['user_id'];
    $service = $conn->real_escape_string($_POST['Service']);
    $booking_date = $conn->real_escape_string($_POST['Date']);
    $car_number = $conn->real_escape_string($_POST['Car-Number']);
    $details = $conn->real_escape_string($_POST['Details']);

    echo "<pre>";
    print_r($_POST);
    echo "</pre>";


    // Insert query
    $sql = "INSERT INTO bookings (user_id, service_type, booking_date, car_number, details)
            VALUES ('$user_id', '$service', '$date', '$car_number', '$details')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to profile or thank you page
        header("Location: profile.php?booking=success");
        exit();
    } else {
        echo "Error saving booking: " . $conn->error;
    }

    $conn->close();
}
?>
