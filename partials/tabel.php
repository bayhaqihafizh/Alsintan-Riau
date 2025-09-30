<div class="container my-4">
  <div class="card shadow-sm">
    <div class="card-header bg-success text-white">
      <h5 class="mb-0"><i class="bi bi-table"></i> Data Alsintan</h5>
    </div>
    <div class="card-body table-responsive">
      <table id="alsintanTable" class="table table-bordered table-hover align-middle">
        <thead class="table-light">
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
          </tr>
        </thead>
        <tbody>
          <?php if ($result && mysqli_num_rows($result) > 0): ?>
            <?php $no = 1; ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
              <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama_kabupaten']) ?></td>
                <td><?= htmlspecialchars($row['nama_kecamatan']) ?></td>
                <td><?= htmlspecialchars($row['nama_desa']) ?></td>
                <td><?= htmlspecialchars($row['nama_kelompok'] ?? '-') ?></td>
                <td><strong><?= htmlspecialchars($row['nama_alat']) ?></strong></td>
                <td><?= htmlspecialchars($row['merek'] ?? '-') ?></td>
                <td><?= htmlspecialchars($row['jenis'] ?? '-') ?></td>
                <td class="text-center"><span class="badge bg-primary"><?= (int)$row['jumlah'] ?></span></td>
                <td class="text-center"><?= htmlspecialchars($row['tahun']) ?></td>
                <td>
                  <?php if ($row['kondisi'] === "Baik"): ?>
                    <span class="badge bg-success">Baik</span>
                  <?php elseif ($row['kondisi'] === "Rusak Ringan"): ?>
                    <span class="badge bg-warning text-dark">Rusak Ringan</span>
                  <?php elseif ($row['kondisi'] === "Rusak Berat"): ?>
                    <span class="badge bg-danger">Rusak Berat</span>
                  <?php else: ?>
                    <span class="badge bg-secondary">-</span>
                  <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($row['keterangan'] ?? '-') ?></td>
                <td class="text-center">
                  <?php if (!empty($row['foto'])): ?>
                    <a href="#"
                       class="filename-link"
                       data-src="uploads/<?= rawurlencode($row['foto']) ?>"
                       onclick="showFoto(this.dataset.src); return false;">
                      <?= htmlspecialchars($row['foto']) ?>
                    </a>
                  <?php else: ?>
                    <span class="text-muted">-</span>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr><td colspan="13" class="text-center">Tidak ada data</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>