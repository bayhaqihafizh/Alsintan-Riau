<?php
include "../koneksi/koneksi.php";
?>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


<script>
    const jenisOptions = {
        "TR2": [
            "Traktor Roda 2 Manual",
            "Traktor Roda 2 Mesin Diesel",
            "Traktor Roda 2 dengan Sistem Hidrolik",
            "Traktor Roda 2 Elektrik",
            "Traktor Roda 2 Multiguna"
        ],
        "TR4": [
            "Traktor Roda 4 (Four-Wheel Drive Tractor)",
            "Traktor dengan Bajak Singkal",
            "Traktor dengan Cultivator",
            "Traktor dengan Mesin Penanam (Seeder/Planter)"
        ],
        "Crawler": [
            "Bulldozer Crawler",
            "Excavator Crawler",
            "Loader Crawler"
        ],
        "Pompa": [
            "Pompa Air Diesel",
            "Pompa Air Elektrik",
            "Pompa Air Solar"
        ],
        "Combine": [
            "Combine Harvester Padi",
            "Combine Harvester Jagung",
            "Mini Combine Harvester"
        ],
        "Power Thresher": [
            "Power Thresher Manual",
            "Power Thresher Semi Otomatis",
            "Power Thresher Otomatis"
        ]
    };

    function updateJenis() {
        const namaAlat = document.getElementById("nama_alat").value;
        const jenisSelect = document.getElementById("jenis");
        jenisSelect.innerHTML = "<option value=''>-- Pilih Jenis --</option>";

        if (jenisOptions[namaAlat]) {
            jenisOptions[namaAlat].forEach(function(item) {
                let option = document.createElement("option");
                option.value = item;
                option.text = item;
                jenisSelect.appendChild(option);
            });
        }
    }
</script>


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
                            <label class="form-label">Nama Kelompok</label>
                            <select name="nama_kelompok" class="form-select">
                                <option value="Gapoktan">Gapoktan</option>
                                <option value="Poktan">Poktan</option>
                                <option value="UPJA">UPJA</option>
                                <option value="Brigade Pangan">Brigade Pangan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Alat</label>
                            <select name="nama_alat" id="nama_alat" class="form-control" onchange="updateJenis()" required>
                                <option value="">-- Pilih Alat --</option>
                                <option value="TR2">TR2</option>
                                <option value="TR4">TR4</option>
                                <option value="Crawler">Crawler</option>
                                <option value="Pompa">Pompa</option>
                                <option value="Combine">Combine</option>
                                <option value="Power Thresher">Power Thresher</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis</label>
                            <select name="jenis" id="jenis" class="form-control" required>
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
});

</script>
