<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
// Pastikan file koneksi ini ada di dalam folder config/koneksi.php
include 'config/koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mini Digital Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .navbar { background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%) !important; }
        .card { border: none; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }
        .table img { border-radius: 6px; object-fit: cover; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark px-4 py-3 shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#"><i class="bi bi-book-half me-2"></i>Mini Digital Library</a>
            <div class="d-flex align-items-center">
                <span class="text-light me-3 small"><i class="bi bi-person-circle me-1"></i> Halo, <strong><?= htmlspecialchars($_SESSION['user']); ?></strong></span>
                <a href="logout.php" class="btn btn-outline-light btn-sm px-3 rounded-pill" onclick="return confirm('Yakin ingin keluar?')">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row align-items-center mb-4">
            <div class="col">
                <h2 class="fw-bold text-dark mb-1">Daftar Koleksi Buku</h2>
                <p class="text-muted small mb-0">Kelola data buku perpustakaan, stok, dan status ketersediaan dengan mudah.</p>
            </div>
            <div class="col-auto">
                <a href="tambah_buku.php" class="btn btn-primary px-3 shadow-sm"><i class="bi bi-plus-lg me-1"></i> Tambah Buku Baru</a>
            </div>
        </div>
        
        <div class="card shadow-sm p-4 bg-white">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-secondary text-uppercase fs-7">
                        <tr>
                            <th class="py-3">No</th>
                            <th class="py-3">Sampul</th>
                            <th class="py-3">Judul Buku</th>
                            <th class="py-3">Kategori</th>
                            <th class="py-3">Penulis</th>
                            <th class="py-3">Tahun</th>
                            <th class="py-3">Status Ketersediaan</th>
                            <th class="py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $sql = mysqli_query($conn, "SELECT * FROM buku ORDER BY id DESC");
                        if ($sql) {
                            while ($row = mysqli_fetch_assoc($sql)) {
                                if ($row['stok'] > 0) {
                                    $status = '<span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-semibold">Tersedia</span>';
                                } else {
                                    $status = '<span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill fw-semibold">Dipinjam</span>';
                                }
                        ?>
                        <tr>
                            <td class="fw-semibold text-secondary"><?= $no++; ?></td>
                            <td>
                                <img src="uploads/<?= htmlspecialchars($row['sampul']); ?>" width="45" height="60">
                            </td>
                            <td class="fw-bold text-dark"><?= htmlspecialchars($row['judul_buku']); ?></td>
                            <td><span class="badge bg-light text-dark border"><?= htmlspecialchars($row['kategori']); ?></span></td>
                            <td class="text-muted"><?= htmlspecialchars($row['penulis']); ?></td>
                            <td class="text-muted"><?= $row['tahun_terbit']; ?></td>
                            <td>
                                <?= $status; ?> 
                                <span class="text-muted small ms-1">(Stok: <?= $row['stok']; ?>)</span>
                            </td>
                            <td class="text-center">
                                <a href="edit_buku.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm text-white px-2 me-1 shadow-sm" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                <a href="hapus_buku.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm px-2 shadow-sm" title="Hapus" onclick="return confirm('Yakin ingin menghapus data buku ini?')"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                        <?php 
                            }
                        } 
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>