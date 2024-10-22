<?php 
require 'functions.php';
require "config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $jumlah = $_POST['jumlah'];
    $tanggal = $_POST['tanggal'];
    $kategori_id = $_POST['kategori_id'];
    
    editPengeluaran($id, $jumlah, $tanggal, $kategori_id);
    header("Location: index.php"); // Ganti dengan nama file utama Anda
    exit;
}

$id = $_GET['id'];
$pengeluaran = getPengeluaran();
$kategori = getKategori();
$currentPengeluaran = array_filter($pengeluaran, fn($p) => $p['id'] == $id);
$currentPengeluaran = reset($currentPengeluaran); // Mendapatkan elemen pertama dari array

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengeluaran</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Edit Pengeluaran</h1>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $currentPengeluaran['id'] ?>">
        <input type="number" name="jumlah" placeholder="Jumlah" value="<?= $currentPengeluaran['jumlah'] ?>" required>
        <input type="date" name="tanggal" value="<?= $currentPengeluaran['tanggal'] ?>" required>
        
        <select name="kategori_id" required>
            <option value="">Pilih Kategori</option>
            <?php foreach ($kategori as $kat): ?>
                <option value="<?= $kat['id'] ?>" <?= $kat['id'] == $currentPengeluaran['kategori_id'] ? 'selected' : '' ?>><?= $kat['nama_kategori'] ?></option>
            <?php endforeach; ?>
        </select>
        
        <button type="submit">Simpan Perubahan</button>
    </form>
</body>
</html>
