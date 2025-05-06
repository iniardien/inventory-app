<?php
session_start();
include 'config/config.php'; // <--- tambahkan baris ini agar BASE_URL dikenali

session_unset();    // Menghapus semua session
session_destroy();  // Menghancurkan session

// Redirect ke halaman login
header('Location: ' . BASE_URL . 'login.php');
exit;
