<?php
session_start();
include '../../config/config.php';
$conn = getDatabaseConnection();

if (!isset($_SESSION['user_id'])) {
    header("Location: " . BASE_URL . "login.php");
    exit;
}

$id = intval($_POST['id']);

// Ambil data lama dari database
$stmt_old = $conn->prepare("SELECT * FROM barang WHERE id = ?");
$stmt_old->bind_param("i", $id);
$stmt_old->execute();
$old_result = $stmt_old->get_result();
$old_data = $old_result->fetch_assoc();
$stmt_old->close();

if (!$old_data) {
    $_SESSION['error'] = "Data tidak ditemukan.";
    header("Location: index.php");
    exit;
}

// Ambil data dari POST, gunakan data lama jika kosong
$kode_barang = $_POST['kode_barang'] !== '' ? $_POST['kode_barang'] : $old_data['kode_barang'];
$nama_barang = $_POST['nama_barang'] !== '' ? $_POST['nama_barang'] : $old_data['nama_barang'];
$satuan      = $_POST['satuan'] !== '' ? $_POST['satuan'] : $old_data['satuan'];
$stock       = $_POST['stock'] !== '' ? intval($_POST['stock']) : $old_data['stock'];
$keterangan  = $_POST['keterangan'] !== '' ? $_POST['keterangan'] : $old_data['keterangan'];
$kategori_id = $_POST['kategori_id'] !== '' ? intval($_POST['kategori_id']) : $old_data['kategori_id'];

// Update data
$stmt = $conn->prepare("UPDATE barang SET kode_barang=?, nama_barang=?, satuan=?, stock=?, keterangan=?, kategori_id=? WHERE id=?");
$stmt->bind_param("sssissi", $kode_barang, $nama_barang, $satuan, $stock, $keterangan, $kategori_id, $id);

if ($stmt->execute()) {
    $_SESSION['success'] = "Data barang berhasil diperbarui.";
} else {
    $_SESSION['error'] = "Gagal memperbarui data.";
}

$stmt->close();
$conn->close();
header("Location: index.php");
exit;
