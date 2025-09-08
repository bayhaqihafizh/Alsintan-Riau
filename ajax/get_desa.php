<?php
include "../koneksi/koneksi.php";

if (isset($_POST['id_kecamatan'])) {
    $id_kecamatan = $_POST['id_kecamatan'];

    $query = mysqli_query($koneksi, "SELECT * FROM desa WHERE id_kecamatan='$id_kecamatan' ORDER BY nama_desa ASC");

    echo '<option value="">-- Pilih Desa --</option>';
    while ($row = mysqli_fetch_assoc($query)) {
        echo '<option value="'.$row['id'].'">'.$row['nama_desa'].'</option>';
    }
}
?>
