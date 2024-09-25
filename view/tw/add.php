<?php 
// Memasukkan file header.php
include '../../includes/header.php';
// Melakukan koneksi ke database
include '../../includes/koneksi.php';

$id_triwulan = $_GET['id_triwulan'];
$id_prodi = $_GET['id_prodi'];

$data_tri = mysqli_query($koneksi, "SELECT nama_triwulan FROM triwulan WHERE id_triwulan = '$id_triwulan'");
$row = mysqli_fetch_assoc($data_tri);
$nama_triwulan = $row['nama_triwulan'];

$data_prodi = mysqli_query($koneksi, "SELECT nama_prodi FROM prodi WHERE id_prodi = '$id_prodi'");
$row = mysqli_fetch_assoc($data_prodi);
$nama_prodi = $row['nama_prodi'];

$no = 1;

?>

<div class="row d-flex justify-content-center">
  <div class="col-lg-11 mb-4">
    <div class="form-group; text-right">
      <a href="index.php?id_triwulan=<?php echo $id_triwulan ?>&id_prodi=<?php echo $id_prodi; ?>" class="btn btn-sm btn-danger" name="cancel" type="cancel"></i>Cancel</a>
    </div>
    <br />
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><?php echo $nama_triwulan; ?> - <?php echo $nama_prodi; ?></h6>
      </div>
      <div class="card-body">
      <form method="post" action="../../action/insert/tw.php">
          <input type="hidden" value="<?php echo $id_prodi; ?>" name="id_prodi">
          <input type="hidden" value="<?php echo $nama_triwulan; ?>" name="nama_triwulan">
          <div class="form-group">
            <label for="tahun_triwulan">Tahun Triwulan</label>
            <select class="form-control" id="tahun_triwulan" name="tahun_triwulan">
              <?php
              $tahun_query = mysqli_query($koneksi, "SELECT DISTINCT tahun_triwulan FROM triwulan WHERE nama_triwulan ='$nama_triwulan' ORDER BY tahun_triwulan DESC");
              while ($tahun_row = mysqli_fetch_assoc($tahun_query)) {
                echo "<option value='" . $tahun_row['tahun_triwulan'] . "'>" . $tahun_row['tahun_triwulan'] . "</option>";
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="indikator">Indikator</label>
            <select class="form-control" name="indikator">
              <?php
              include 'koneksi.php';
              $data = mysqli_query($koneksi, "SELECT * FROM iku");
              mysqli_data_seek($data, 0); // Reset pointer data
              while ($d = mysqli_fetch_array($data)) {
              ?>
                <option value="<?php echo $d['id_iku'] ?>"><?php echo $d['no_iku']; ?><?php echo $d['indikator']; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="satuan">Satuan</label>
            <input type="text" class="form-control" id="satuan" placeholder="Satuan" name="satuan">
          </div>
          <div class="form-group">
            <label for="target_renaksi_tw">Data Pembagi</label>
            <input type="text" class="form-control" id="data_pembagi" placeholder="Data Pembagi" name="data_pembagi">
          </div>
          <div class="form-group">
            <label for="capaian_tw">Capaian Triwulan</label>
            <input type="text" class="form-control" id="capaian_tw" placeholder="Capaian Triwulan" name="capaian_tw">
          </div>
          <button type="submit" class="btn btn-success" value="Submit" name="proses">Simpan</button>
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