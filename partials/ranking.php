<div class="container mt-5">
  <h4 class="text-center">Ranking Desa/Kecamatan/Kabupaten berdasarkan jumlah Alsintan</h4>
  <div class="table-responsive">
    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>Peringkat</th>
          <th>Kabupaten</th>
          <th>Kecamatan</th>
          <th>Desa</th>
          <th>Total Alsintan</th>
        </tr>
      </thead>
      <tbody>
        <?php
        mysqli_data_seek($rank_result, 0); 
        $peringkat = 1;
        while ($r = mysqli_fetch_assoc($rank_result)) {
          echo "<tr>
                  <td>{$peringkat}</td>
                  <td>{$r['nama_kabupaten']}</td>
                  <td>{$r['nama_kecamatan']}</td>
                  <td>{$r['nama_desa']}</td>
                  <td>{$r['total_alsintan']}</td>
                </tr>";
          $peringkat++;
        }
        ?>
      </tbody>
    </table>
  </div>
</div>
