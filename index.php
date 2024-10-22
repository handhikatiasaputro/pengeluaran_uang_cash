<?php 
require 'functions.php';
require "config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['tambah_kategori'])) {
        tambahKategori($_POST['nama_kategori']);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } elseif (isset($_POST['tambah_pengeluaran'])) {
        tambahPengeluaran($_POST['jumlah'], $_POST['tanggal'], $_POST['kategori_id']);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

// Proses hapus pengeluaran
if (isset($_GET['hapus'])) {
    hapusPengeluaran($_GET['hapus']);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

$pengeluaran = getPengeluaran();
$kategori = getKategori();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Mencatat Pengeluaran</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Mencatat Pengeluaran Harian</h1>

    <h2>Tambah Kategori</h2>
    <form method="POST">
        <input type="text" name="nama_kategori" placeholder="Nama Kategori" required>
        <button type="submit" name="tambah_kategori">Tambah Kategori</button>
    </form>

    <h2>Tambah Pengeluaran</h2>
    <form method="POST">
        <input type="number" name="jumlah" placeholder="Jumlah" required>
        <input type="date" name="tanggal" required>
        <select name="kategori_id" required>
            <option value="">Pilih Kategori</option>
            <?php foreach ($kategori as $kat): ?>
                <option value="<?= $kat['id'] ?>"><?= $kat['nama_kategori'] ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" name="tambah_pengeluaran">Tambah Pengeluaran</button>
    </form>

    <h2>Ringkasan Pengeluaran</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pengeluaran as $peng): ?>
                <tr>
                    <td><?= $peng['id'] ?></td>
                    <td>Rp<?= number_format($peng['jumlah'], 2) ?></td>
                    <td><?= date('d-m-Y', strtotime($peng['tanggal'])) ?></td>
                    <td><?= $peng['nama_kategori'] ?></td>
                    <td>
                        <a href="edit_pengeluaran.php?id=<?= $peng['id'] ?>">Edit</a> |
                        <a href="?hapus=<?= $peng['id'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus?');">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Total Pengeluaran Bulanan</h2>
    <?php
    $bulan = date('m');
    $tahun = date('Y');
    $total = totalPengeluaranBulanan($bulan, $tahun);
    ?>
    <p>Total Pengeluaran Bulan <?= $bulan ?>: <?= number_format($total, 2) ?></p>
</body>
</html>
