<?php
session_start();
include '../../config/config.php';
$conn = getDatabaseConnection();

$id = $_GET['id'];

// Ambil data lama
$data = $conn->query("SELECT * FROM barang_keluar WHERE id = $id")->fetch_assoc();
$barang_id = $data['barang_id'];
$jumlah = $data['jumlah'];

// Kurangi stock barang
$conn->query("UPDATE barang SET stock = stock + $jumlah WHERE id = $barang_id");

// Hapus data
$conn->query("DELETE FROM barang_keluar WHERE id = $id");

$_SESSION['success'] = "Data berhasil dihapus!";
header('Location: index.php');
exit;
