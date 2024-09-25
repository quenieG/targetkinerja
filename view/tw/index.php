<?php
// Memasukkan file header.php
include '../../includes/header.php';
// Melakukan koneksi ke database
include '../../includes/koneksi.php';

$id_user = $_SESSION['id'];
// echo var_dump($id_user);

if (isset($_GET['filter'])) {
  $data_tri = mysqli_query($koneksi, "SELECT id_triwulan FROM triwulan WHERE tahun_triwulan = $_GET[tahun_select] AND nama_triwulan = '$_GET[nama_triwulan]'");
  $row = mysqli_fetch_assoc($data_tri);
  $id_triwulan = isset($row['id_triwulan']) ? $row['id_triwulan'] : '';

  $id_prodi = $_GET['id_prodi'];
  $nama_triwulan = isset($_GET['nama_triwulan']) ? $_GET['nama_triwulan'] : '';
  $tahun_triwulan = isset($_GET['tahun_select']) ? $_GET['tahun_select'] : date('Y');

  $data_prodi = mysqli_query($koneksi, "SELECT nama_prodi FROM prodi WHERE id_prodi = '$id_prodi'");
  $row = mysqli_fetch_assoc($data_prodi);
  $nama_prodi = $row['nama_prodi'];
} else {
  $id_triwulan = isset($_GET['id_triwulan']) ? $_GET['id_triwulan'] : '';
  $id_prodi = $_GET['id_prodi'];

  $data_tri = mysqli_query($koneksi, "SELECT nama_triwulan, tahun_triwulan FROM triwulan WHERE id_triwulan = '$id_triwulan'");
  $row = mysqli_fetch_assoc($data_tri);
  $nama_triwulan = isset($row['nama_triwulan']) ? $row['nama_triwulan'] : '';
  $tahun_triwulan = isset($row['tahun_triwulan']) ? $row['tahun_triwulan'] : date('Y');

  $data_prodi = mysqli_query($koneksi, "SELECT nama_prodi FROM prodi WHERE id_prodi = '$id_prodi'");
  $row = mysqli_fetch_assoc($data_prodi);
  $nama_prodi = $row['nama_prodi'];
}
?>

