<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}
include "../koneksi/koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
.table {
    width: 100% !important;
    table-layout: auto !important;
    white-space: normal !important;
}

.table thead th {
    background-color: #198754 !important;
    color: #fff !important;
    text-align: center;
    vertical-align: middle;
    white-space: nowrap;
}

.table th, .table td {
    word-wrap: break-word;
    white-space: normal !important;
}

.navbar-brand img {
    height: 40px;
    margin-right: 10px;
}

/* responsive kecil */
@media (max-width: 768px) {
    .table th,
    .table td {
        font-size: 12px;
        padding: 6px;
    }
}

@media (max-width: 576px) {
    .table th,
    .table td {
        font-size: 11px;
    }
    .navbar-brand img {
        height: 30px;
    }
}
</style>
</head>
<body>

<nav class="navbar navbar-dark bg-success">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="../images/kementan.png" alt="Logo Kementan">
            <div class="card-header bg-success text-white fw-bold">
                Dashboard Admin
            </div>
        </a>
        <a href="logout.php" class="btn btn-outline-light">Logout</a>
    </div>
</nav>

<div class="container mt-4">
    <h4>Selamat datang, <?php echo htmlspecialchars($_SESSION['admin']); ?>!</h4>
    <p>Silakan kelola data alsintan di sini.</p>

    <a href="alsintan_form.php" class="btn btn-success mb-3">+ Input Data Alsintan</a>

    <table class="table table-bordered table-striped align-middle text-center w-100">
        <thead>
            <tr>
                <th>No</th>
                <th>Kabupaten</th>
                <th>Kecamatan</th>
                <th>Desa</th>
                <th>Nama Kelompok</th>
                <th>Nama Alat</th>
                <th>Merek</th>
                <th>Jenis</th>
                <th>Jumlah</th>
                <th>Tahun</th>
                <th>Kondisi</th>
                <th>Keterangan</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $no = 1;
            // Query sudah JOIN ke tabel referensi lalu beri alias AS agar field tetap konsisten
            $sql = "SELECT a.*,
                           d.nama_desa,
                           k.nama_kecamatan,
                           kab.nama_kabupaten,
                           kl.nama_kelompok AS nama_kelompok,
                           al.nama_alat     AS nama_alat,
                           m.nama_merek     AS nama_merek,
                           j.nama_jenis     AS nama_jenis
                    FROM alsintan a
                    INNER JOIN desa d ON a.id_desa = d.id
                    INNER JOIN kecamatan k ON d.id_kecamatan = k.id
                    INNER JOIN kabupaten kab ON k.id_kabupaten = kab.id
                    LEFT JOIN kelompok kl ON a.id_kelompok = kl.id_kelompok
                    LEFT JOIN alat al ON a.id_alat = al.id_alat
                    LEFT JOIN merek m ON a.id_merek = m.id_merek
                    LEFT JOIN jenis j ON a.id_jenis = j.id_jenis
                    ORDER BY a.id DESC";

            $result = mysqli_query($koneksi, $sql) or die("Query error: " . mysqli_error($koneksi));

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // Siapkan value aman
                    $nama_kab   = htmlspecialchars($row['nama_kabupaten'] ?? '-');
                    $nama_kec   = htmlspecialchars($row['nama_kecamatan'] ?? '-');
                    $nama_desa  = htmlspecialchars($row['nama_desa'] ?? '-');
                    $nama_kel   = htmlspecialchars($row['nama_kelompok'] ?? '-');
                    $nama_alat  = htmlspecialchars($row['nama_alat'] ?? '-');
                    $merek      = htmlspecialchars($row['nama_merek'] ?? '-');
                    $jenis      = htmlspecialchars($row['nama_jenis'] ?? '-');
                    $jumlah     = (int)($row['jumlah'] ?? 0);
                    $tahun      = htmlspecialchars($row['tahun'] ?? '-');
                    $kondisi    = $row['kondisi'] ?? '-';
                    $keterangan = htmlspecialchars($row['keterangan'] ?? '-');
                    $foto       = htmlspecialchars($row['foto'] ?? '');
                    $id         = (int)$row['id'];

                    echo "<tr>";
                    echo "<td>".$no++."</td>";
                    echo "<td>".$nama_kab."</td>";
                    echo "<td>".$nama_kec."</td>";
                    echo "<td>".$nama_desa."</td>";
                    echo "<td>".$nama_kel."</td>";
                    echo "<td><strong>".$nama_alat."</strong></td>";
                    echo "<td>".$merek."</td>";
                    echo "<td>".$jenis."</td>";
                    echo "<td><span class='badge bg-primary'>".$jumlah."</span></td>";
                    echo "<td>".$tahun."</td>";
                    echo "<td>";
                        if ($kondisi === "Baik") {
                            echo "<span class='badge bg-success'>Baik</span>";
                        } elseif ($kondisi === "Rusak Ringan") {
                            echo "<span class='badge bg-warning text-dark'>Rusak Ringan</span>";
                        } elseif ($kondisi === "Rusak Berat") {
                            echo "<span class='badge bg-danger'>Rusak Berat</span>";
                        } else {
                            echo "<span class='badge bg-secondary'>-</span>";
                        }
                    echo "</td>";
                    echo "<td>".$keterangan."</td>";
                    echo "<td>";
                    if (!empty($foto)) {
                        // link ke modal yang unik per id
                        echo "<a href='#' data-bs-toggle='modal' data-bs-target='#fotoModal".$id."'>".$foto."</a>";

                        echo "
                        <div class='modal fade' id='fotoModal".$id."' tabindex='-1'>
                          <div class='modal-dialog modal-dialog-centered'>
                            <div class='modal-content'>
                              <div class='modal-header'>
                                <h5 class='modal-title'>Foto: ".$foto."</h5>
                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                              </div>
                              <div class='modal-body text-center'>
                                <img src='../uploads/".$foto."' class='img-fluid rounded shadow' alt='Foto'>
                              </div>
                            </div>
                          </div>
                        </div>";
                    } else {
                        echo "-";
                    }
                    echo "</td>";
                    echo "<td>
                            <a href='alsintan_edit.php?id=".$id."' class='btn btn-sm btn-warning'>Edit</a>
                            <a href='alsintan_delete.php?id=".$id."' class='btn btn-sm btn-danger' onclick=\"return confirm('Yakin hapus data ini?');\">Delete</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='14' class='text-center'>Belum ada data alsintan</td></tr>";
            }
        ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
