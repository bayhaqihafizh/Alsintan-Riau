<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi/koneksi.php";

// pastikan ada id
if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$id = $_GET['id'];

$sql = "SELECT foto FROM alsintan WHERE id='$id'";
$result = mysqli_query($koneksi, $sql) or die("Query error: " . mysqli_error($koneksi));

if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
    $foto = $data['foto'];

  
    $delete_sql = "DELETE FROM alsintan WHERE id='$id'";
    if (mysqli_query($koneksi, $delete_sql)) {
        
        if (!empty($foto) && file_exists("../uploads/" . $foto)) {
            unlink("../uploads/" . $foto);
        }
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Gagal hapus data: " . mysqli_error($koneksi);
    }
} else {
    echo "Data tidak ditemukan!";
}
?>
