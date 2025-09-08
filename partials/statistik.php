<div class="container mt-4">
  <div class="row g-4 text-center">
    <div class="col-6 col-md-3">
      <div class="card shadow border-0 rounded-3 bg-primary text-white card-stat">
        <div class="card-body">
          <i class="bi bi-gear-fill fs-1"></i>
          <h6 class="mt-2">Total Alsintan</h6>
          <h3><?= (int)$totalAlsintan ?></h3>
        </div>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <div class="card shadow border-0 rounded-3 bg-success text-white card-stat">
        <div class="card-body">
          <i class="bi bi-check-circle-fill fs-1"></i>
          <h6 class="mt-2">Kondisi Baik</h6>
          <h3><?= (int)$baik ?></h3>
        </div>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <div class="card shadow border-0 rounded-3 bg-warning text-dark card-stat">
        <div class="card-body">
          <i class="bi bi-exclamation-triangle-fill fs-1"></i>
          <h6 class="mt-2">Rusak Ringan</h6>
          <h3><?= (int)$rusakRingan ?></h3>
        </div>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <div class="card shadow border-0 rounded-3 bg-danger text-white card-stat">
        <div class="card-body">
          <i class="bi bi-x-octagon-fill fs-1"></i>
          <h6 class="mt-2">Rusak Berat</h6>
          <h3><?= (int)$rusakBerat ?></h3>
        </div>
      </div>
    </div>
  </div>
</div>
