// === Modal Foto ===
function showFoto(src) {
  document.getElementById('fotoPreview').src = src;
  const fotoModalEl = document.getElementById('fotoModal');
  const modal = new bootstrap.Modal(fotoModalEl);
  modal.show();
}


$(document).ready(function () {
  // === DataTable ===
  $('#alsintanTable').DataTable({
    pageLength: 10,
    lengthMenu: [5, 10, 25, 50, 100],
    order: [],
    dom: 'Bfrtip', 
    buttons: [     
        {
            extend: 'excelHtml5',
            text: '<i class="bi bi-file-earmark-excel"></i> Download Excel',
            className: 'btn btn-success btn-sm'
        },
        {
            extend: 'pdfHtml5',
            text: '<i class="bi bi-file-earmark-pdf"></i> Download PDF',
            className: 'btn btn-danger btn-sm',
            orientation: 'landscape',
            pageSize: 'A4',
            exportOptions: {
                columns: ':visible'
            }
        }
    ],
    language: {
      search: "Cari:",
      lengthMenu: "Tampilkan _MENU_ data per halaman",
      zeroRecords: "Tidak ada data ditemukan",
      emptyTable: "Tidak ada data Alsintan untuk filter ini.",
      info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
      infoEmpty: "Tidak ada data",
      infoFiltered: "(disaring dari _MAX_ total data)"
    }
  });

  // === Chart ===
  const ctx = document.getElementById('alsintanChart').getContext('2d');
  const alsintanChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: chartLabels,
      datasets: [{
        label: 'Total Alsintan',
        data: chartValues,
        borderColor: 'rgba(25, 135, 84, 1)',
        backgroundColor: 'rgba(25, 135, 84, 0.2)',
        borderWidth: 2,
        tension: 0.3,
        fill: true,
        pointBackgroundColor: 'rgba(25, 135, 84, 1)'
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: true, position: 'top' }
      },
      scales: {
        x: { ticks: { autoSkip: true, maxRotation: 90, minRotation: 45 } },
        y: { beginAtZero: true }
      }
    }
  });

  // === Dropdown Kabupaten -> Kecamatan ===
  $('#kabupaten').on('change', function() {
    var id_kabupaten = $(this).val();
    $('#kecamatan').html('<option value="">-- Pilih Kecamatan --</option>');
    $('#desa').html('<option value="">-- Pilih Desa --</option>');
    if (id_kabupaten) {
      $.post("ajax/get_kecamatan.php", {id_kabupaten: id_kabupaten}, function(data){
        $('#kecamatan').html(data);

        if (selectedKecamatanPHP) {
          $('#kecamatan').val(selectedKecamatanPHP).trigger('change');
        }
      });
    }
  });

  // === Dropdown Kecamatan -> Desa ===
  $('#kecamatan').on('change', function() {
    var id_kecamatan = $(this).val();
    $('#desa').html('<option value="">-- Pilih Desa --</option>');
    if (id_kecamatan) {
      $.post("ajax/get_desa.php", {id_kecamatan: id_kecamatan}, function(data){
        $('#desa').html(data);
        if (selectedDesaPHP) {
          $('#desa').val(selectedDesaPHP);
        }
      });
    }
  });

  // === Trigger otomatis setelah reload ===
  if (selectedKabupatenPHP) {
    $('#kabupaten').trigger('change');
  }
});
