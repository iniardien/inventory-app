<?php
session_start();
include '../../config/config.php';
$conn = getDatabaseConnection();

if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . 'login.php');
    exit;
}

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
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang Masuk - Inventory App</title>
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
                        </span> Barang Masuk
                    </h3>
                </div>
                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Tabel Barang Masuk</h4>
                                <p class="card-description"><?php if (isset($_SESSION['success'])): ?>
                                <div class="alert alert-success"><?= $_SESSION['success'];
                                                                    unset($_SESSION['success']); ?></div>
                            <?php endif; ?>

                            <?php if (isset($_SESSION['error'])): ?>
                                <div class="alert alert-danger"><?= $_SESSION['error'];
                                                                unset($_SESSION['error']); ?></div>
                            <?php endif; ?>
                            </p>
                            <a href="<?php echo BASE_URL; ?>modules/barang-masuk/create.php" class="btn bg-gradient-primary color-white">Add</a>
                            <a href="<?php echo BASE_URL; ?>modules/barang-masuk/export_csv.php" class="btn bg-gradient-success color-white">Generate Report</a>
                            <table class="table table-striped">

                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah Masuk</th>
                                        <th>Satuan</th>
                                        <th>Input Oleh</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    while ($row = $result->fetch_assoc()): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $row['tanggal_masuk'] ?></td>
                                            <td><?= $row['kode_barang'] ?></td>
                                            <td><?= $row['nama_barang'] ?></td>
                                            <td><?= $row['jumlah'] ?></td>
                                            <td><?= $row['satuan'] ?></td>
                                            <td><?= $row['name'] ?></td>
                                            <td>
                                                <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                                <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus data ini?')">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                    <?php if ($result->num_rows === 0): ?>
                                        <tr>
                                            <td colspan="7" class="text-center">Belum ada data barang masuk</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
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

    </>

</html>