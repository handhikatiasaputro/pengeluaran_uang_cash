<?php 
require 'functions.php';
require "config.php";

// Mengambil daftar kategori dari database
$kategori = getKategori();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kategori</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Daftar Kategori</h1>
    
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($kategori as $kat): ?>
                <tr>
                    <td><?= $kat['id'] ?></td>
                    <td><?= $kat['nama_kategori'] ?></td>
                    <td>
                        <a href="edit_kategori.php?id=<?= $kat['id'] ?>">Edit</a> |
                        <a href="hapus_kategori.php?id=<?= $kat['id'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="index.php" class="list">Kembali ke Halaman Utama</a>
</body>
</html>
