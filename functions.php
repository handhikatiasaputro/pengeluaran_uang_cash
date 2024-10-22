<?php
require "config.php";

// Fungsi untuk menambahkan kategori
function tambahKategori($nama_kategori) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO kategori (nama_kategori) VALUES (?)");
    $stmt->bind_param("s", $nama_kategori);
    return $stmt->execute();
}

// Fungsi untuk menambahkan pengeluaran
function tambahPengeluaran($jumlah, $tanggal, $kategori_id) {
    global $conn;

    // Validasi untuk memastikan jumlah tidak negatif
    if ($jumlah <= 0) {
        return false; // Atau Anda dapat menggunakan pesan kesalahan
    }

    $stmt = $conn->prepare("INSERT INTO pengeluaran (jumlah, tanggal, kategori_id) VALUES (?, ?, ?)");
    $stmt->bind_param("dsi", $jumlah, $tanggal, $kategori_id);
    return $stmt->execute();
}

// Fungsi untuk mendapatkan semua pengeluaran
function getPengeluaran() {
    global $conn;
    $result = $conn->query("SELECT p.id, p.jumlah, p.tanggal, k.nama_kategori FROM pengeluaran p JOIN kategori k ON p.kategori_id = k.id");
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Fungsi untuk mendapatkan semua kategori
function getKategori() {
    global $conn;
    $result = $conn->query("SELECT * FROM kategori");
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getPengeluaranById($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM pengeluaran WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}


// Fungsi untuk menghitung total pengeluaran bulanan
function totalPengeluaranBulanan($bulan, $tahun) {
    global $conn;
    $stmt = $conn->prepare("SELECT SUM(jumlah) as total FROM pengeluaran WHERE MONTH(tanggal) = ? AND YEAR(tanggal) = ?");
    $stmt->bind_param("ii", $bulan, $tahun);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc()['total'];
}

// Fungsi untuk mengedit pengeluaran
function editPengeluaran($id, $jumlah, $tanggal, $kategori_id) {
    global $conn;

    // Validasi untuk memastikan jumlah tidak negatif saat edit
    if ($jumlah <= 0) {
        return false; // Atau Anda dapat menggunakan pesan kesalahan
    }

    $stmt = $conn->prepare("UPDATE pengeluaran SET jumlah = ?, tanggal = ?, kategori_id = ? WHERE id = ?");
    $stmt->bind_param("dsii", $jumlah, $tanggal, $kategori_id, $id);
    return $stmt->execute();
}

// Fungsi untuk menghapus pengeluaran
function hapusPengeluaran($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM pengeluaran WHERE id = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

// Fungsi untuk mengambil kategori berdasarkan id
function getKategoriById($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM kategori WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

// Fungsi untuk mengedit kategori
function editKategori($id, $nama_kategori) {
    global $conn;
    $stmt = $conn->prepare("UPDATE kategori SET nama_kategori = ? WHERE id = ?");
    $stmt->bind_param("si", $nama_kategori, $id);
    return $stmt->execute();
}

// Fungsi untuk menghapus kategori
function hapusKategori($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM kategori WHERE id = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}


?>
