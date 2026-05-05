<?php
require_once 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nama =trim($_POST['nama_barang'] ?? '');
    $kategori =trim($_POST['kategori'] ?? '');
    $jumlah = $_POST['jumlah'];
    $harga = $_POST['harga'];
    $lokasi =trim($_POST['lokasi'] ?? '');

    $stmt = $conn->prepare("INSERT INTO barang (nama_barang, kategori, jumlah, harga, lokasi) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssids", $nama, $kategori, $jumlah, $harga, $lokasi);

    if ($stmt->execute()) {
        header("Location: index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3>Tambah Produk Baru</h3>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <input type="text" name="kategori" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Jumlah</label>
                <input type="number" name="jumlah" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Harga</label>
                <input type="number" step="0.01" name="harga" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Lokasi</label>
                <input type="text" name="lokasi" class="form-control" required>
            </div>
            <button type="submit" name="submit" class="btn btn-success">Create</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
