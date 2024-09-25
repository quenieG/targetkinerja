<?php
// Memasukkan file header.php
include '../../includes/header.php';
// Melakukan koneksi ke database
include '../../includes/koneksi.php';

$id_prodi = $_GET['id_prodi']; ////<!-- Mengambil id_prodi dari URL -->
$tahun_selected = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y'); //<!-- Mengambil tahun dari URL atau menggunakan tahun saat ini jika tidak ada -->

// Query SQL untuk mendapatkan semua id_iku unik dan indikator yang sesuai
$query_iku = "SELECT DISTINCT capaian.id_iku, CONCAT(iku.no_iku, ' ', iku.indikator) as indikator , prodi.nama_prodi
FROM capaian 
join prodi on capaian.id_prodi = prodi.id_prodi
JOIN iku ON capaian.id_iku = iku.id_iku 
JOIN triwulan ON capaian.id_triwulan = triwulan.id_triwulan
WHERE capaian.id_prodi = '$id_prodi' AND triwulan.tahun_triwulan = '$tahun_selected' ORDER BY capaian.id_iku ASC";
$result_iku = mysqli_query($koneksi, $query_iku); //<!-- Menjalankan query dan menyimpan hasilnya -->

// Array untuk menyimpan data untuk setiap id_iku
$data_all = array();
$labels_all = array();
$nama_prodi = ""; // Variabel untuk menyimpan nama prodi

while ($row_iku = mysqli_fetch_assoc($result_iku)) { //<!-- Looping melalui setiap baris hasil query -->

  $id_iku = $row_iku['id_iku']; //<!-- Mengambil id_iku -->
  $indikator = $row_iku['indikator']; //<!-- Mengambil indikator -->
  $nama_prodi = $row_iku['nama_prodi']; //<!-- Mengambil nama_prodi -->

  // Query SQL untuk mendapatkan data capaian dan id_triwulan untuk id_iku ini
  $query_capaian = "SELECT (capaian_tw / data_pembagi) * 100 AS nilai_persentase, nama_triwulan 
  FROM capaian 
  join triwulan on capaian.id_triwulan = triwulan.id_triwulan
  WHERE id_iku = '$id_iku' 
  AND triwulan.id_triwulan IN (SELECT id_triwulan FROM triwulan WHERE tahun_triwulan = '$tahun_selected')
  AND capaian.id_prodi = '$id_prodi'";
  $result_capaian = mysqli_query($koneksi, $query_capaian); //<!-- Menjalankan query dan menyimpan hasilnya -->

  // Mengubah data menjadi array untuk Chart.js
  $data = array();
  $labels = array();
  while ($row_capaian = mysqli_fetch_assoc($result_capaian)) { //<!-- Looping melalui setiap baris hasil query -->
    $persentase = number_format($row_capaian['nilai_persentase'], 2); // Format persentase dengan 2 angka desimal
    $data[] = $persentase; // Jangan tambahkan tanda "%", biarkan sebagai nilai numerik
    $labels[] = $row_capaian['nama_triwulan']; //<!-- Menambahkan nama_triwulan ke array labels -->
  }

  // Menambahkan data dan label ini ke array data_all dan labels_all dengan indikator sebagai kunci
  $data_all[$indikator] = $data;
  $labels_all[$indikator] = $labels;
}

// Mengubah array PHP menjadi JSON untuk digunakan dalam JavaScript
$data_all_json = json_encode($data_all);

$labels_all_json = json_encode($labels_all);
?>

