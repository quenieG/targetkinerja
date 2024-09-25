<?php include '../../includes/header.php'; ?>

<div class="row d-flex justify-content-center">
  <div class="col-lg-11 mb-4">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
          Target Kinerja
        </h6>
      </div>
      <div class="card-body">
        <canvas id="myChart" style="width: 100%; height: 500px;"></canvas>

        <?php
        // Sambungkan ke database
        include "../../includes/koneksi.php";

        // Query untuk mengambil data dari tabel 'iku'
        $query = "SELECT sasaran, no_iku, indikator, target_kinerja FROM iku";
        $result = mysqli_query($koneksi, $query);

        // Inisialisasi array untuk menyimpan data
        $xValues = array();
        $yValues = array();

        // Ambil data dari hasil query dan masukkan ke dalam array
        while ($row = mysqli_fetch_assoc($result)) {
          $xValues[] = $row['no_iku'];
          $yValues[] = $row['target_kinerja'];
        }
        ?>
      </div>
    </div>
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
          Keterangan Target Kinerja
        </h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
            <thead class="bg-primary text-center text-white">
              <tr>
                <th>NO (IKU/IKK)</th>
                <th>Indikator (IKU/IKK)</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $data = mysqli_query($koneksi, "SELECT * FROM iku");
              while ($d = mysqli_fetch_array($data)) {
              ?>
                <tr>
                  <td class="text-center"><?php echo $d['no_iku']; ?></td>
                  <td><?php echo $d['indikator']; ?></td>
                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // Mengonversi data PHP menjadi JavaScript
  var xValues = <?php echo json_encode($xValues); ?>;
  var yValues = <?php echo json_encode($yValues); ?>;
  var barColors = ["#ff6961", "#FF7F3E", "#9BB0C1", "#42d6a4", "#3AA6B9", "#59adf6", "#9d94ff", "#c780e8", "", "#5A639C", "#E8C872"];

  // Membuat grafik menggunakan Chart.js
  var ctx = document.getElementById('myChart').getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: xValues,
      datasets: [{
        label: 'Target Kinerja',
        data: yValues,
        backgroundColor: barColors,
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
          }
        }]
      }
    }
  });
</script>

<?php include '../../includes/footer.php'; ?>
