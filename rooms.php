<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit();
}

$sql = "SELECT * FROM rooms WHERE available = 1";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Available Rooms</title>
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
    <h2>Available Rooms</h2>
    <table>
        <tr>
            <th>Room Number</th>
            <th>Type</th>
            <th>Price</th>
            <th>Book</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['room_number'] ?></td>
            <td><?= $row['type'] ?></td>
            <td><?= $row['price'] ?></td>
            <td>
                <form action="book_room.php" method="POST">
                    <input type="hidden" name="room_id" value="<?= $row['id'] ?>">
                    Check-in: <input type="date" name="check_in" required>
                    Check-out: <input type="date" name="check_out" required>
                    <button type="submit">Book</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    </div>
    </div>
</body>
</html>
