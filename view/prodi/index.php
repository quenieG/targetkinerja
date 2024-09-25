<?php
// Sertakan file header
include '../../includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="container-fluid">
  <div class="form-group; text-right">
    <!-- Tombol untuk mencetak tabel -->
    <a href="cetak_prodi.php" class="btn btn-info mr-2"><i class="fa fa-print"></i> Print</a>
    &nbsp;&nbsp;

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
      <h6 class="m-0 font-weight-bold text-primary">Tabel Program Studi</h6>  
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead class="bg-primary text-center text-white">
            <tr>
              <th>No</th>
              <th>Jurusan</th>
              <th>Program Studi</th>
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
            // Sertakan file koneksi ke database
            include '../../includes/koneksi.php';
            $no = 1;

            // Query untuk mengambil data jurusan dan program studi
            $data = mysqli_query($koneksi, "SELECT jurusan.id_jurusan, jurusan.nama_jurusan, prodi.id_prodi, prodi.nama_prodi FROM jurusan JOIN prodi ON jurusan.id_jurusan = prodi.id_jurusan; ");

            // Loop untuk menampilkan data
            while ($d = mysqli_fetch_array($data)) {
            ?>
              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $d['nama_jurusan']; ?></td>
                <td>
                  <?php
                  // Menampilkan nama program studi
                  echo $d['nama_prodi']
                  ?>
                </td>
                <?php
                // Memeriksa apakah role pengguna bukan Ketua Jurusan
                if ($_SESSION['role'] != 'Ketua Jurusan' && $_SESSION['role'] != 'Direktur' && $_SESSION['role'] != 'Wakil Direktur') {
                ?>
                  <td class="d-print-none">
                    <!-- Tombol untuk mengedit dan menghapus data -->
                    <a href="edit.php?id_prodi=<?php echo $d['id_prodi']; ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                    <a href="../../action/delete/prodi.php?id_prodi=<?php echo $d['id_prodi']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus Program Studi ini?')"><i class="fas fa-trash-alt"></i></a>
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
</body>
</html>
<?php
// Sertakan file footer
include '../../includes/footer.php';
?>