<div class="container-fluid">
  <div class="form-group text-right">
    <form method="get" action="" class="form-inline justify-content-end">
      <input type="hidden" value="<?php echo $nama_triwulan; ?>" id="nama_triwulan" name="nama_triwulan">
      <input type="hidden" value="<?php echo $id_prodi; ?>" id="id_prodi" name="id_prodi">
      <div class="form-group mr-3">
        <label for="tahun" class="mr-2">Tahun :</label>
        <select id="tahun_select" name="tahun_select" class="form-control">
          <?php
          $tahun_query = mysqli_query($koneksi, "SELECT DISTINCT tahun_triwulan FROM triwulan WHERE nama_triwulan = '$nama_triwulan' ORDER BY tahun_triwulan DESC");
          $tahun_selected = $tahun_triwulan;
          echo "<option selected hidden value='$tahun_selected'>" . ($tahun_selected ? $tahun_selected : "Pilih Tahun") . "</option>";
          while ($tahun_row = mysqli_fetch_assoc($tahun_query)) {
            if ($tahun_row['tahun_triwulan'] != $tahun_selected) {
              echo "<option value='" . $tahun_row['tahun_triwulan'] . "'>" . $tahun_row['tahun_triwulan'] . "</option>";
            }
          }
          ?>
        </select>
      </div>
      <button type="submit" name="filter" class="btn btn-warning mr-2">
        <i class="fas fa-filter"></i> Filter
      </button>
      
      <a href="cetak_tw.php?id_triwulan=<?php echo $id_triwulan; ?>&id_prodi=<?php echo $id_prodi; ?> &tahun_triwulan=<?php echo $tahun_triwulan; ?>" class="btn btn-info mr-2"><i class="fa fa-print"></i> Print</a>

      <?php
      // Memeriksa apakah role pengguna bukan Ketua Jurusan
      if ($_SESSION['role'] != 'Ketua Jurusan' || $_SESSION['role'] != 'Direktur' || $_SESSION['role'] != 'Wakil Direktur') {
      ?>
        <a href="add.php?id_triwulan=<?php echo $id_triwulan ?>&id_prodi=<?php echo $id_prodi; ?>&id_user=<?php echo $id_user; ?>" class="btn btn-primary" name="tambah">
          <i class="fa fa-plus"></i> Tambah
        </a>
      <?php
      }
      ?>
    </form>
  </div>
  <br />
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <?php
      $no = 1;
      ?>
      <h6 class="m-0 font-weight-bold text-primary"><?php echo $nama_triwulan; ?> - <?php echo $nama_prodi; ?></h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
          <thead class="bg-primary text-center text-white">
            <tr>
              <th>No</th>
              <th>Sasaran Kegiatan</th>
              <th>Indikator Kinerja Kegiatan</th>
              <th>Satuan</th>
              <th>Target Perjanjian Kinerja</th>
              <th>Data Pembagi</th>
              <th>Capaian Triwulan</th>
              <th>Hasil</th>
              <th>Keterangan</th>
              <?php
              // echo var_dump($_SESSION['role'] != 'Ketua Jurusan');
              // Memeriksa apakah role pengguna bukan Ketua Jurusan, direktur, atau wakil direktur
              if ($_SESSION['role'] != 'Ketua Jurusan' && $_SESSION['role'] != 'Direktur' && $_SESSION['role'] != 'Wakil Direktur' && $_SESSION['role'] != 'admin') {
              ?>
                <th class="d-print-none">Aksi</th>
              <?php
              }
              ?>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            $dataa = mysqli_query($koneksi, "SELECT *
                        FROM capaian
                        JOIN iku ON iku.id_iku = capaian.id_iku
                        JOIN triwulan ON triwulan.id_triwulan = capaian.id_triwulan
                        WHERE capaian.id_triwulan = '" . $id_triwulan . "' and capaian.id_prodi = '" . $id_prodi . "' and triwulan.tahun_triwulan = '" . $tahun_triwulan . "'
                        order by capaian.id_capaian
                        ");
            while ($d = mysqli_fetch_array($dataa)) {
              // Penghitungan hasil persentase
              $hasil = ($d['data_pembagi'] != 0) ? number_format(($d['capaian_tw'] / $d['data_pembagi']) * 100, 2) : "N/A";  // Menghindari pembagian dengan nol
              
              // Menentukan keterangan tercapai atau tidak
              $keterangan = ($hasil >= $d['target_kinerja']) ? "Tercapai" : "Tidak Tercapai";
            ?>
              <tr>
                <td class="text-center"><?php echo $no++; ?></td>
                <td><?php echo $d['sasaran']; ?></td>
                <td><?php echo $d['indikator']; ?></td>
                <td class="text-center"><?php echo $d['satuan']; ?></td>
                <td class="text-center"><?php echo $d['target_kinerja']; ?></td>
                <td class="text-center"><?php echo $d['data_pembagi']; ?></td>
                <td class="text-center"><?php echo $d['capaian_tw']; ?></td>
                <td class="text-center"><?php echo $hasil; ?>%</td> <!-- Menampilkan hasil persentase -->
                <td class="text-center"><?php echo $keterangan; ?></td> <!-- Menampilkan keterangan -->
                <?php
                // Memeriksa apakah role pengguna bukan Ketua Jurusan
                if ($_SESSION['role'] != 'Ketua Jurusan' && $_SESSION['role'] != 'Direktur' && $_SESSION['role'] != 'Wakil Direktur' && $_SESSION['role'] != 'admin') {
                  // echo var_dump($_SESSION['role']);
                ?>
                  <td class="d-print-none">
                    <a href="edit.php?id_capaian=<?php echo $d['id_capaian']; ?>&id_user=<?php echo $id_user; ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                    <a href="../../action/delete/tw.php?id_capaian=<?php echo $d['id_capaian']; ?>&id_triwulan=<?php echo $id_triwulan; ?>&id_prodi=<?php echo $id_prodi; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data triwulan ini?')"><i class="fas fa-trash-alt"></i></a>
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
  <br>
  <hr>
  <br>
  <div class="form-group text-right">
  <a href="cetak_ket.php?id_triwulan=<?php echo $id_triwulan; ?>&id_prodi=<?php echo $id_prodi; ?> &tahun_triwulan=<?php echo $tahun_triwulan; ?>" class="btn btn-info mr-2"><i class="fa fa-print"></i> Print</a>
    <?php
    // Memeriksa apakah role pengguna bukan Ketua Jurusan, Direktur, atau Wakil Direktur
if ($_SESSION['role'] != 'Ketua Jurusan' && $_SESSION['role'] != 'Direktur' && $_SESSION['role'] != 'Wakil Direktur' && $_SESSION['role'] != 'admin') {
  ?>
    <a href="../ket/add.php?id_triwulan=<?php echo $id_triwulan ?>&id_prodi=<?php echo $id_prodi; ?>&id_user=<?php echo $id_user; ?>" class="btn btn-primary" name="tambah">
      <i class="fa fa-plus"></i> Tambah
    </a>
  <?php
  }
  
    ?>
  </div>

  <br />
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"><?php echo $nama_triwulan; ?> - <?php echo $nama_prodi; ?></h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
          <thead class="bg-primary text-center text-white">
            <tr>
              <th>No</th>
              <th>Sasaran Kegiatan</th>
              <th>Indikator Kinerja Kegiatan</th>
              <th>Progres</th>
              <th>Kendala</th>
              <th>Strategi</th>
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
          <tbody>

            <?php
            $no = 1;
            $dataa = mysqli_query($koneksi, "SELECT *
                                FROM keterangan
                                JOIN iku ON iku.id_iku = keterangan.id_iku
                                JOIN triwulan ON triwulan.id_triwulan = keterangan.id_triwulan
                                WHERE keterangan.id_triwulan = '" . $id_triwulan . "' and keterangan.id_prodi = '" . $id_prodi . "' and triwulan.tahun_triwulan = '" . $tahun_triwulan . "'
                                order by id_ket");

            while ($d = mysqli_fetch_array($dataa)) {
            ?>
              <tr>
                <td class="text-center"><?php echo $no++; ?></td>
                <td class="text-justify"><?php echo $d['sasaran']; ?></td>
                <td class="text-justify"><?php echo $d['indikator']; ?></td>
                <td class="text-justify"><?php echo $d['progres']; ?></td>
                <td class="text-justify"><?php echo $d['kendala']; ?></td>
                <td class="text-justify"><?php echo $d['strategi']; ?></td>
                <?php
                // Memeriksa apakah role pengguna bukan Ketua Jurusan
                if ($_SESSION['role'] != 'Ketua Jurusan' && $_SESSION['role'] != 'Direktur' && $_SESSION['role'] != 'Wakil Direktur' && $_SESSION['role'] != 'admin') {
                ?>
                  <td class="text-center d-print-none">
                    <a href="../ket/edit.php?id_ket=<?php echo $d['id_ket']; ?>&id_user=<?php echo $id_user; ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                    <a href="../../action/delete/ket.php?id_ket=<?php echo $d['id_ket']; ?>&id_triwulan=<?php echo $id_triwulan; ?>&id_user=<?php echo $id_user; ?>&id_prodi=<?php echo $id_prodi; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data keterangan ini?')"><i class="fas fa-trash-alt"></i></a>
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
