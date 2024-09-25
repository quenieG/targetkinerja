<?php
// Menyertakan file header.php
include '../../includes/header.php';
?>

<div class="row d-flex justify-content-center">
  <div class="col-lg-11 mb-4">
    <div class="form-group; text-right">
      <!-- Tombol cancel yang mengarah ke halaman index.php -->
      <a href="index.php" class="btn btn-sm btn-danger" name="cancel" type="submit"> Cancel</a>
    </div>
    <br />
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
          Edit Data Triwulan
        </h6>
      </div>
      <div class="card-body">
        <?php
        include '../../includes/koneksi.php';

        // Inisialisasi variabel $nama_prodi dengan nilai default
        $nama_prodi = '';

        // Cek apakah id_triwulan ada dalam parameter GET
        if (isset($_GET['id_triwulan'])) {
          $id_triwulan = $_GET['id_triwulan'];

          // Query untuk mengambil data triwulan berdasarkan id_triwulan
          $query = "SELECT * FROM triwulan WHERE id_triwulan = $id_triwulan";
          $result = mysqli_query($koneksi, $query);

          // Periksa apakah query berhasil dieksekusi
          if ($result) {
            // Periksa apakah ada baris data yang dikembalikan
            if (mysqli_num_rows($result) > 0) {
              // Mengambil data dari hasil query
              $row = mysqli_fetch_assoc($result);
              $nama_triwulan = $row['nama_triwulan'];
              $tahun_triwulan = $row['tahun_triwulan'];
            } else {
              // Menampilkan pesan jika data tidak ditemukan
              echo "Data tidak ditemukan.";
            }
          } else {
            // Menampilkan pesan error jika query gagal dieksekusi
            echo "Error: " . mysqli_error($koneksi);
          }
        }
        ?>
        <!-- Form untuk mengedit data triwulan -->
        <form method="post" action="../../action/update/triwulan.php">
          <!-- Input hidden untuk menyimpan id_triwulan -->
          <input type="hidden" name="id_triwulan" value="<?php echo $id_triwulan; ?>">
          <div class="form-group">
            <!-- Input untuk nama triwulan -->
            <input type="text" class="form-control" id="nama_triwulan" name="nama_triwulan" value="<?php echo $nama_triwulan; ?>">
          </div>
          <div class="form-group">
            <!-- Input untuk tahun triwulan -->
            <input type="text" class="form-control" id="tahun_triwulan" name="tahun_triwulan" value="<?php echo $tahun_triwulan; ?>">
          </div>
          <!-- Tombol submit untuk mengirim form -->
          <button type="submit" class="btn btn-success">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>

<!-- Menyertakan file footer.php -->
<?php include '../../includes/footer.php'; ?>