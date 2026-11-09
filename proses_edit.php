<?php
include 'config/koneksi.php';

$id           = $_POST['id'];
$judul_buku   = $_POST['judul_buku'];
$kategori     = $_POST['kategori'];
$penulis      = $_POST['penulis'];
$tahun_terbit = $_POST['tahun_terbit'];
$stok         = $_POST['stok'];
$sampul_lama  = $_POST['sampul_lama'];

$nama_file    = $_FILES['sampul']['name'];

if (!empty($nama_file)) {
    $ukuran_file  = $_FILES['sampul']['size'];
    $tmp_file     = $_FILES['sampul']['tmp_name'];
    $ekstensi     = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
    $ekstensi_valid = ['jpg', 'jpeg', 'png'];

    if (!in_array($ekstensi, $ekstensi_valid) || $ukuran_file > 2097152) {
        echo "<script>alert('File tidak valid atau lebih dari 2MB!'); window.location='edit_buku.php?id=$id';</script>";
        exit;
    }

    $nama_baru = uniqid() . '.' . $ekstensi;
    
    if (file_exists("uploads/" . $sampul_lama)) {
        unlink("uploads/" . $sampul_lama);
    }

    move_uploaded_file($tmp_file, "uploads/" . $nama_baru);
    $sampul_terbaru = $nama_baru;
} else {
    $sampul_terbaru = $sampul_lama;
}

$query = "UPDATE buku SET 
            judul_buku='$judul_buku', kategori='$kategori', penulis='$penulis', 
            tahun_terbit='$tahun_terbit', stok='$stok', sampul='$sampul_terbaru' 
          WHERE id='$id'";

if (mysqli_query($conn, $query)) {
    echo "<script>alert('Data berhasil diperbarui!'); window.location='dashboard.php';</script>";
}
?>