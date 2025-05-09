<?php
session_start();
include '../../config/config.php';
$conn = getDatabaseConnection();

if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . 'login.php');
    exit;
}

$id = $_POST['id'];
$nama_user = trim($_POST['nama_user']);
$username = trim($_POST['username']);
$password = trim($_POST['password'] ?? '');


$fields = ['name = ?', 'username = ?'];
$params = [$nama_user, $username];
$types = 'ss';

if ($nama_user == '' || $username == '') {
    $_SESSION['error'] = "Nama User dan Username tidak Boleh Kosong.";
    header('Location: index.php');
    exit;
}

if ($password !== '') {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $fields[] = 'password = ?';
    $params[] = $hashed_password;
    $types .= 's'; 
}

$query = "UPDATE users SET " . implode(', ', $fields) . " WHERE id = ?";
$params[] = $id;
$types .= 'i'; 

$stmt = $conn->prepare($query);
$stmt->bind_param($types, ...$params);

if ($stmt->execute()) {
    $_SESSION['success'] = "User berhasil diperbarui.";
} else {
    $_SESSION['error'] = "Gagal memperbarui User.";
}

$stmt->close();
$conn->close();
header('Location: index.php');
exit;
