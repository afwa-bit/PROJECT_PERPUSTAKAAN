<?php
include 'config/koneksi.php';

$judul_buku   = $_POST['judul_buku'];
$kategori     = $_POST['kategori'];
$penulis      = $_POST['penulis'];
$tahun_terbit = $_POST['tahun_terbit'];
$stok         = $_POST['stok'];

$nama_file    = $_FILES['sampul']['name'];
$ukuran_file  = $_FILES['sampul']['size'];
$tmp_file     = $_FILES['sampul']['tmp_name'];
$ekstensi     = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
$ekstensi_valid = ['jpg', 'jpeg', 'png'];

if (!in_array($ekstensi, $ekstensi_valid)) {
    echo "<script>alert('Ekstensi file harus .jpg atau .png!'); window.location='tambah_buku.php';</script>";
    exit;
}

if ($ukuran_file > 2097152) { // 2MB[cite: 2]
    echo "<script>alert('Ukuran file maksimal 2MB!'); window.location='tambah_buku.php';</script>";
    exit;
}

$nama_baru = uniqid() . '.' . $ekstensi;
$path = "uploads/" . $nama_baru;

if (move_uploaded_file($tmp_file, $path)) {
    $query = "INSERT INTO buku (judul_buku, kategori, penulis, tahun_terbit, stok, sampul) 
              VALUES ('$judul_buku', '$kategori', '$penulis', '$tahun_terbit', '$stok', '$nama_baru')";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location='dashboard.php';</script>";
    } else {
        echo "<script>alert('Gagal simpan database.'); window.location='tambah_buku.php';</script>";
    }
}
?>