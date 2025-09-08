<?php
include "../koneksi/koneksi.php";

$id_kabupaten = isset($_POST['id_kabupaten']) ? intval($_POST['id_kabupaten']) : 0;

$options = '<option value="">-- Pilih Kecamatan --</option>';
if ($id_kabupaten > 0) {
    $query = mysqli_query($koneksi, "SELECT * FROM kecamatan WHERE id_kabupaten = $id_kabupaten ORDER BY nama_kecamatan ASC");
    while ($row = mysqli_fetch_assoc($query)) {
        $options .= "<option value='{$row['id']}'>{$row['nama_kecamatan']}</option>";
    }
}

echo $options;
