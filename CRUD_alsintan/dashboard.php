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
        .table thead th {
            background-color: #198754 !important;
            color: #fff !important;
            text-align: center;
            vertical-align: middle;
        }
        .navbar-brand img {
            height: 40px;
            margin-right: 10px;
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
    <h4>Selamat datang, <?= $_SESSION['admin']; ?>!</h4>
    <p>Silakan kelola data alsintan di sini.</p>

    <a href="alsintan_form.php" class="btn btn-success mb-3">+ Input Data Alsintan</a>
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kelompok</th>
                    <th>Nama Alat</th>
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
                $sql = "SELECT * FROM alsintan ORDER BY id DESC";
                $result = mysqli_query($koneksi, $sql) or die("Query error: " . mysqli_error($koneksi));

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>".$no++."</td>
                            <td>".$row['nama_kelompok']."</td>
                            <td>".$row['nama_alat']."</td>
                            <td>".$row['jenis']."</td>
                            <td>".$row['jumlah']."</td>
                            <td>".$row['tahun']."</td>
                            <td>".$row['kondisi']."</td>
                            <td>".$row['keterangan']."</td>
                            <td>";

                        if (!empty($row['foto'])) {
                            echo "<a href='#' data-bs-toggle='modal' data-bs-target='#fotoModal".$row['id']."'>".$row['foto']."</a>";

                            echo "
                            <div class='modal fade' id='fotoModal".$row['id']."' tabindex='-1'>
                              <div class='modal-dialog modal-dialog-centered'>
                                <div class='modal-content'>
                                  <div class='modal-header'>
                                    <h5 class='modal-title'>Foto: ".$row['foto']."</h5>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                  </div>
                                  <div class='modal-body text-center'>
                                    <img src='../uploads/".$row['foto']."' class='img-fluid'>
                                  </div>
                                </div>
                              </div>
                            </div>";
                        } else {
                            echo "-";
                        }

                        echo "</td>
                            <td>
                                <a href='alsintan_edit.php?id=".$row['id']."' class='btn btn-sm btn-warning'>Edit</a>
                                <a href='alsintan_delete.php?id=".$row['id']."' class='btn btn-sm btn-danger' onclick=\"return confirm('Yakin hapus data ini?');\">Delete</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='10' class='text-center'>Belum ada data alsintan</td></tr>";
                }
            ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
