<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
  header('Location: login.html');
  exit();
}

$room_id = $_GET['id'];
$sql = "SELECT * FROM rooms WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $room_id);
$stmt->execute();
$room = $stmt->get_result()->fetch_assoc();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $room_number = $_POST['room_number'];
  $type = $_POST['type'];
  $price = $_POST['price'];
  $available = isset($_POST['available']) ? 1 : 0;

  $sql = "UPDATE rooms SET 
          room_number = ?, 
          type = ?, 
          price = ?,
          available = ?
          WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ssdii', $room_number, $type, $price, $available, $room_id);

  if ($stmt->execute()) {
    echo '<div class="alert alert-success">Room updated!</div>';
  } else {
    echo '<div class="alert alert-error">Error: ' . $stmt->error . '</div>';
  }
  $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Room</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="navbar">
    <a href="admin_rooms.php">Back to Rooms</a>
    <a href="logout.php">Logout</a>
  </div>
  <div class="container">
    <div class="card">
      <h2>Edit Room <?= $room['room_number'] ?></h2>
      <form method="POST">
        <div class="form-group">
          <label>Room Number</label>
          <input type="text" name="room_number" value="<?= $room['room_number'] ?>" required>
        </div>
        <div class="form-group">
          <label>Room Type</label>
          <input type="text" name="type" value="<?= $room['type'] ?>" required>
        </div>
        <div class="form-group">
          <label>Price</label>
          <input type="number" name="price" value="<?= $room['price'] ?>" required>
        </div>
        <div class="form-group">
          <label>
            <input type="checkbox" name="available" <?= $room['available'] ? 'checked' : '' ?>>
            Available
          </label>
        </div>
        <button type="submit">Update Room</button>
      </form>
    </div>
  </div>
</body>
</html>
