<?php
// index.php

session_start();
include 'config/config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . 'login.php');
    exit;
}

// Jika session ada, arahkan ke dashboard (misalnya, inventory list)
include 'modules/inventory/index.php';
?>