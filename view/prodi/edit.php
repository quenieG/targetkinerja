<?php
// Menyertakan file header.php
include '../../includes/header.php';
?>

<div class="row d-flex justify-content-center">
  <div class="col-lg-11 mb-4">
    <div class="form-group; text-right">
      <!-- Tombol cancel untuk kembali ke halaman prodi -->
      <a href="index.php" class="btn btn-sm btn-danger" name="cancel" type="submit">Cancel</a>
    </div>
    <br />
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
          <!-- Judul form -->
          Edit Data Prodi
        </h6>
      </div>
      <div class="card-body">
        <?php
        // Memulai session hanya jika belum dimulai
        if (session_status() == PHP_SESSION_NONE) {
          session_start();
        }

        // Sertakan file koneksi ke database
        include '../../includes/koneksi.php';

        // Inisialisasi variabel dengan nilai default
        $id_prodi = '';
        $id_jurusan = '';
        $nama_jurusan = '';
        $nama_prodi = '';

        // Cek apakah id_prodi ada dalam parameter GET
        if (isset($_GET['id_prodi'])) {
          $id_prodi = mysqli_real_escape_string($koneksi, $_GET['id_prodi']);

          // Query untuk mengambil data prodi dan jurusan berdasarkan id_prodi
          $query = "SELECT p.id_prodi, p.nama_prodi, j.id_jurusan, j.nama_jurusan FROM prodi p
                    JOIN jurusan j ON p.id_jurusan = j.id_jurusan
                    WHERE p.id_prodi = $id_prodi";
          $result = mysqli_query($koneksi, $query);

          // Periksa apakah query berhasil dieksekusi
          if ($result) {
            // Periksa apakah ada baris data yang dikembalikan
            if (mysqli_num_rows($result) > 0) {
              // Mengambil data prodi dan jurusan
              $row = mysqli_fetch_assoc($result);
              $id_prodi = $row['id_prodi'];
              $id_jurusan = $row['id_jurusan'];
              $nama_jurusan = $row['nama_jurusan'];
              $nama_prodi = $row['nama_prodi'];
            } else {
              // Menampilkan pesan jika data tidak ditemukan
              echo "Data tidak ditemukan.";
              exit();
            }
          } else {
            // Menampilkan pesan error jika query gagal dieksekusi
            echo "Error: " . mysqli_error($koneksi);
            exit();
          }
        } else {
          // Menampilkan pesan jika id_prodi tidak ditemukan dalam parameter GET
          echo "Parameter id_prodi tidak ditemukan.";
          exit();
        }

        // Query untuk mengambil semua jurusan
        $jurusan_query = "SELECT id_jurusan, nama_jurusan FROM jurusan";
        $jurusan_result = mysqli_query($koneksi, $jurusan_query);
        ?>
        <!-- Form untuk mengedit data prodi -->
        <form method="post" action="../../action/update/prodi.php">
          <!-- Input hidden untuk menyimpan id_prodi -->
          <input type="hidden" name="id_prodi" value="<?php echo $id_prodi; ?>">
          <div class="form-group">
            <!-- Dropdown untuk memilih nama jurusan -->
            <label for="id_jurusan">Nama Jurusan</label>
            <select class="form-control" id="id_jurusan" name="id_jurusan">
              <?php
              // Mengisi dropdown dengan data jurusan dari database
              if ($jurusan_result) {
                while ($jurusan_row = mysqli_fetch_assoc($jurusan_result)) {
                  $selected = ($jurusan_row['id_jurusan'] == $id_jurusan) ? 'selected' : '';
                  echo "<option value='{$jurusan_row['id_jurusan']}' $selected>{$jurusan_row['nama_jurusan']}</option>";
                }
              } else {
                echo "<option value=''>Data jurusan tidak ditemukan</option>";
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <!-- Input field untuk nama program studi -->
            <label for="nama_prodi">Nama Program Studi</label>
            <input type="text" class="form-control" id="nama_prodi" name="nama_prodi" value="<?php echo $nama_prodi; ?>">
          </div>
          <!-- Tombol submit untuk mengirim form -->
          <button type="submit" class="btn btn-success">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>

<?php
// Menyertakan file footer.php
include '../../includes/footer.php';
?>