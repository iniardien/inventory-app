<?php
session_start();
include '../../config/config.php';
$conn = getDatabaseConnection();

// Ambil data dari database
$query = "SELECT 
            bm.id, 
            bm.tanggal_masuk, 
            bm.jumlah, 
            b.nama_barang, 
            b.kode_barang, 
            b.satuan, 
            u.name
          FROM barang_masuk bm
          JOIN barang b ON bm.barang_id = b.id
          JOIN users u ON bm.user_id = u.id
          ORDER BY bm.tanggal_masuk DESC";

$result = $conn->query($query);

if (!$result) {
    $_SESSION['error'] = "Gagal mengambil data: " . $conn->error;
    header('Location: index.php');
    exit;
}

// Set header untuk unduhan CSV
$filename = 'Laporan_Barang_Masuk_' . date('Ymd_His') . '.csv';
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');

// Buat output CSV
$output = fopen('php://output', 'w');

// Tambahkan BOM untuk mendukung UTF-8 di Excel
fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));

// Tulis header kolom
$headers = ['No', 'Tanggal Masuk', 'Kode Barang', 'Nama Barang', 'Jumlah Masuk', 'Satuan', 'Input Oleh'];
fputcsv($output, $headers, ';');

// Tulis data dari database
$no = 1;
while ($row = $result->fetch_assoc()) {
    $line = [
        $no++,
        $row['tanggal_masuk'],
        $row['kode_barang'],
        $row['nama_barang'],
        $row['jumlah'],
        $row['satuan'],
        $row['name']
    ];
    fputcsv($output, $line, ';');
}

// Tutup output dan keluar
fclose($output);
$conn->close();
exit;
?>