<?php
session_start();
include '../../config/config.php';
$conn = getDatabaseConnection();

// Ambil data dari database
$query = "SELECT 
            bk.id, 
            bk.tanggal_keluar, 
            bk.jumlah, 
            b.nama_barang, 
            b.kode_barang, 
            b.satuan, 
            u.name
          FROM barang_keluar bk
          JOIN barang b ON bk.barang_id = b.id
          JOIN users u ON bk.user_id = u.id
          ORDER BY bk.tanggal_keluar DESC";

$result = $conn->query($query);

if (!$result) {
    $_SESSION['error'] = "Gagal mengambil data: " . $conn->error;
    header('Location: index.php');
    exit;
}

// Set header untuk unduhan CSV
$filename = 'Laporan_Barang_Keluar_' . date('Ymd_His') . '.csv';
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');

// Buat output CSV
$output = fopen('php://output', 'w');

// Tambahkan BOM untuk mendukung UTF-8 di Excel
fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));

// Tulis header kolom
$headers = ['No', 'Tanggal Keluar', 'Kode Barang', 'Nama Barang', 'Jumlah Keluar', 'Satuan', 'Input Oleh'];
fputcsv($output, $headers, ';');

// Tulis data dari database
$no = 1;
while ($row = $result->fetch_assoc()) {
    $line = [
        $no++,
        $row['tanggal_keluar'],
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