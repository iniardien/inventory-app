<?php
// config/database.php

// Koneksi ke database
$host = 'localhost'; 
$user = 'root';      
$pass = '';          
$db = 'db_inventory';

// Membuat koneksi
$conn = mysqli_connect($host, $user, $pass, $db) or die('Connection failed: ' . mysqli_connect_error());

// Periksa koneksi
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>