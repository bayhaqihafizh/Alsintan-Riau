<?php
include "koneksi/koneksi.php";


$id_kabupaten = isset($_POST['kabupaten']) ? intval($_POST['kabupaten']) : 0;
$id_kecamatan = isset($_POST['kecamatan']) ? intval($_POST['kecamatan']) : 0;
$id_desa      = isset($_POST['desa']) ? intval($_POST['desa']) : 0;


$sql = "SELECT a.*, d.nama_desa, k.nama_kecamatan, kab.nama_kabupaten
        FROM alsintan a
        INNER JOIN desa d ON a.id_desa = d.id
        INNER JOIN kecamatan k ON d.id_kecamatan = k.id
        INNER JOIN kabupaten kab ON k.id_kabupaten = kab.id
        WHERE 1=1";


if ($id_desa > 0) {
    $sql .= " AND a.id_desa = '$id_desa'";
} elseif ($id_kecamatan > 0) {
    $sql .= " AND k.id = '$id_kecamatan'";
} elseif ($id_kabupaten > 0) {
    $sql .= " AND kab.id = '$id_kabupaten'";
}
$sql .= " ORDER BY kab.nama_kabupaten, k.nama_kecamatan, d.nama_desa, a.nama_alat";
$result = mysqli_query($koneksi, $sql);


$rank_sql = "SELECT kab.nama_kabupaten, k.nama_kecamatan, d.nama_desa, SUM(a.jumlah) AS total_alsintan
             FROM alsintan a
             INNER JOIN desa d ON a.id_desa = d.id
             INNER JOIN kecamatan k ON d.id_kecamatan = k.id
             INNER JOIN kabupaten kab ON k.id_kabupaten = kab.id
             GROUP BY kab.id, k.id, d.id
             ORDER BY total_alsintan DESC";
$rank_result = mysqli_query($koneksi, $rank_sql);

$chart_labels = $chart_values = [];
if ($rank_result && mysqli_num_rows($rank_result) > 0) {
    while ($r = mysqli_fetch_assoc($rank_result)) {
        $chart_labels[] = $r['nama_kabupaten']." - ".$r['nama_kecamatan']." - ".$r['nama_desa'];
        $chart_values[] = (int)$r['total_alsintan'];
    }
}

$totalAlsintan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(jumlah) as total FROM alsintan"))['total'];
$baik = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(jumlah) as total FROM alsintan WHERE kondisi='Baik'"))['total'];
$rusakRingan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(jumlah) as total FROM alsintan WHERE kondisi='Rusak Ringan'"))['total'];
$rusakBerat = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(jumlah) as total FROM alsintan WHERE kondisi='Rusak Berat'"))['total'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>DATABASE ALSINTAN PROVINSI RIAU</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-success fixed-top shadow">
    <div class="container-fluid">
      <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="images/kementan.png" alt="Logo Kementan">
        <span class="header-title">DATABASE ALSINTAN PROVINSI RIAU</span>
      </a>
    </div>
  </nav>

  <main>
    <?php include "partials/statistik.php"; ?>
    <?php include "partials/filter.php"; ?>
    <?php include "partials/tabel.php"; ?>
    <?php include "partials/chart.php"; ?>
    <?php include "partials/ranking.php"; ?>
  </main>
  <?php include "partials/footer.php"; ?>
  <div class="modal fade" id="fotoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Foto Unit</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body text-center">
          <img id="fotoPreview" src="" alt="Foto Unit" class="img-fluid rounded shadow">
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script> 
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script> 
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script> 
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

  <script>
    var chartLabels = <?php echo json_encode($chart_labels); ?>;
    var chartValues = <?php echo json_encode($chart_values); ?>;
    var selectedKabupatenPHP = "<?php echo $id_kabupaten; ?>";
    var selectedKecamatanPHP = "<?php echo $id_kecamatan; ?>";
    var selectedDesaPHP = "<?php echo $id_desa; ?>";
  </script>
  <script src="assets/js/script.js"></script>
</body>
</html>
