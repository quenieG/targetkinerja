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
          Tambah Data Triwulan
        </h6>
      </div>
      <div class="card-body">
        <!-- Form untuk menambahkan data triwulan -->
        <form method="post" action="../../action/insert/triwulan.php">
          <div class="form-group">
            <!-- Input untuk nama triwulan -->
            <input type="text" class="form-control" id="nama_triwulan" placeholder="Triwulan" name="nama_triwulan">
          </div>
          <div class="form-group">
            <!-- Input untuk tahun triwulan -->
            <input type="text" class="form-control" id="tahun_triwulan" placeholder="Tahun Triwulan" name="tahun_triwulan">
          </div>
          <!-- Tombol submit untuk mengirim form -->
          <button type="submit" class="btn btn-info" value="Submit" name="proses">Simpan</button>
          <!-- Tombol reset untuk mengosongkan form -->
          <button type="reset" class="btn btn-warning">Reset</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>

<!-- Menyertakan file footer.php -->
<?php include '../../includes/footer.php'; ?>