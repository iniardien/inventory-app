<?php
session_start();
include '../../config/config.php';
$conn = getDatabaseConnection();

// Ambil data dari database
$query = "
    SELECT b.id, b.kode_barang, b.nama_barang, b.satuan, b.stock, b.keterangan, k.nama_kategori 
    FROM barang b
    LEFT JOIN kategori k ON b.kategori_id = k.id
    ORDER BY b.id DESC
";
$result = $conn->query($query);

if (!$result) {
    $_SESSION['error'] = "Gagal mengambil data: " . $conn->error;
    header('Location: index.php');
    exit;
}

// Set header untuk unduhan CSV
$filename = 'Laporan_Barang_' . date('Ymd_His') . '.csv';
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');

// Buat output CSV
$output = fopen('php://output', 'w');

// Tambahkan BOM untuk mendukung UTF-8 di Excel
fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));

// Tulis header kolom
$headers = ['No', 'Kode Barang', 'Nama Barang', 'Satuan', 'Stock', 'Kategori', 'Keterangan'];
fputcsv($output, $headers, ';');

// Tulis data dari database
$no = 1;
while ($row = $result->fetch_assoc()) {
    $line = [
        $no++,
        $row['kode_barang'],
        $row['nama_barang'],
        $row['satuan'],
        $row['stock'],
        $row['nama_kategori'],
        $row['keterangan'],
    ];
    fputcsv($output, $line, ';');
}

// Tutup output dan keluar
fclose($output);
$conn->close();
exit;
