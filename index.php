<?php include 'config/database.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>T4-week10 - Daftar Inventaris</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Daftar Inventaris Barang</h2>
        <a href="create.php" class="btn btn-primary">Tambah Barang</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Lokasi</th>
                <th>Waktu Input</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM barang ORDER BY id DESC";
            $result = mysqli_query($conn, $query);
            $no = 1;
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                    <td>$no</td>
                    <td>" . htmlspecialchars($row['nama_barang']) . "</td>
                    <td>" . htmlspecialchars($row['kategori']) . "</td>
                    <td>{$row['jumlah']}</td>
                    <td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
                    <td>" . htmlspecialchars($row['lokasi']) . "</td>
                    <td>{$row['created_at']}</td>
                    <td>
                        <a href='edit.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='delete.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>Hapus</a>
                    </td>
                </tr>";
                $no++;
            }
            ?>
        </tbody>
    </table>
</body>
</html>