<?php
include "../koneksi/koneksi.php";
$id_gapoktan = $_POST['id_gapoktan'];
$q = mysqli_query($koneksi, "SELECT * FROM poktan WHERE id_gapoktan='$id_gapoktan' ORDER BY nama_poktan ASC");
echo "<option value=''>-- Pilih Poktan --</option>";
while ($p = mysqli_fetch_assoc($q)) {
    echo "<option value='".$p['id']."'>".$p['nama_poktan']."</option>";
}
?>
