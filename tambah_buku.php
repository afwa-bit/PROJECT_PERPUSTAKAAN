<?php
session_start();
if (!isset($_SESSION['user'])) { header("Location: index.php"); exit; }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5" style="max-width: 600px;">
        <div class="card shadow p-4">
            <h3>Form Tambah Buku</h3>
            <form action="proses_tambah.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Judul Buku</label>
                    <input type="text" name="judul_buku" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <input type="text" name="kategori" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Penulis</label>
                    <input type="text" name="penulis" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tahun Terbit</label>
                    <input type="number" name="tahun_terbit" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stok" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Sampul Buku (.jpg / .png, Max 2MB)</label>
                    <input type="file" name="sampul" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</body>
</html>