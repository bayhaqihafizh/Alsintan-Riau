<?php
include "../koneksi/koneksi.php";

$id_desa     = $_POST['id_desa'];
$id_kelompok = $_POST['id_kelompok']; // dropdown kelompok
$id_alat     = $_POST['id_alat'];     // dropdown alat
$id_merek    = isset($_POST['id_merek']) ? $_POST['id_merek'] : null; 
$id_jenis    = isset($_POST['id_jenis']) ? $_POST['id_jenis'] : null; 
$jumlah      = $_POST['jumlah'];
$tahun       = $_POST['tahun'];
$kondisi     = $_POST['kondisi'];
$keterangan  = $_POST['keterangan'];

$foto = null;
if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $target_dir  = "../uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    // kasih prefix waktu biar unik
    $foto =basename($_FILES["foto"]["name"]);
    $target_file = $target_dir . $foto;

    if (!move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
        $foto = null;
    }
}

// INSERT pakai field yang baru
$sql = "INSERT INTO alsintan 
        (id_desa, id_kelompok, id_alat, id_merek, id_jenis, jumlah, tahun, kondisi, foto, keterangan) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param(
    $stmt, 
    "iiiiisssss", 
    $id_desa, 
    $id_kelompok, 
    $id_alat, 
    $id_merek, 
    $id_jenis, 
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
