<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Get username for display
// $username = $_SESSION['username'];
// Fetch user info
$user_query = $conn->prepare("SELECT name, email FROM users WHERE id = ?");
$user_query->bind_param("i", $user_id);
$user_query->execute();
$user_result = $user_query->get_result();
$user = $user_result->fetch_assoc(); // now $user['name'] and $user['email'] are available


// Fetch bookings
$stmt = $conn->prepare("SELECT service_type, booking_date, car_number, details, created_at FROM bookings WHERE user_id = ?");

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile | Mechanic On Wheel</title>
    <link rel="stylesheet" href="style.css">
    <style>body.dark-theme {
    background-color: #121212;
    color: #f0f0f0;
    font-family: 'Segoe UI', sans-serif;
    margin: 0;
    padding: 0;
}

.profile-container {
    max-width: 800px;
    margin: 80px auto;
    padding: 2rem;
    background-color: #1e1e1e;
    border-radius: 16px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
}

.profile-container h1 {
    font-size: 2rem;
    margin-bottom: 0.5rem;
    color: #ffffff;
}

.profile-container p {
    font-size: 1rem;
    margin-bottom: 1rem;
    color: #cccccc;
}

.profile-container h2 {
    margin-top: 2rem;
    margin-bottom: 1rem;
    color: #ffffff;
}

table {
    width: 100%;
    border-collapse: collapse;
    background-color: #2a2a2a;
    border-radius: 12px;
    overflow: hidden;
}

table thead {
    background-color: #333;
}

table th, table td {
    padding: 12px 16px;
    text-align: left;
    border-bottom: 1px solid #444;
}

table th {
    color: #dddddd;
}

table td {
    color: #eeeeee;
}

.primary-btn {
    padding: 0.6rem 1.2rem;
    background-color:var(--primary-color);
    border: none;
    color: black;
    font-size: 1rem;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.primary-btn:hover {
    background-color:#ffed4a;
}
</style>
</head>
<body class="dark-theme">
    <div class="profile-container">
        <h1>Welcome, <?php echo htmlspecialchars($user['name']); ?>!</h1>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>

        <h2>Your Scheduled Services</h2>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Service</th>
                        <th>Date</th>
                        <th>Car No.</th>
                        <th>Details</th>
                        <th>Booked At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['service_type']) ?></td>
                            <td><?= htmlspecialchars($row['booking_date']) ?></td>
                            <td><?= htmlspecialchars($row['car_number']) ?></td>
                            <td><?= htmlspecialchars($row['details']) ?></td>
                            <td><?= htmlspecialchars($row['created_at']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No bookings found.</p>
        <?php endif; ?>



        <a href="index.php?user=<?php echo urlencode($user['name']); ?>" class="primary-btn" style="margin-right: 10px;">Home</a>

        <form action="logout.php" method="post" style="display: inline;">
            <button type="submit" class="primary-btn">Logout</button>
        </form>

    </div>
</body>
</html>
<?php
$stmt->close();
$user_query->close();
$conn->close();
?>

