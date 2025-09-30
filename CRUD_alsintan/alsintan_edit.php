<?php
include "../koneksi/koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$id = $_GET['id'];

// Ambil data utama
$sql = "SELECT * FROM alsintan WHERE id='$id'";
$result = mysqli_query($koneksi, $sql) or die("Query error: " . mysqli_error($koneksi));
if (mysqli_num_rows($result) == 0) {
    echo "Data tidak ditemukan!";
    exit;
}
$data = mysqli_fetch_assoc($result);

// --- Ambil pilihan dropdown dari tabel referensi ---
$kelompok_q = mysqli_query($koneksi, "SELECT * FROM kelompok ORDER BY nama_kelompok");
$alat_q     = mysqli_query($koneksi, "SELECT * FROM alat ORDER BY nama_alat");
$merek_q    = mysqli_query($koneksi, "SELECT * FROM merek ORDER BY nama_merek");
$jenis_q    = mysqli_query($koneksi, "SELECT * FROM jenis ORDER BY nama_jenis");





if (isset($_POST['update'])) {
    $id_kelompok    = $_POST['id_kelompok'];
    $id_alat        = $_POST['id_alat'];
    $id_merek       = $_POST['id_merek'];
    $id_jenis       = $_POST['id_jenis'];
    $jumlah         = $_POST['jumlah'];
    $tahun          = $_POST['tahun'];
    $kondisi        = $_POST['kondisi'];
    $keterangan     = $_POST['keterangan'];
    $foto_lama      = $_POST['foto_lama'];

    if (!empty($_FILES['foto']['name'])) {
        $targetDir = "../uploads/";
        $fileName = basename($_FILES["foto"]["name"]);
        $targetFile = $targetDir . $fileName;

        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFile)) {
            $foto = $fileName;
            if (!empty($foto_lama) && file_exists("../uploads/" . $foto_lama)) {
                unlink("../uploads/" . $foto_lama);
            }
        } else {
            $foto = $foto_lama;
        }
    } else {
        $foto = $foto_lama;
    }

    $sql_update = "UPDATE alsintan SET 
                id_kelompok='$id_kelompok',
                id_alat='$id_alat',
                id_merek='$id_merek',
                id_jenis='$id_jenis',
                jumlah='$jumlah',
                tahun='$tahun',
                kondisi='$kondisi',
                keterangan='$keterangan',
                foto='$foto'
              WHERE id='$id'";

    if (mysqli_query($koneksi, $sql_update)) {
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Alsintan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h5>Edit Data Alsintan</h5>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <!-- Nama Kelompok -->
                        <div class="mb-3">
                            <label class="form-label">PJ(Penanggung Jawab)</label>
                            <select name="id_kelompok" class="form-control" required>
                                <option value="">-- Pilih Kelompok --</option>
                                <?php while ($row = mysqli_fetch_assoc($kelompok_q)) { ?>
                                    <option value="<?= $row['id_kelompok']; ?>" 
                                        <?= ($data['id_kelompok'] == $row['id_kelompok']) ? 'selected' : ''; ?>>
                                        <?= $row['nama_kelompok']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <!-- Nama Alat -->
                        <div class="mb-3">
                            <label class="form-label">Nama Alat</label>
                            <select name="id_alat" class="form-control" required>
                                <option value="">-- Pilih Alat --</option>
                                <?php while ($row = mysqli_fetch_assoc($alat_q)) { ?>
                                    <option value="<?= $row['id_alat']; ?>" 
                                        <?= ($data['id_alat'] == $row['id_alat']) ? 'selected' : ''; ?>>
                                        <?= $row['nama_alat']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <!-- Merek -->
                        <div class="mb-3">
                            <label class="form-label">Merek</label>
                            <select name="id_merek" class="form-control">
                                <option value="">-- Pilih Merek --</option>
                                <?php while ($row = mysqli_fetch_assoc($merek_q)) { ?>
                                    <option value="<?= $row['id_merek']; ?>" 
                                        <?= ($data['id_merek'] == $row['id_merek']) ? 'selected' : ''; ?>>
                                        <?= $row['nama_merek']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <!-- Jenis -->
                        <div class="mb-3">
                            <label class="form-label">Jenis</label>
                            <select name="id_jenis" class="form-control">
                                <option value="">-- Pilih Jenis --</option>
                                <?php while ($row = mysqli_fetch_assoc($jenis_q)) { ?>
                                    <option value="<?= $row['id_jenis']; ?>" 
                                        <?= ($data['id_jenis'] == $row['id_jenis']) ? 'selected' : ''; ?>>
                                        <?= $row['nama_jenis']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jumlah</label>
                            <input type="number" name="jumlah" value="<?= $data['jumlah']; ?>" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Tahun</label>
                            <input type="number" name="tahun" value="<?= $data['tahun']; ?>" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kondisi</label>
                            <select name="kondisi" class="form-control" required>
                                <option value="Baik" <?= ($data['kondisi'] == 'Baik') ? 'selected' : ''; ?>>Baik</option>
                                <option value="Rusak Ringan" <?= ($data['kondisi'] == 'Rusak Ringan') ? 'selected' : ''; ?>>Rusak Ringan</option>
                                <option value="Rusak Berat" <?= ($data['kondisi'] == 'Rusak Berat') ? 'selected' : ''; ?>>Rusak Berat</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <textarea name="keterangan" class="form-control"><?= $data['keterangan']; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Foto</label><br>
                            <?php if (!empty($data['foto'])): ?>
                                <img src="../uploads/<?= $data['foto']; ?>" alt="Foto" class="img-thumbnail mb-2" width="120">
                            <?php endif; ?>
                            <input type="file" name="foto" class="form-control">
                            <input type="hidden" name="foto_lama" value="<?= $data['foto']; ?>">
                        </div>
                    </div>
                </div>

                <button type="submit" name="update" class="btn btn-success">Simpan Perubahan</button>
                <a href="dashboard.php" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

</body>
</html>
