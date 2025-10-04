<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
  header('Location: login.html');
  exit();
}

$sql = "SELECT * FROM rooms";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Manage Rooms</title>
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
      <h2>All Rooms</h2>
      <table>
        <tr>
          <th>Room Number</th>
          <th>Type</th>
          <th>Price</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $row['room_number'] ?></td>
          <td><?= $row['type'] ?></td>
          <td>₹<?= $row['price'] ?></td>
          <td><?= $row['available'] ? 'Available' : 'Booked' ?></td>
          <td>
            <a href="admin_edit_room.php?id=<?= $row['id'] ?>">
              <button style="background: #28a745">Edit</button>
            </a>
            <form action="admin_delete_room.php" method="POST" style="display:inline-block">
              <input type="hidden" name="room_id" value="<?= $row['id'] ?>">
              <button type="submit" style="background: #dc3545">Delete</button>
            </form>
          </td>
        </tr>
        <?php endwhile; ?>
      </table>
    </div>
  </div>
</body>
</html>
