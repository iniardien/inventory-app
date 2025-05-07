<?php
session_start();
include '../../config/config.php';
$conn = getDatabaseConnection();

if (!isset($_SESSION['user_id'])) {
    header("Location: " . BASE_URL . "login.php");
    exit;
}

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM barang WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    $_SESSION['success'] = "Barang berhasil dihapus.";
} else {
    $_SESSION['error'] = "Gagal menghapus barang.";
}

$stmt->close();
$conn->close();
header("Location: index.php");
exit;
