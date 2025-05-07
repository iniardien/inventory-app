<?php
session_start();
include '../../config/config.php';
$conn = getDatabaseConnection();

if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . 'login.php');
    exit;
}
$query = "
    SELECT b.id, b.kode_barang, b.nama_barang, b.satuan, b.stock, b.keterangan, k.nama_kategori 
    FROM barang b
    LEFT JOIN kategori k ON b.kategori_id = k.id
    ORDER BY b.id DESC
";
$result = $conn->query($query);
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
                <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Table Barang</h4>
                    <p class="card-description"><?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
                    <?php endif; ?>
                    </p>
                    <a href="<?php echo BASE_URL; ?>modules/barang/create.php" class="btn bg-gradient-primary color-white">Add</a>
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th> No </th>
                          <th> Kode  </th>
                          <th> Nama  </th>
                          <th> Satuan  </th>
                          <th> Stock </th>
                          <th> Kategori </th>
                          <th> Keterangan</th>
                          <th> Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if ($result && $result->num_rows > 0): ?>
                            <?php $no = 1; ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($row['kode_barang']) ?></td>
                                    <td><?= htmlspecialchars($row['nama_barang']) ?></td>
                                    <td><?= htmlspecialchars($row['satuan']) ?></td>
                                    <td><?= htmlspecialchars($row['stock']) ?></td>
                                    <td><?= htmlspecialchars($row['nama_kategori']) ?></td>
                                    <td><?= htmlspecialchars($row['keterangan']) ?></td>
                                    <td>
                                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center">Belum ada data barang</td>
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

</body>

</html>