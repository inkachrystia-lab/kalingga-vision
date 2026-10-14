<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "kalingga_db";

$conn = new mysqli($host, $user, $pass, $db);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi Database Gagal: " . $conn->connect_error);
}
?>