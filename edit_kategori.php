<?php
require 'config.php';
require 'functions.php';

// Proses ketika form dikirim (POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nama_kategori = $_POST['nama_kategori'];

    // Update kategori di database
    if (!empty($nama_kategori)) {
        editKategori($id, $nama_kategori);
        header("Location: kategori_list.php"); // Ganti dengan nama file yang menampilkan daftar kategori
        exit;
    } else {
        $error = "Nama kategori tidak boleh kosong!";
    }
}

// Mendapatkan data kategori berdasarkan id
$id = $_GET['id'];
$kategori = getKategoriById($id);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Edit Kategori</h1>

    <?php if (isset($error)): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST">
        <input type="hidden" name="id" value="<?= $kategori['id'] ?>">
        <input type="text" name="nama_kategori" placeholder="Nama Kategori" value="<?= $kategori['nama_kategori'] ?>" required>
        <button type="submit">Simpan Perubahan</button>
    </form>

    <a href="kategori_list.php">Kembali</a>
</body>
</html>
