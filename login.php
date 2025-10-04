<?php
include 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
    session_start();
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['role'] = $user['role'];
    if ($user['role'] == 'admin') {
        header('Location: admin_dashboard.php');
    } else {
        header('Location: rooms.php');
    }
    exit();
} else {
    echo "Invalid username or password.";
}
$stmt->close();
$conn->close();
?>
