<?php
// Memasukkan file header.php
include '../../includes/header.php';
?>

<div class="row d-flex justify-content-center">
  <div class="col-lg-11 mb-4">
    <div class="form-group; text-right">
      <!-- Tombol untuk membatalkan pengeditan dan kembali ke halaman jurusan -->
      <a href="index.php" class="btn btn-sm btn-danger" name="cancel" type="submit"> Cancel</a>
    </div>
    <br />
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
          Edit Data Jurusan
        </h6>
      </div>
      <div class="card-body">
        <?php
        include '../../includes/koneksi.php'; // Sertakan file koneksi ke database

        // Periksa jika ID jurusan dikirim melalui parameter GET
        if (isset($_GET['id'])) {
          $id = $_GET['id'];

          // Lakukan query untuk mengambil data jurusan berdasarkan ID
          $query = "SELECT * FROM jurusan WHERE id_jurusan = $id";
          $result = mysqli_query($koneksi, $query);

          // Periksa apakah ada baris data yang dikembalikan
          if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $nama_jurusan = $row['nama_jurusan'];
          }
        }
        ?>
        <!-- Form untuk mengedit data jurusan -->
        <form method="post" action="../../action/update/jurusan.php">
          <!-- Input hidden untuk menyimpan ID jurusan -->
          <input type="hidden" name="id_jurusan" value="<?php echo $id; ?>">
          <div class="form-group">
            <label for="nama_jurusan">Nama Jurusan</label>
            <!-- Input untuk nama jurusan -->
            <input type="text" class="form-control" id="nama_jurusan" name="nama_jurusan" value="<?php echo $nama_jurusan; ?>">
          </div>
          <!-- Tombol untuk menyimpan perubahan -->
          <button type="submit" class="btn btn-success">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>

<?php
// Memasukkan file footer.php
include '../../includes/footer.php';
?>