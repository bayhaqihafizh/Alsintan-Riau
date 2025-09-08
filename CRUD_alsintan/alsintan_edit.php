<?php
include "../koneksi/koneksi.php";


if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$id = $_GET['id'];


$sql = "SELECT * FROM alsintan WHERE id='$id'";
$result = mysqli_query($koneksi, $sql) or die("Query error: " . mysqli_error($koneksi));

if (mysqli_num_rows($result) == 0) {
    echo "Data tidak ditemukan!";
    exit;
}

$data = mysqli_fetch_assoc($result);


if (isset($_POST['update'])) {
    $nama_kelompok = $_POST['nama_kelompok'];
    $nama_alat     = $_POST['nama_alat'];
    $jenis         = $_POST['jenis'];
    $jumlah        = $_POST['jumlah'];
    $tahun         = $_POST['tahun'];
    $kondisi       = $_POST['kondisi'];
    $keterangan    = $_POST['keterangan'];
    $foto_lama     = $_POST['foto_lama'];

    
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
                    nama_kelompok='$nama_kelompok',
                    nama_alat='$nama_alat',
                    jenis='$jenis',
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
                        <div class="mb-3">
                            <label class="form-label">Nama Kelompok</label>
                            <input type="text" name="nama_kelompok" value="<?= $data['nama_kelompok']; ?>" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Alat</label>
                            <input type="text" name="nama_alat" value="<?= $data['nama_alat']; ?>" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis</label>
                            <input type="text" name="jenis" value="<?= $data['jenis']; ?>" class="form-control" required>
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
