<?php
session_start();
include '../../config/config.php';
$conn = getDatabaseConnection();

if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . 'login.php');
    exit;
}

// Ambil input dari form
$kode_barang   = trim($_POST['kode_barang']);
$nama_barang   = trim($_POST['nama_barang']);
$satuan        = trim($_POST['satuan']);
$stock         = trim($_POST['stock']);
$keterangan    = trim($_POST['keterangan']);
$kategori_id   = $_POST['kategori_id'];

// Validasi sederhana
if ($kode_barang === '' || $nama_barang === '' || $satuan === '' || $stock === '' || $kategori_id === '') {
    $_SESSION['error'] = "Semua field wajib diisi.";
    header("Location: index.php");
    exit;
}

// Simpan ke database
$stmt = $conn->prepare("INSERT INTO barang (kode_barang, nama_barang, satuan, stock, keterangan, kategori_id) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssisi", $kode_barang, $nama_barang, $satuan, $stock, $keterangan, $kategori_id);

if ($stmt->execute()) {
    $_SESSION['success'] = "Data barang berhasil disimpan.";
} else {
    $_SESSION['error'] = "Gagal menyimpan data.";
}

$stmt->close();
$conn->close();

header("Location: index.php");
exit;
