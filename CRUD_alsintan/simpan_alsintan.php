<?php
include "../koneksi/koneksi.php";

$id_desa       = $_POST['id_desa'];
$nama_kelompok = $_POST['nama_kelompok'];
$nama_alat     = $_POST['nama_alat'];
$merek         = isset($_POST['merek']) ? $_POST['merek'] : null; // tambah merek
$jenis         = isset($_POST['jenis']) ? $_POST['jenis'] : null; // jenis bisa kosong
$jumlah        = $_POST['jumlah'];
$tahun         = $_POST['tahun'];
$kondisi       = $_POST['kondisi'];
$keterangan    = $_POST['keterangan'];

$foto = null;
if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $target_dir  = "../uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $foto = basename($_FILES["foto"]["name"]); // kasih prefix biar unik
    $target_file = $target_dir . $foto;

    if (!move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
        $foto = null;
    }
}

// Gunakan prepared statement biar lebih aman
$sql = "INSERT INTO alsintan 
        (id_desa, nama_kelompok, nama_alat, merek, jenis, jumlah, tahun, kondisi, foto, keterangan) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param($stmt, "issssissss", 
    $id_desa, 
    $nama_kelompok, 
    $nama_alat, 
    $merek, 
    $jenis, 
    $jumlah, 
    $tahun, 
    $kondisi, 
    $foto, 
    $keterangan
);

if (mysqli_stmt_execute($stmt)) {
    echo "<script>
            alert('Data berhasil disimpan!');
            window.location='alsintan_form.php';
          </script>";
} else {
    echo "Error: " . mysqli_error($koneksi);
}

mysqli_stmt_close($stmt);
mysqli_close($koneksi);
?>
