<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: login.html');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $room_number = $_POST['room_number'];
    $type = $_POST['type'];
    $price = $_POST['price'];

    $sql = "INSERT INTO rooms (room_number, type, price) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssd', $room_number, $type, $price);

    if ($stmt->execute()) {
        echo "Room added! <a href='admin_rooms.php'>Back to rooms</a>";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Room</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="navbar">
    <a href="admin_rooms.php">Back to Rooms</a>
    <a href="logout.php">Logout</a>
  </div>
  <div class="container">
    <div class="card">
      <h2>Add New Room</h2>
      <form method="POST">
        <div class="form-group">
          <label>Room Number</label>
          <input type="text" name="room_number" required>
        </div>
        <div class="form-group">
          <label>Type</label>
          <input type="text" name="type" required>
        </div>
        <div class="form-group">
          <label>Price</label>
          <input type="number" name="price" required>
        </div>
        <button type="submit">Add Room</button>
      </form>
    </div>
  </div>
</body>
</html>
