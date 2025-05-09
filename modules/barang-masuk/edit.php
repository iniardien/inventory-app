<?php
session_start();
include '../../config/config.php';
$conn = getDatabaseConnection();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../../login.php');
    exit;
}

$id = $_GET['id'];
$query = "SELECT * FROM barang_masuk WHERE id = $id";
$result = $conn->query($query);
$data = $result->fetch_assoc();

// Ambil semua barang
$barang = $conn->query("SELECT * FROM barang");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Barang Masuk</title>
    <?php include '../../includes/header.php'; ?>
</head>
<body>
<?php include '../../includes/nav-bar.php'; ?>
<div class="container-fluid page-body-wrapper">
    <?php include '../../includes/sidebar.php'; ?>
    <div class="main-panel">
        <div class="content-wrapper">
            <h4 class="mb-3">Edit Barang Masuk</h4>

            <form action="update.php" method="post">
                <input type="hidden" name="id" value="<?= $data['id'] ?>">
                <div class="form-group mb-3">
                    <label>Tanggal Masuk</label>
                    <input type="date" name="tanggal" class="form-control" value="<?= $data['tanggal_masuk'] ?>">
                </div>
                <div class="form-group mb-3">
                    <label>Barang</label>
                    <select name="barang_id" class="form-control">
                        <?php while($b = $barang->fetch_assoc()): ?>
                            <option value="<?= $b['id'] ?>" <?= $b['id'] == $data['barang_id'] ? 'selected' : '' ?>>
                                <?= $b['nama_barang'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label>Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" value="<?= $data['jumlah'] ?>">
                </div>
                <button type="submit" class="btn btn-success">Update</button>
                <a href="index.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>
