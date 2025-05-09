<?php
session_start();
include '../../config/config.php';
$conn = getDatabaseConnection();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../../login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$tanggal = $_POST['tanggal'];
$barang_ids = $_POST['barang_id'];
$jumlahs = $_POST['jumlah'];

$conn->begin_transaction();

try {
    foreach ($barang_ids as $index => $barang_id) {
        $jumlah = (int) $jumlahs[$index];

        // Insert ke barang_keluar
        $stmt = $conn->prepare("INSERT INTO barang_keluar (barang_id, user_id, tanggal_keluar, jumlah) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iisi", $barang_id, $user_id, $tanggal, $jumlah);
        if (!$stmt->execute()) {
            throw new Exception("Gagal insert barang keluar");
        }

        // Update stok barang
        $stmt2 = $conn->prepare("UPDATE barang SET stock = stock - ? WHERE id = ?");
        $stmt2->bind_param("ii", $jumlah, $barang_id);
        if (!$stmt2->execute()) {
            throw new Exception("Gagal update stok barang");
        }
    }

    $conn->commit();
    $_SESSION['success'] = "Barang keluar berhasil disimpan dan stok terupdate.";
    header("Location: index.php");
    exit;

} catch (Exception $e) {
    $conn->rollback();
    $_SESSION['error'] = "Terjadi kesalahan: " . $e->getMessage();
    header("Location: create.php");
    exit;
}
?>
