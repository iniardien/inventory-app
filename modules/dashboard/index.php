<?php
session_start();
include '../../config/config.php';
$conn = getDatabaseConnection();

if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . 'login.php');
    exit;
}

// Ambil data untuk barang masuk hari ini
$today = date('Y-m-d');
$barang_masuk_query = "SELECT SUM(jumlah) as total_masuk FROM barang_masuk WHERE DATE(tanggal_masuk) = '$today'";
$barang_masuk_result = $conn->query($barang_masuk_query);
$barang_masuk = $barang_masuk_result->fetch_assoc()['total_masuk'] ?? 0;

// Ambil data untuk barang keluar hari ini
$barang_keluar_query = "SELECT SUM(jumlah) as total_keluar FROM barang_keluar WHERE DATE(tanggal_keluar) = '$today'";
$barang_keluar_result = $conn->query($barang_keluar_query);
$barang_keluar = $barang_keluar_result->fetch_assoc()['total_keluar'] ?? 0;

// Ambil data barang dengan stok paling sedikit (top 5)
$stok_sedikit_query = "SELECT kode_barang, nama_barang, stock, satuan FROM barang ORDER BY stock ASC LIMIT 5";
$stok_sedikit_result = $conn->query($stok_sedikit_query);

// Ambil jumlah total barang saat ini (distinct kode_barang)
$jumlah_barang_query = "SELECT COUNT(id) as total_barang FROM barang";
$jumlah_barang_result = $conn->query($jumlah_barang_query);
$jumlah_barang = $jumlah_barang_result->fetch_assoc()['total_barang'] ?? 0;

// Ambil jumlah user saat ini
$jumlah_user_query = "SELECT COUNT(id) as total_user FROM users";
$jumlah_user_result = $conn->query($jumlah_user_query);
$jumlah_user = $jumlah_user_result->fetch_assoc()['total_user'] ?? 0;


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Inventory App</title>
    <?php include '../../includes/header.php'; ?>
</head>

<body>
    <?php include '../../includes/nav-bar.php'; ?>
    <!-- Main Content -->
    <div class="container-fluid page-body-wrapper">
        <?php include '../../includes/sidebar.php'; ?>
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title">
                        <span class="page-title-icon bg-gradient-primary text-white me-2">
                            <i class="mdi mdi-home"></i>
                        </span> Dashboard
                    </h3>
                </div>
                <!-- Row 1: Barang Masuk dan Barang Keluar Hari Ini -->
                <div class="row">
                    <!-- Barang Masuk Hari Ini -->
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <i class="mdi mdi-arrow-down-bold-circle text-primary me-2"></i> Barang Masuk Hari Ini
                                </h4>
                                <div class="d-flex align-items-center">
                                    <h1 class="display-4"><?php echo $barang_masuk; ?></h1>
                                    <span class="ms-2">Unit</span>
                                </div>
                                <p class="card-description">Total barang masuk pada <?php echo date('d M Y'); ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Barang Keluar Hari Ini -->
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <i class="mdi mdi-arrow-up-bold-circle text-danger me-2"></i> Barang Keluar Hari Ini
                                </h4>
                                <div class="d-flex align-items-center">
                                    <h1 class="display-4"><?php echo $barang_keluar; ?></h1>
                                    <span class="ms-2">Unit</span>
                                </div>
                                <p class="card-description">Total barang keluar pada <?php echo date('d M Y'); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <i class="mdi mdi-package-variant text-success me-2"></i> Jumlah Barang Saat Ini
                                </h4>
                                <div class="d-flex align-items-center">
                                    <h1 class="display-4"><?php echo $jumlah_barang; ?></h1>
                                    <span class="ms-2">Jenis</span>
                                </div>
                                <p class="card-description">Total jenis barang yang tersedia</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- List Barang dengan Stok Paling Sedikit -->
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <i class="mdi mdi-alert-circle text-warning me-2"></i> List Stok Barang Paling Sedikit
                                </h4>
                                <?php if ($stok_sedikit_result->num_rows > 0): ?>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Kode</th>
                                                <th>Nama Barang</th>
                                                <th>Stok</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = $stok_sedikit_result->fetch_assoc()): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($row['kode_barang']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['nama_barang']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['stock']); ?> <?php echo htmlspecialchars($row['satuan']); ?></td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                <?php else: ?>
                                    <p class="text-muted">Belum ada data stok barang.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2025 USB YPKP</a>. All rights reserved.</span>
                </div>
            </footer>

        </div>
    </div>
    <!-- End Main Content -->
    <?php include '../../includes/footer.php'; ?>

</body>

</html>