<?php
session_start();
include '../../config/config.php';
$conn = getDatabaseConnection();

if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . 'login.php');
    exit;
} ?>
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