<?php
session_start();
include '../../config/config.php';
$conn = getDatabaseConnection();

if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . 'login.php');
    exit;
}

$id = $_POST['id'];
$nama_kategori = trim($_POST['nama_kategori']);

if ($nama_kategori == '') {
    $_SESSION['error'] = "Nama kategori tidak boleh kosong.";
    header('Location: index.php');
    exit;
}

$stmt = $conn->prepare("UPDATE kategori SET nama_kategori = ? WHERE id = ?");
$stmt->bind_param("si", $nama_kategori, $id);

if ($stmt->execute()) {
    $_SESSION['success'] = "Kategori berhasil diperbarui.";
} else {
    $_SESSION['error'] = "Gagal memperbarui kategori.";
}

$stmt->close();
$conn->close();
header('Location: index.php');
exit;
