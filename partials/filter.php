<div class="container form-section">
  <h4 class="mb-4">Filter Data Alsintan</h4>
  <form id="form-alsintan" method="POST" action="">
    <div class="row g-3">
      <div class="col-md-4">
        <label for="kabupaten" class="form-label">Kabupaten</label>
        <select name="kabupaten" id="kabupaten" class="form-select">
          <option value="">-- Pilih Kabupaten --</option>
          <?php
          $kabupaten = mysqli_query($koneksi, "SELECT * FROM kabupaten ORDER BY nama_kabupaten ASC");
          while ($row = mysqli_fetch_assoc($kabupaten)) {
              $selected = ($row['id'] == $id_kabupaten) ? "selected" : "";
              echo "<option value='".$row['id']."' $selected>".$row['nama_kabupaten']."</option>";
          }
          ?>
        </select>
      </div>
      <div class="col-md-4">
        <label for="kecamatan" class="form-label">Kecamatan</label>
        <select name="kecamatan" id="kecamatan" class="form-select">
          <option value="">-- Pilih Kecamatan --</option>
        </select>
      </div>
      <div class="col-md-4">
        <label for="desa" class="form-label">Desa/Kelurahan</label>
        <select name="desa" id="desa" class="form-select">
          <option value="">-- Pilih Desa --</option>
        </select>
      </div>
    </div>
    <div class="text-end mt-4">
      <button type="submit" class="btn btn-success">Filter Data</button>
    </div>
  </form>
</div>
