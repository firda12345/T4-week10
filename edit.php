<?php 
require_once 'config/database.php'; 

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $result = mysqli_query($conn, "SELECT * FROM barang WHERE id = '$id'");
    $data = mysqli_fetch_assoc($result);

    if (!$data) {
        die("Data tidak ditemukan!");
    }
} else {
    header("Location: index.php");
    exit;
}

if (isset($_POST['update'])) {
    $nama     = htmlspecialchars($_POST['nama_barang']);
    $kategori = htmlspecialchars($_POST['kategori']);
    $jumlah   = $_POST['jumlah'];
    $harga    = $_POST['harga'];
    $lokasi   = htmlspecialchars($_POST['lokasi']);

    $stmt = $conn->prepare("UPDATE barang SET nama_barang=?, kategori=?, jumlah=?, harga=?, lokasi=? WHERE id=?");
    $stmt->bind_param("ssidsi", $nama, $kategori, $jumlah, $harga, $lokasi, $id);
    
    if ($stmt->execute()) {
        header("Location: index.php");
        exit; 
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <div class="card shadow-sm p-4">
        <h3>Edit Data Barang</h3>
        <hr>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" value="<?= $data['nama_barang']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <input type="text" name="kategori" class="form-control" value="<?= $data['kategori']; ?>" required>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" value="<?= $data['jumlah']; ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Harga Satuan</label>
                    <input type="number" step="0.01" name="harga" class="form-control" value="<?= $data['harga']; ?>" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Lokasi Penyimpanan</label>
                <input type="text" name="lokasi" class="form-control" value="<?= $data['lokasi']; ?>">
            </div>
            <button type="submit" name="update" class="btn btn-warning">Upadate</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>