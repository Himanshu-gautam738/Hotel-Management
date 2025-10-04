<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: login.html');
    exit();
}

$sql = "SELECT b.id, u.username, r.room_number, r.type, b.check_in, b.check_out, b.status
        FROM bookings b
        JOIN users u ON b.user_id = u.id
        JOIN rooms r ON b.room_id = r.id
        ORDER BY b.id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="navbar">
        <a href="admin_dashboard.php">Dashboard</a>
        <a href="admin_rooms.php">Manage Rooms</a>
        <a href="admin_add_room.php">Add Room</a>
        <a href="logout.php">Logout</a>
    </div>
    <div class="container">
    <div class="card">
    <h2>Admin Panel - All Bookings</h2>
    <table>
        <tr>
            <th>Booking ID</th>
            <th>User</th>
            <th>Room Number</th>
            <th>Type</th>
            <th>Check-in</th>
            <th>Check-out</th>
            <th>Status</th>
            <th>Cancel</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['username'] ?></td>
            <td><?= $row['room_number'] ?></td>
            <td><?= $row['type'] ?></td>
            <td><?= $row['check_in'] ?></td>
            <td><?= $row['check_out'] ?></td>
            <td><?= $row['status'] ?></td>
            <td>
                <?php if($row['status'] == 'booked'): ?>
                    <form action="admin_cancel_booking.php" method="POST">
                        <input type="hidden" name="booking_id" value="<?= $row['id'] ?>">
                        <button type="submit" style="background: #dc3545">Cancel</button>
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
