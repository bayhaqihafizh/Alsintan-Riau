<?php
include "../koneksi/koneksi.php";
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">
    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header bg-success text-white fw-bold">
            Form Input Data Alsintan
        </div>
        <div class="card-body">
            <form action="simpan_alsintan.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <!-- Kabupaten - Kecamatan - Desa -->
                        <div class="mb-3">
                            <label class="form-label">Kabupaten</label>
                            <select name="id_kabupaten" id="kabupaten" class="form-select" required>
                                <option value="">-- Pilih Kabupaten --</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kecamatan</label>
                            <select name="id_kecamatan" id="id_kecamatan" class="form-select" required>
                                <option value="">-- Pilih Kecamatan --</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Desa</label>
                            <select name="id_desa" id="id_desa" class="form-select" required>
                                <option value="">-- Pilih Desa --</option>
                            </select>
                        </div>

                        <!-- Kelompok -->
                        <div class="mb-3">
                            <label class="form-label">PJ (Penanggung Jawab)</label>
                            <select name="id_kelompok" class="form-select" required>
                                <option value="">-- Pilih Kelompok --</option>
                                <?php
                                $q = mysqli_query($koneksi, "SELECT * FROM kelompok ORDER BY nama_kelompok");
                                while ($row = mysqli_fetch_assoc($q)) {
                                    echo "<option value='{$row['id_kelompok']}'>{$row['nama_kelompok']}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Alat -->
                        <div class="mb-3">
                            <label class="form-label">Nama Alat</label>
                            <select name="id_alat" id="id_alat" class="form-select" required>
                                <option value="">-- Pilih Alat --</option>
                                <?php
                                $q = mysqli_query($koneksi, "SELECT * FROM alat ORDER BY nama_alat");
                                while ($row = mysqli_fetch_assoc($q)) {
                                    echo "<option value='{$row['id_alat']}'>{$row['nama_alat']}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Merek -->
                        <div class="mb-3" id="div_merek" style="display:none;">
                            <label class="form-label">Merek</label>
                            <select name="id_merek" id="id_merek" class="form-select">
                                <option value="">-- Pilih Merek --</option>
                                <?php
                                $q = mysqli_query($koneksi, "SELECT * FROM merek ORDER BY nama_merek");
                                while ($row = mysqli_fetch_assoc($q)) {
                                    echo "<option value='{$row['id_merek']}'>{$row['nama_merek']}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Jenis -->
                        <div class="mb-3" id="div_jenis" style="display:none;">
                            <label class="form-label">Jenis</label>
                            <select name="id_jenis" id="id_jenis" class="form-select">
                                <option value="">-- Pilih Jenis --</option>
                                <?php
                                $q = mysqli_query($koneksi, "SELECT * FROM jenis ORDER BY nama_jenis");
                                while ($row = mysqli_fetch_assoc($q)) {
                                    echo "<option value='{$row['id_jenis']}'>{$row['nama_jenis']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- Jumlah -->
                        <div class="mb-3">
                            <label class="form-label">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control" required>
                        </div>
                        <!-- Tahun -->
                        <div class="mb-3">
                            <label class="form-label">Tahun</label>
                            <input type="number" name="tahun" min="2000" max="2099" class="form-control" required>
                        </div>
                        <!-- Kondisi -->
                        <div class="mb-3">
                            <label class="form-label">Kondisi</label>
                            <select name="kondisi" class="form-select" required>
                                <option value="Baik">Baik</option>
                                <option value="Rusak Ringan">Rusak Ringan</option>
                                <option value="Rusak Berat">Rusak Berat</option>
                            </select>
                        </div>
                        <!-- Foto -->
                        <div class="mb-3">
                            <label class="form-label">Foto</label>
                            <input type="file" name="foto" class="form-control">
                        </div>
                        <!-- Keterangan -->
                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <textarea name="keterangan" class="form-control"></textarea>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center mt-4 gap-3">
                    <a href="dashboard.php" class="btn btn-secondary px-4">Kembali</a>
                    <button type="submit" class="btn btn-success px-4">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    // Ajax Kabupaten - Kecamatan - Desa
    $.ajax({
        type: 'GET',
        url: 'get_kabupaten.php',
        success: function(response){
            $('#kabupaten').html(response);
        }
    });

    $('#kabupaten').change(function(){
        var id_kabupaten = $(this).val();
        $.ajax({
            type: 'POST',
            url: 'get_kecamatan.php',
            data: {id_kabupaten: id_kabupaten},
            success: function(response){
                $('#id_kecamatan').html(response);
                $('#id_desa').html('<option value="">-- Pilih Desa --</option>');
            }
        });
    });

    $('#id_kecamatan').change(function(){
        var id_kecamatan = $(this).val();
        $.ajax({
            type: 'POST',
            url: 'get_desa.php',
            data: {id_kecamatan: id_kecamatan},
            success: function(response){
                $('#id_desa').html(response);
            }
        });
    });

    // Aturan tampilkan/hilangkan Merek & Jenis
    $('#id_alat').change(function(){
        var id_alat = $(this).val();

        // Default hide semua
        $("#div_merek").hide();
        $("#div_jenis").hide();

        if(id_alat == "3"){ 
            // TR2
            $("#div_merek").show();
            $("#div_jenis").show();
        }
        else if(["1","9","10","5","4"].includes(id_alat)){
            // TR4, Crawler, Alat semai, Mesin Panen, Pengering
            $("#div_jenis").show();
        }
        else if(["7","8","6","11","2"].includes(id_alat)){
            // Kultivator, TR2 Rotary, Mesin Pompa Air, Mesin Potong Rumput, Penggilingan Beras
            // tidak muncul apa-apa
        }
    });
});
</script>
