<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT b.id, r.room_number, r.type, b.check_in, b.check_out, b.status
        FROM bookings b
        JOIN rooms r ON b.room_id = r.id
        WHERE b.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Bookings</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="navbar">
        <a href="rooms.php">Rooms</a>
        <a href="my_bookings.php">My Bookings</a>
        <a href="logout.php">Logout</a>
    </div>
    <div class="container">
    <div class="card">
    <h2>My Bookings</h2>
    <table>
        <tr>
            <th>Room Number</th>
            <th>Type</th>
            <th>Check-in</th>
            <th>Check-out</th>
            <th>Status</th>
            <th>Cancel</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['room_number'] ?></td>
            <td><?= $row['type'] ?></td>
            <td><?= $row['check_in'] ?></td>
            <td><?= $row['check_out'] ?></td>
            <td><?= $row['status'] ?></td>
            <td>
            <?php if($row['status'] == 'booked'): ?>
                <form action="cancel_booking.php" method="POST">
                    <input type="hidden" name="booking_id" value="<?= $row['id'] ?>">
                    <button type="submit">Cancel</button>
                </form>
            <?php else: ?>
                N/A
            <?php endif; ?>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    </div>
    </div>
</body>
</html>
