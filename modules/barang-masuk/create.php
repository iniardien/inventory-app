<?php
session_start();
include '../../config/config.php';
$conn = getDatabaseConnection();

if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . 'login.php');
    exit;
}
$query = "SELECT id, kode_barang, nama_barang, satuan, stock FROM barang";
$result = $conn->query($query);
$barangList = [];
while ($row = $result->fetch_assoc()) {
    $barangList[] = $row;
}
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
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Form Tambah Barang Masuk</h4>
                                <form class="forms-sample" method="post" action="store.php">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="tanggal">Tanggal Barang Masuk</label>
                                                <input type="date" class="form-control" name="tanggal" id="tanggal">
                                                <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="barang-container">
                                        <div class="row barang-row mb-3">
                                            <div class="col-4">
                                                <label for="barang_id">Pilih Barang</label>
                                                <select name="barang_id[]" class="form-select my-2" onchange="updateDetail(this)">
                                                    <option value="">Pilih Product</option>
                                                    <?php foreach ($barangList as $barang): ?>
                                                        <option value="<?= $barang['id'] ?>"><?= $barang['nama_barang'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-2">
                                                <label for="kode_barang">Kode Barang</label>
                                                <input type="text" class="form-control kode_barang my-2" readonly>
                                            </div>
                                            <div class="col-2">
                                                <label for="satuan">Satuan</label>
                                                <input type="text" class="form-control satuan my-2" readonly>
                                            </div>
                                            <div class="col-2">
                                                <label for="stock">Stock</label>
                                                <input type="text" class="form-control stock my-2" readonly>
                                            </div>
                                            <div class="col-2">
                                                <label for="jumlahh">Jumlah Barang Masuk</label>
                                                <input type="number" class="form-control my-2" name="jumlah[]" placeholder="Jumlah">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="py-2 mb-2">
                                        <div class="btn btn-sm btn-primary" id="tambah-barang">+ Tambah Barang</div>
                                    </div>
                                    <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                                    <a href="index.php" class="btn btn-light">Cancel</a>
                                </form>
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

    <script type="text/javascript">
        const barangData = <?= json_encode($barangList) ?>;

        function updateDetail(selectElement) {
            const selectedId = selectElement.value;
            const parentRow = selectElement.closest('.barang-row');
            const barang = barangData.find(b => b.id == selectedId);

            if (barang) {
                parentRow.querySelector('.kode_barang').value = barang.kode_barang;
                parentRow.querySelector('.satuan').value = barang.satuan;
                parentRow.querySelector('.stock').value = barang.stock;
            }
        }

        function tambahBaris() {
            const container = document.getElementById('barang-container');
            const template = document.querySelector('.barang-row');
            const newRow = template.cloneNode(true);

            // Reset nilai input
            newRow.querySelector('select').selectedIndex = 0;
            newRow.querySelector('.kode_barang').value = '';
            newRow.querySelector('.satuan').value = '';
            newRow.querySelector('.stock').value = '';
            newRow.querySelector('[name="jumlah[]"]').value = '';

            container.appendChild(newRow);
        }

        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('tambah-barang').addEventListener('click', tambahBaris);
        });
</script>
</body>

</html>