<?php
session_start();
include '../../config/config.php';
$conn = getDatabaseConnection();

if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . 'login.php');
    exit;
}

// Ambil input dari form
$nama_user   = trim($_POST['nama_user']);
$username        = trim($_POST['username']);
$password         = trim($_POST['password']);
// Validasi sederhana
if ($nama_user === '' || $username === '' || $password === '') {
    $_SESSION['error'] = "Semua field wajib diisi.";
    header("Location: create.php");
    exit;
}

// Simpan ke database
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO users (name, username, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nama_user, $username, $hashed_password);

if ($stmt->execute()) {
    $_SESSION['success'] = "Data User berhasil disimpan.";
} else {
    $_SESSION['error'] = "Gagal menyimpan data.";
}

$stmt->close();
$conn->close();

header("Location: index.php");
exit;
