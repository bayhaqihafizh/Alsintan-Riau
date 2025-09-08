<?php
session_start();
include "../koneksi/koneksi.php";



$username = $_POST['username'];
$password = md5($_POST['password']);

$query = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$username' AND password='$password'");

if (mysqli_num_rows($query) > 0) {
    $_SESSION['admin'] = $username;
    header('Location: dashboard.php');
} else {
    header('Location: login.php?error=Username atau password salah!');
}
?>
