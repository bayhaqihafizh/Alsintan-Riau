<?php
include "../koneksi/koneksi.php";

if (isset($_POST['id_kabupaten'])) {
    $id_kabupaten = $_POST['id_kabupaten'];

    $query = mysqli_query($koneksi, "SELECT * FROM kecamatan WHERE id_kabupaten='$id_kabupaten' ORDER BY nama_kecamatan ASC");

    echo '<option value="">-- Pilih Kecamatan --</option>';
    while ($row = mysqli_fetch_assoc($query)) {
        echo '<option value="'.$row['id'].'">'.$row['nama_kecamatan'].'</option>';
    }
}
?>
