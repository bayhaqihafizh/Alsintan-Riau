<?php
include "../koneksi/koneksi.php";

if (isset($_POST['id_desa'])) {
    $id_desa = intval($_POST['id_desa']);
    $query = mysqli_query($koneksi, "SELECT id, nama_kelompok FROM kelompok WHERE id_desa='$id_desa' ORDER BY nama_kelompok ASC");
    
    echo '<option value="">-- Pilih Kelompok --</option>';
    while ($row = mysqli_fetch_assoc($query)) {
        echo '<option value="'.$row['id'].'">'.$row['nama_kelompok'].'</option>';
    }
}
?>
