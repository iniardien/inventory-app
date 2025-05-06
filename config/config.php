<?php
// config/config.php

// Pengaturan global
define('BASE_URL', 'http://localhost/inventory-app/'); 
date_default_timezone_set('Asia/Jakarta'); 

// Fungsi untuk mendapatkan koneksi database
function getDatabaseConnection() {
    include 'database.php';
    return $conn;
}

?>