<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit();
}

$user_id = $_SESSION['user_id'];
$room_id = $_POST['room_id'];
$check_in = $_POST['check_in'];
$check_out = $_POST['check_out'];

$sql = "INSERT INTO bookings (user_id, room_id, check_in, check_out) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('iiss', $user_id, $room_id, $check_in, $check_out);

if ($stmt->execute()) {
    $conn->query("UPDATE rooms SET available = 0 WHERE id = $room_id");
    echo "Booking successful! <a href='rooms.php'>Back to rooms</a>";
} else {
    echo "Booking failed: " . $stmt->error;
}
$stmt->close();
$conn->close();
?>