<!-- Begin Page Content -->
<div class="container-fluid">
  <h2 class="text-uppercase">PENGUKURAN <?php echo $nama_prodi; ?></h2> <!-- Menampilkan nama prodi -->
  <br>
  <div class="form-group">
    <form method="get" action="">
      <label for="tahun">Tahun :</label>
      <select id="tahun" name="tahun" onchange="this.form.submit()" class="form-control">
        <?php
        $tahun_query = mysqli_query($koneksi, "SELECT DISTINCT tahun_triwulan FROM triwulan ORDER BY tahun_triwulan DESC");
        echo "<option selected disabled hidden value=''>" . ($tahun_selected ? $tahun_selected : "Pilih Tahun") . "</option>";
        while ($tahun_row = mysqli_fetch_assoc($tahun_query)) { //<!-- Looping melalui setiap baris hasil query -->
          if ($tahun_row['tahun_triwulan'] != $tahun_selected) {
            echo "<option value='" . $tahun_row['tahun_triwulan'] . "'>" . $tahun_row['tahun_triwulan'] . "</option>"; //<!-- Menampilkan tahun_triwulan sebagai opsi -->
          }
        }
        ?>
      </select>
      <input type="hidden" value="<?php echo $id_prodi; ?>" id="id_prodi" name="id_prodi"> <!-- Input hidden untuk id_prodi -->
    </form>
  </div>
  <?php $indikator_data_pairs = array_chunk($data_all, 4, true); ?> <!-- Membagi data_all menjadi chunk dengan ukuran 4 -->
  <?php foreach ($indikator_data_pairs as $pair) : ?> <!-- Looping melalui setiap chunk -->
    <div class="row mb-3">
      <?php foreach ($pair as $indikator => $data) : ?> <!-- Looping melalui setiap pasangan indikator-data dalam chunk -->
        <div class="col-3">
          <div class="card shadow-lg mb-5 bg-white rounded"> <!-- Tambahkan shadow dan rounded -->
            <div class="card-header bg-dark text-white" style="height: 8rem;">
              <div class="card-title text-center" style="font-size: 0.8rem;"><?php echo $indikator; ?></div> <!-- Menampilkan indikator -->
            </div>
            <div class="card-body">
              <canvas id="myChart<?php echo md5($indikator); ?>" style="width:100%;max-width:600px"></canvas> <!-- Canvas untuk chart -->
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endforeach; ?>
</div>

<script>
  var data_all = <?php echo $data_all_json; ?>; //<!-- Mengambil data_all dari PHP -->
  var labels_all = <?php echo $labels_all_json; ?>; //<!-- Mengambil labels_all dari PHP -->

  for (var indikator in data_all) { //<!-- Looping melalui setiap indikator dalam data_all -->
    var ctx = document.getElementById('myChart' + md5(indikator)).getContext('2d'); //<!-- Mendapatkan context dari canvas -->
    var data = data_all[indikator]; //<!-- Mengambil data untuk indikator ini -->
    var labels = labels_all[indikator]; //<!-- Mengambil label untuk indikator ini -->

    var myPieChart = new Chart(ctx, { // Membuat chart baru
      type: 'pie', // Tipe chart adalah pie
      data: {
        datasets: [{
          data: data, // Data untuk chart
          backgroundColor: [ // Warna latar belakang untuk setiap potongan pie
            'rgba(255, 99, 132, 0.8)',
            'rgba(54, 162, 235, 0.8)',
            'rgba(255, 206, 86, 0.8)',
            'rgba(75, 192, 192, 0.8)',
            'rgba(153, 102, 255, 0.8)',
            'rgba(255, 159, 64, 0.8)'
          ],
          borderColor: [ // Warna border untuk setiap potongan pie
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
          ],
          borderWidth: 1 // Lebar border
        }],
        labels: labels // Label untuk setiap potongan pie
      },
      options: {
        plugins: {
          datalabels: {
            color: '#000', // Warna label data
            formatter: (value, ctx) => { // Fungsi untuk memformat label data
              let sum = 0; // Variabel untuk menyimpan total
              let dataArr = ctx.chart.data.datasets[0].data; // Mengambil data dari chart
              dataArr.map(data => { // Looping melalui setiap data
                sum += data; // Menambahkan data ke total
              });
              let percentage = (value * 100 / sum).toFixed(2) + "%"; // Menghitung persentase
              return percentage; // Mengembalikan persentase
            }
          }
        },
        legend: {
          display: true // Menampilkan legenda
        }
      }
    });
  }
</script>

<?php
// Memasukkan file footer.php
include '../../includes/footer.php'; ?>