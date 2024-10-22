<?php

require "config.php";

$hostname = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($hostname, $username, $password);
if($conn->connect_error)
{
    die("gagal connect:" . $conn->connect_error);
}


// membuat database 
$sql_buat_db = "CREATE DATABASE pengeluaran_db";
$eksekusi_buat_db = $conn->query($sql_buat_db);
if($eksekusi_buat_db)
{
    echo "buat db pengeluaran_uang berhasil"; '<br>';
}

$sql_masuk_db = "USE pengeluaran_db";
$eksekusi_masuk_db = $conn->query($sql_masuk_db);
if($eksekusi_masuk_db)
{
    echo "berhasil masuk ke db";
}

$sql_tabel_satu = "CREATE TABLE kategori (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(100) NOT NULL
)";
$eksekusi_tabel_satu = $conn->query($sql_tabel_satu);
if($eksekusi_tabel_satu)
{
    echo "berhasil membuat tabel_1";
}

$sql_tabel_dua = "CREATE TABLE pengeluaran (
    id INT AUTO_INCREMENT PRIMARY KEY,
    jumlah DECIMAL(10, 2) NOT NULL,
    tanggal DATE NOT NULL,
    kategori_id INT,
    FOREIGN KEY (kategori_id) REFERENCES kategori(id)
)";
$eksekusi_tabel_dua = $conn->query($sql_tabel_dua);
if($eksekusi_tabel_dua)
{
    echo "berhasil membuat tabel_2";
}

$db->close();
