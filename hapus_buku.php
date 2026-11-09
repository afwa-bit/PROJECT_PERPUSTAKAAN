<?php
include 'config/koneksi.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT sampul FROM buku WHERE id='$id'"));
$nama_file = $data['sampul'];

if (file_exists("uploads/" . $nama_file)) {
    unlink("uploads/" . $nama_file);
}

mysqli_query($conn, "DELETE FROM buku WHERE id='$id'");
echo "<script>alert('Data berhasil dihapus!'); window.location='dashboard.php';</script>";
?>