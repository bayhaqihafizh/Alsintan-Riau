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
                        <div class="mb-3">
                            <label class="form-label">Kabupaten</label>
                            <select name="kabupaten" id="kabupaten" class="form-select">
                                <option value="">-- Pilih Kabupaten --</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kecamatan</label>
                            <select name="id_kecamatan" id="id_kecamatan" class="form-select">
                                <option value="">-- Pilih Kecamatan --</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Desa</label>
                            <select name="id_desa" id="id_desa" class="form-select">
                                <option value="">-- Pilih Desa --</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">PJ(Penanggung Jawab)</label>
                            <select name="nama_kelompok" class="form-select">
                                <option value="Brigade Alsintan">Brigade Alsintan</option>
                                <option value="TNI">TNI</option>
                                <option value="Petani(Pribadi)">Petani(Pribadi)</option>
                                <option value="Gapoktan">Gapoktan</option>
                                <option value="Poktan">Poktan</option>
                                <option value="UPJA">UPJA</option>
                                <option value="Brigade Pangan">Brigade Pangan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Alat</label>
                            <select name="nama_alat" id="nama_alat" class="form-control" required>
                                <option value="">-- Pilih Alat --</option>
                                <option value="Kultivator">Kultivator</option>
                                <option value="TR2">TR2</option>
                                <option value="TR2 Rotary">TR2 Rotary</option>
                                <option value="TR4">TR4</option>
                                <option value="Crawler dengan rantai besi">Crawler dengan rantai besi</option>
                                <option value="Alat semai benih dan Tanam">Alat semai benih dan Tanam</option>
                                <option value="Mesin Panen">Mesin Panen</option>
                                <option value="Pengering">Pengering</option>
                                <option value="Mesin Pompa Air(Inci)">Mesin Pompa Air(Inci)</option>
                                <option value="Mesin Potong Rumput">Mesin Potong Rumput</option>
                                <option value="Penggilingan Beras(RMU)">Penggilingan Beras(RMU)</option>
                            </select>
                        </div>

                        <!-- Field Merek (hidden by default, dropdown) -->
                        <div class="mb-3" id="field_merek" style="display:none;">
                            <label class="form-label">Merek</label>
                            <select name="merek" id="merek" class="form-control">
                                <option value="">-- Pilih Merek --</option>
                            </select>
                        </div>

                        <!-- Field Jenis (hidden by default, dropdown) -->
                        <div class="mb-3" id="field_jenis" style="display:none;">
                            <label class="form-label">Jenis</label>
                            <select name="jenis" id="jenis" class="form-control">
                                <option value="">-- Pilih Jenis --</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tahun</label>
                            <input type="number" name="tahun" min="2000" max="2099" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kondisi</label>
                            <select name="kondisi" class="form-select">
                                <option value="Baik">Baik</option>
                                <option value="Rusak Ringan">Rusak Ringan</option>
                                <option value="Rusak Berat">Rusak Berat</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Foto</label>
                            <input type="file" name="foto" class="form-control">
                        </div>
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

    // Pilihan jenis & merek
    const options = {
        "TR2": {
            merek: ["G 1000", "Quick", "Kubota", "Yanmar"],
            jenis: ["Bajak singkal tunggal", "Bajak singkal piringan", "Glebek", "Garu"]
        },
        "TR4": {
            merek: [],
            jenis: ["Bajak singkal piringan", "Rotavator (Rotary)"]
        },
        "Crawler dengan rantai besi": {
            merek: [],
            jenis: ["Bajak singkal", "Rotary"]
        },
        "Alat semai benih dan Tanam": {
            merek: [],
            jenis: ["Mesin pengisi benih di tray", "Walks Transplanter(tipe berjalan)", "Ride Transplanter(tipe dikendarai)", "Media semai(Tray)"]
        },
        "Mesin Panen": {
            merek: [],
            jenis: ["Combine Harvester", "Mini Combine Harvester(Mico/Tomcat)"]
        },
        "Pengering": {
            merek: [],
            jenis: ["Lantai jemur bangunan pengering(Dome)", "Pengering padi tipe kotak(Box Drayer)"]
        }
        // Tambahkan alat lain sesuai kebutuhan
    };

    // Atur tampil/hidden + required field merek & jenis
    $("#nama_alat").change(function(){
        var selected = $(this).val();

        // Reset & hide
        $("#field_merek").hide();
        $("#field_jenis").hide();
        $("#merek").prop("required", false).html("<option value=''>-- Pilih Merek --</option>");
        $("#jenis").prop("required", false).html("<option value=''>-- Pilih Jenis --</option>");

        // Kalau ada opsi di dalam object
        if(options[selected]){
            // cek merek
            if(options[selected].merek.length > 0){
                $("#field_merek").show();
                $("#merek").prop("required", true);
                options[selected].merek.forEach(function(item){
                    $("#merek").append(new Option(item, item));
                });
            }
            // cek jenis
            if(options[selected].jenis.length > 0){
                $("#field_jenis").show();
                $("#jenis").prop("required", true);
                options[selected].jenis.forEach(function(item){
                    $("#jenis").append(new Option(item, item));
                });
            }
        }
    });
});
</script>

