<?php 
// Menyertakan file header.php
include '../../includes/header.php'; 
?>

<div class="row d-flex justify-content-center">
  <div class="col-lg-11 mb-4">
    <div class="form-group; text-right">
      <!-- Tombol cancel untuk kembali ke halaman index -->
      <a href="index.php" class="btn btn-sm btn-danger" name="cancel" type="submit"> Cancel</a>
    </div>
    <br />
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
          <!-- Judul form -->
          Tambah Data Program Studi
        </h6>
      </div>
      <div class="card-body">
        <!-- Form untuk menambah data program studi -->
        <form method="post" action="../../action/insert/prodi.php">
          <div class="form-group">
            <!-- Dropdown untuk memilih jurusan -->
            <label for="nama_prodi">Jurusan</label>
            <select class="form-control" name="id_jurusan">
              <?php
              // Melakukan koneksi ke database dan mengambil data jurusan
              include '../../includes/koneksi.php';
              $no = 1;
              $data = mysqli_query($koneksi, "SELECT * FROM jurusan");

              // Menampilkan data jurusan dalam dropdown
              while ($d = mysqli_fetch_array($data)) {
              ?>
                <option value="<?php echo $d['id_jurusan'] ?>"><?php echo $d['nama_jurusan']; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <!-- Input field untuk nama program studi -->
            <label for="nama_prodi">Nama Program Studi</label>
            <input type="text" class="form-control" id="nama_prodi" placeholder="Program Studi" name="nama_prodi">
          </div>
          <!-- Tombol submit untuk mengirim form -->
          <button type="submit" class="btn btn-success" value="Submit" name="proses">Simpan</button>
          <!-- Tombol reset untuk mengosongkan form -->
          <button type="reset" class="btn btn-warning">Reset</button>
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