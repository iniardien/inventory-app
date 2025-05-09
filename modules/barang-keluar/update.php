<?php
session_start();
include '../../config/config.php';
$conn = getDatabaseConnection();

$id         = $_POST['id'];
$tanggal    = $_POST['tanggal'];
$barang_id  = $_POST['barang_id'];
$jumlah     = $_POST['jumlah'];

// Ambil data lama
$old = $conn->query("SELECT * FROM barang_keluar WHERE id = $id")->fetch_assoc();

// Update barang_keluar
$conn->query("UPDATE barang_keluar SET tanggal_keluar='$tanggal', barang_id=$barang_id, jumlah=$jumlah WHERE id=$id");

// Hitung perubahan jumlah stok
$selisih = $jumlah - $old['jumlah'];
$conn->query("UPDATE barang SET stock = stock + $selisih WHERE id = $barang_id");

$_SESSION['success'] = "Data berhasil diupdate!";
header('Location: index.php');
exit;
