<?php
session_start();
include '../config/config.php';

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . 'login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
</head>
<body>
    <h1>Dashboard</h1>
    <a href="<?= BASE_URL ?>logout.php">Logout</a>
</body>
</html>
