<?php
include "../koneksi/koneksi.php";

$id_kecamatan = isset($_POST['id_kecamatan']) ? intval($_POST['id_kecamatan']) : 0;

$options = '<option value="">-- Pilih Desa --</option>';
if ($id_kecamatan > 0) {
    $query = mysqli_query($koneksi, "SELECT * FROM desa WHERE id_kecamatan = $id_kecamatan ORDER BY nama_desa ASC");
    while ($row = mysqli_fetch_assoc($query)) {
        $options .= "<option value='{$row['id']}'>{$row['nama_desa']}</option>";
    }
}

echo $options;
