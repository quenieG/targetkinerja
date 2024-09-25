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
    <a href="cetak_jurusan.php" class="btn btn-info mr-2"><i class="fa fa-print"></i> Print</a>

    &nbsp;&nbsp;

    <?php
    // Memeriksa apakah role pengguna bukan Ketua Jurusan
    if ($_SESSION['role'] != 'Ketua Jurusan') {
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
      <h6 class="m-0 font-weight-bold text-primary">Tabel Jurusan</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead class="bg-primary text-center text-white">
            <tr>
              <th>No</th>
              <th>Jurusan</th>
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

            // Mengambil data dari tabel jurusan
            $data = mysqli_query($koneksi, "select * from jurusan");

            // Menampilkan data dalam tabel
            while ($d = mysqli_fetch_array($data)) {
            ?>
              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $d['nama_jurusan']; ?></td>
                <?php
              // Memeriksa apakah role pengguna bukan Ketua Jurusan
              if ($_SESSION['role'] != 'Ketua Jurusan' && $_SESSION['role'] != 'Direktur' && $_SESSION['role'] != 'Wakil Direktur') {
              ?>
                  <td class="d-print-none">
                    <!-- Tombol untuk mengedit data -->
                    <a href="edit.php?id=<?php echo $d['id_jurusan']; ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                    <!-- Tombol untuk menghapus data -->
                    <a href="../../action/delete/jurusan.php?id_jurusan=<?php echo $d['id_jurusan']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus jurusan ini?')"><i class="fas fa-trash-alt"></i></a>
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

</div>

<?php
// Memasukkan file footer.php
include '../../includes/footer.php';
?>
