<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit();
}

$booking_id = $_POST['booking_id'];

$sql = "SELECT room_id FROM bookings WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $booking_id);
$stmt->execute();
$stmt->bind_result($room_id);
$stmt->fetch();
$stmt->close();

$sql = "UPDATE bookings SET status = 'cancelled' WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $booking_id);
$stmt->execute();
$stmt->close();

$sql = "UPDATE rooms SET available = 1 WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $room_id);
$stmt->execute();
$stmt->close();

$conn->close();

header('Location: my_bookings.php');
exit();
?>
