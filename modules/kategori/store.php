<?php
session_start();
include '../../config/config.php';
$conn = getDatabaseConnection();

// Cek login
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . 'login.php');
    exit;
}

// Validasi input
$nama_kategori = trim($_POST['nama_kategori']);
if ($nama_kategori == '') {
    $_SESSION['error'] = "Nama kategori tidak boleh kosong.";
    header('Location: index.php');
    exit;
}

// Simpan ke database
$stmt = $conn->prepare("INSERT INTO kategori (nama_kategori) VALUES (?)");
$stmt->bind_param("s", $nama_kategori);

if ($stmt->execute()) {
    $_SESSION['success'] = "Kategori berhasil ditambahkan.";
} else {
    $_SESSION['error'] = "Gagal menambahkan kategori.";
}

$stmt->close();
$conn->close();

header('Location: index.php');
exit;
