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
          Tambah Data Jurusan
        </h6>
      </div>
      <div class="card-body">
        <!-- Form untuk menambah data jurusan -->
        <form method="post" action="../../action/insert/jurusan.php">
          <div class="form-group">
            <!-- Input field untuk nama jurusan -->
            <label for="nama_jurusan">Nama Jurusan</label>
            <input type="text" class="form-control" id="nama_jurusan" placeholder="Jurusan" name="nama_jurusan">
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