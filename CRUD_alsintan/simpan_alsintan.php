<?php
include "../koneksi/koneksi.php";


$id_desa       = $_POST['id_desa'];
$nama_kelompok = $_POST['nama_kelompok'];
$nama_alat     = $_POST['nama_alat'];
$jenis         = $_POST['jenis'];
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
    $foto = basename($_FILES["foto"]["name"]); 
    $target_file = $target_dir . $foto;

    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
    } else {
        $foto = null;
    }
}


$sql = "INSERT INTO alsintan 
        (id_desa, nama_kelompok, nama_alat, jenis, jumlah, tahun, kondisi, foto, keterangan) 
        VALUES 
        ('$id_desa', '$nama_kelompok', '$nama_alat', '$jenis', '$jumlah', '$tahun', '$kondisi', '$foto', '$keterangan')";

if (mysqli_query($koneksi, $sql)) {
    echo "<script>
            alert('Data berhasil disimpan!');
            window.location='alsintan_form.php';
          </script>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
}

mysqli_close($koneksi);
?>
