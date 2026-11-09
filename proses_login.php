<?php
session_start();
include 'config/koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
$data = mysqli_fetch_assoc($query);

if ($data) {
    $_SESSION['user'] = $data['username'];

    if (isset($_POST['remember'])) {
        setcookie('remember_user', $username, time() + 86400, "/");
    } else {
        setcookie('remember_user', "", time() - 3600, "/");
    }

    header("Location: dashboard.php");
    exit;
} else {
    echo "<script>alert('Username atau Password salah!'); window.location='index.php';</script>";
}
?>