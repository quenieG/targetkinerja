<?php include '../../includes/header.php'; ?>
<!-- Memasukkan file header.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<div class="container-fluid">
  <div class="form-group text-right">
    <!-- Tombol untuk mencetak tabel -->
    <a href="cetak_iku.php" class="btn btn-info mr-2"><i class="fa fa-print"></i> Print</a>

    <?php
    // Memeriksa apakah role pengguna bukan Ketua Jurusan
    if ($_SESSION['role'] != 'Ketua Jurusan' && $_SESSION['role'] != 'Direktur' && $_SESSION['role'] != 'Wakil Direktur') {
    ?>
      <!-- Tautan untuk menambah data baru -->
      <a href="add.php" class="btn btn-primary" name="tambah" type="submit"><i class="fa fa-plus"></i> Tambah</a>
    <?php
    }
    ?>
  </div>
  <br />

  <div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Tabel Target Kinerja</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead class="bg-primary text-center text-white">
            <tr>
              <th>No</th>
              <th>Sasaran (S/SK)</th>
              <th>NO (IKU/IKK)</th>
              <th>Indikator (IKU/IKK)</th>
              <th>Target Perjanjian Kinerja</th>
              <?php
              // Memeriksa apakah role pengguna bukan Ketua Jurusan
              if ($_SESSION['role'] != 'Ketua Jurusan' && $_SESSION['role'] != 'Direktur' && $_SESSION['role'] != 'Wakil Direktur') {
              ?>
                <th class="d-print-none">Aksi</th>
              <?php
              }
              ?>
            </tr>
          </thead>
          <?php
          include '../../includes/koneksi.php';
          $no = 1;
          $data = mysqli_query($koneksi, "select * from iku");
          while ($d = mysqli_fetch_array($data)) {
          ?>
            <tr>
              <td class="text-center"><?php echo $no++; ?></td>
              <td><?php echo $d['sasaran']; ?></td>
              <td class="text-center"><?php echo $d['no_iku']; ?></td>
              <td><?php echo $d['indikator']; ?></td>
              <td class="text-center"><?php echo $d['target_kinerja']; ?></td>
              <?php
              // Memeriksa apakah role pengguna bukan Ketua Jurusan
              if ($_SESSION['role'] != 'Ketua Jurusan' && $_SESSION['role'] != 'Direktur' && $_SESSION['role'] != 'Wakil Direktur') {
              ?>
                <td class="text-center d-print-none"> 
                  <!-- Tautan untuk mengubah data -->
                  <a href="edit.php?id=<?php echo $d['id_iku']; ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                  <!-- Tautan untuk menghapus data dengan konfirmasi -->
                  <a href="../../action/delete/iku.php?id_iku=<?php echo $d['id_iku']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus Target Kinerja ini?')"><i class="fas fa-trash-alt"></i></a>
                </td>
              <?php
              }
              ?>
            </tr>
          <?php
          }
          ?>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include '../../includes/footer.php'; ?>
<!-- Memasukkan file footer.php -->
