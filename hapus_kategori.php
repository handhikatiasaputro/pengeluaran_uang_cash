<?php
require 'config.php';
require 'functions.php';

// Menghapus kategori berdasarkan id
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    hapusKategori($id);
    header("Location: kategori_list.php"); // Ganti dengan nama file yang menampilkan daftar kategori
    exit;
}
