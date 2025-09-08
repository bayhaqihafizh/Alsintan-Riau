<?php
include "../koneksi/koneksi.php";

$result = mysqli_query($koneksi, "SELECT * FROM kabupaten ORDER BY nama_kabupaten ASC");

echo "<option value=''>-- Pilih Kabupaten --</option>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<option value='".$row['id']."'>".$row['nama_kabupaten']."</option>";
}
?>
