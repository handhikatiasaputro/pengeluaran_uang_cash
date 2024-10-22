<?php 
require 'functions.php';
require "config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $jumlah = $_POST['jumlah'];
    $tanggal = $_POST['tanggal'];
    $kategori_id = $_POST['kategori_id'];
    
    editPengeluaran($id, $jumlah, $tanggal, $kategori_id);
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
// Ambil data pengeluaran berdasarkan id
$currentPengeluaran = getPengeluaranById($id); // Pastikan fungsi ini ada di 'functions.php' untuk mengambil data pengeluaran berdasarkan ID
$kategori = getKategori();

// Cek apakah data pengeluaran ditemukan
if (!$currentPengeluaran) {
    echo "Data pengeluaran tidak ditemukan.";
    exit;
}
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
        <input type="hidden" name="id" value="<?= isset($currentPengeluaran['id']) ? $currentPengeluaran['id'] : '' ?>">
        <input type="number" name="jumlah" placeholder="Jumlah" value="<?= isset($currentPengeluaran['jumlah']) ? $currentPengeluaran['jumlah'] : '' ?>" required>
        <input type="date" name="tanggal" value="<?= isset($currentPengeluaran['tanggal']) ? $currentPengeluaran['tanggal'] : '' ?>" required>
        
        <select name="kategori_id" required>
            <option value="">Pilih Kategori</option>
            <?php foreach ($kategori as $kat): ?>
                <option value="<?= $kat['id'] ?>" <?= isset($currentPengeluaran['kategori_id']) && $kat['id'] == $currentPengeluaran['kategori_id'] ? 'selected' : '' ?>>
                    <?= $kat['nama_kategori'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <button type="submit">Simpan Perubahan</button>
    </form>
</body>
</html>
