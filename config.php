<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "pengeluaran_db"; // Ganti dengan nama database baru Anda

$conn = new mysqli($hostname, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
