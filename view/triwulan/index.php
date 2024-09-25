<?php
// Memasukkan file header.php
include '../../includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<div class="container-fluid">
  <div class="form-group text-right">
    <!-- Tombol untuk mencetak tabel -->
    <a href="cetak_triwulan.php" class="btn btn-info mr-2"><i class="fa fa-print"></i> Print</a>

    <?php
    // Memeriksa apakah role pengguna bukan Ketua Jurusan
    if ($_SESSION['role'] != 'Ketua Jurusan') {
    ?>
      <!-- Tombol untuk menambah data baru -->
      <a href="add.php" class="btn btn-primary" name="tambah" type="submit"><i class="fa fa-plus"></i> Tambah</a>
    <?php
    }
    ?>
  </div>
  <br />

  <div class="card shadow mb-4">
    <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Tabel Triwulan</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead class="bg-primary text-center text-white">
            <tr>
              <th>No</th>
              <th>Nama Triwulan</th>
              <th>Tahun</th>
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
          <tbody class="text-center">
            <?php
            // Melakukan koneksi ke database
            include '../../includes/koneksi.php';
            $no = 1;

            // Mengambil data triwulan 1 hingga 4 dari tabel triwulan
            $data = mysqli_query($koneksi, "SELECT * FROM triwulan WHERE nama_triwulan IN ('Triwulan 1', 'Triwulan 2', 'Triwulan 3', 'Triwulan 4')");

            // Menampilkan semua data yang telah diambil
            while ($d = mysqli_fetch_array($data)) {
            ?>
              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $d['nama_triwulan']; ?></td>
                <td><?php echo $d['tahun_triwulan']; ?></td>
                <?php
                // Memeriksa apakah role pengguna bukan Ketua Jurusan
                if ($_SESSION['role'] != 'Ketua Jurusan' && $_SESSION['role'] != 'Direktur' && $_SESSION['role'] != 'Wakil Direktur') {
                ?>
                  <td class="d-print-none">
                    <!-- Tombol untuk mengedit data -->
                    <a href="edit.php?id_triwulan=<?php echo $d['id_triwulan']; ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                    <!-- Tombol untuk menghapus data -->
                    <a href="../../action/delete/triwulan.php?id_triwulan=<?php echo $d['id_triwulan']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus Triwulan ini?')"><i class="fas fa-trash-alt"></i></a>
                  </td>
                <?php
                }
                ?>
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

<?php
// Memasukkan file footer.php
include '../../includes/footer.php';
?>
