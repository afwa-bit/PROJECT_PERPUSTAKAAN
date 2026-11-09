<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
include 'config/koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mini Digital Library</title>
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            min-height: 100vh;
        }
        /* Navbar Terang & Sinkron dengan Index */
        .navbar-custom {
            background: #ffffff !important;
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
        }
        .brand-box {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            color: #ffffff;
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.25);
        }
        /* Card Container Bersih & Elegan */
        .premium-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1.25rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
        }
        /* Tabel Modern Terang */
        .table-custom {
            --bs-table-bg: transparent;
            --bs-table-color: #1e293b;
            margin-bottom: 0;
        }
        .table-custom thead th {
            background: #f8fafc;
            color: #64748b;
            font-weight: 600;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            border-bottom: 1px solid #e2e8f0;
            padding: 1.1rem 1rem;
        }
        .table-custom tbody td {
            padding: 1.1rem 1rem;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
            font-size: 0.9rem;
        }
        .table-custom tbody tr:hover {
            background: #f8fafc;
        }
        .book-img {
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid #e2e8f0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        /* Tombol Tambah Buku Ala Index (Indigo Modern) */
        .btn-add-premium {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            color: #ffffff;
            border: none;
            font-weight: 600;
            padding: 0.65rem 1.25rem;
            border-radius: 0.75rem;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
            transition: all 0.2s ease;
        }
        .btn-add-premium:hover {
            background: linear-gradient(135deg, #4f46e5 100%, #4338ca 100%);
            color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 6px 15px rgba(99, 102, 241, 0.4);
        }
        /* Badge Status Rapi & Cerah */
        .badge-status-avail {
            background: rgba(34, 197, 94, 0.1);
            color: #16a34a;
            border: 1px solid rgba(34, 197, 94, 0.2);
            padding: 0.35rem 0.85rem;
            border-radius: 50rem;
            font-size: 0.75rem;
            font-weight: 700;
        }
        .badge-status-borrow {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
            border: 1px solid rgba(239, 68, 68, 0.2);
            padding: 0.35rem 0.85rem;
            border-radius: 50rem;
            font-size: 0.75rem;
            font-weight: 700;
        }
        .badge-category {
            background: #f1f5f9;
            color: #475569;
            border: 1px solid #e2e8f0;
            font-size: 0.75rem;
            padding: 0.35rem 0.75rem;
            border-radius: 6px;
            font-weight: 500;
        }
        /* Tombol Aksi */
        .btn-action {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            color: #64748b;
            width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        .btn-action-edit:hover {
            background: #fef08a;
            color: #854d0e;
            border-color: #fde047;
        }
        .btn-action-delete:hover {
            background: #fee2e2;
            color: #991b1b;
            border-color: #fecaca;
        }
        .user-pill {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 0.4rem 1rem;
            border-radius: 50rem;
        }
    </style>
</head>
<body>

    <!-- Navbar Cerah & Elegan -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top px-4 py-3">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold d-flex align-items-center text-dark text-decoration-none" href="#">
                <div class="brand-box me-2.5">
                    <i class="bi bi-book-half text-white"></i>
                </div>
                <span class="fs-6 tracking-tight fw-bold text-dark">Digital Library</span>
            </a>
            <div class="d-flex align-items-center">
                <div class="user-pill d-none d-md-flex align-items-center me-3">
                    <i class="bi bi-person-circle text-primary me-2"></i>
                    <span class="small text-muted">Halo, <strong class="text-dark"><?= htmlspecialchars($_SESSION['user']); ?></strong></span>
                </div>
                <a href="logout.php" class="btn btn-outline-danger btn-sm px-3 rounded-pill fw-semibold" style="font-size: 0.8rem;" onclick="return confirm('Yakin ingin keluar?')">
                    <i class="bi bi-box-arrow-right me-1"></i> Keluar
                </a>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <div class="container py-5">
        <div class="row align-items-center mb-4">
            <div class="col">
                <h2 class="fw-bold text-dark mb-1">Daftar Koleksi Buku</h2>
                <p class="text-muted small mb-0">Kelola inventaris perpustakaan digital dengan tampilan yang bersih dan profesional.</p>
            </div>
            <div class="col-auto">
                <a href="tambah_buku.php" class="btn btn-add-premium d-inline-flex align-items-center text-decoration-none small">
                    <i class="bi bi-plus-lg me-2"></i> Tambah Buku Baru
                </a>
            </div>
        </div>
        
        <div class="premium-card p-4">
            <div class="table-responsive">
                <table class="table table-custom align-middle">
                    <thead>
                        <tr>
                            <th class="ps-3">No</th>
                            <th>Sampul</th>
                            <th>Judul Buku</th>
                            <th>Kategori</th>
                            <th>Penulis</th>
                            <th>Tahun</th>
                            <th>Status Ketersediaan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $sql = mysqli_query($conn, "SELECT * FROM buku ORDER BY id DESC");
                        if ($sql) {
                            while ($row = mysqli_fetch_assoc($sql)) {
                                if ($row['stok'] > 0) {
                                    $status = '<span class="badge-status-avail">Tersedia</span>';
                                } else {
                                    $status = '<span class="badge-status-borrow">Dipinjam</span>';
                                }
                        ?>
                        <tr>
                            <td class="ps-3 text-secondary font-monospace small"><?= sprintf("%02d", $no++); ?></td>
                            <td>
                                <img src="uploads/<?= htmlspecialchars($row['sampul']); ?>" class="book-img" width="46" height="62">
                            </td>
                            <td>
                                <span class="fw-bold text-dark d-block"><?= htmlspecialchars($row['judul_buku']); ?></span>
                            </td>
                            <td><span class="badge badge-category"><?= htmlspecialchars($row['kategori']); ?></span></td>
                            <td class="text-muted small"><?= htmlspecialchars($row['penulis']); ?></td>
                            <td class="text-muted small font-monospace"><?= $row['tahun_terbit']; ?></td>
                            <td>
                                <?= $status; ?> 
                                <span class="text-muted small ms-2 font-monospace">(Stok: <?= $row['stok']; ?>)</span>
                            </td>
                            <td class="text-center">
                                <div class="d-inline-flex gap-1">
                                    <a href="edit_buku.php?id=<?= $row['id']; ?>" class="btn-action btn-action-edit" title="Edit Data">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="hapus_buku.php?id=<?= $row['id']; ?>" class="btn-action btn-action-delete" title="Hapus Data" onclick="return confirm('Yakin ingin menghapus data buku ini?')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
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