<?php
// Menyertakan file header.php
include '../../includes/header.php';

$id_capaian = $_GET['id_capaian'];

?>

<div class="row d-flex justify-content-center">
  <div class="col-lg-11 mb-4">
    <div class="form-group; text-right">

      <?php
      include '../../includes/koneksi.php';
      $no = 1;
      $data = mysqli_query($koneksi, "SELECT * , capaian.id_triwulan as id_tw, capaian.id_prodi as id_pro
                                FROM capaian
                                JOIN iku ON iku.id_iku = capaian.id_iku
                                JOIN triwulan ON triwulan.id_triwulan = capaian.id_triwulan
                                JOIN prodi ON prodi.id_prodi = capaian.id_prodi
                                WHERE capaian.id_capaian = '" . $id_capaian . "'");
      $datas = mysqli_fetch_assoc($data);
      ?>

      <a href="index.php?id_triwulan=<?php echo $datas['id_triwulan'] ?>&id_prodi=<?php echo $datas['id_pro']; ?>" class="btn btn-sm btn-danger" name="cancel" type="cancel"></i>Cancel</a>
    </div>
    <br />
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><?php echo $datas['nama_triwulan']; ?> - <?php echo $datas['nama_prodi']; ?> (EDIT)</h6>
      </div>
      <div class="card-body">
        <form method="post" action="../../action/update/tw.php">
          <input type="hidden" value="<?php echo $datas['id_tw']; ?>" class="form-control" id="id_triwulan" name="id_triwulan">
          <input type="hidden" value="<?php echo $datas['id_pro']; ?>" class="form-control" id="id_prodi" name="id_prodi">
          <input type="hidden" value="<?php echo $datas['id_capaian']; ?>" class="form-control" id="id_capaian" name="id_capaian">
          <div class="form-group">
            <label for="indikator">Indikator</label>
            <select class="form-control" name="id_iku">
              <option value="<?php echo $datas['id_iku'] ?>"><?php echo $datas['indikator']; ?></option>
              <?php
              include 'koneksi.php';
              $data = mysqli_query($koneksi, "SELECT * FROM iku");
              mysqli_data_seek($data, 0); // Reset pointer data
              while ($d = mysqli_fetch_array($data)) {
              ?>
                <option value="<?php echo $d['id_iku'] ?>"><?php echo $d['indikator']; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="satuan">Satuan</label>
            <input type="text" class="form-control" id="satuan" placeholder="Satuan" name="satuan" value="<?php echo $datas['satuan'] ?>">
          </div>
          <div class="form-group">
            <label for="target_renaksi_tw">Data Pembagi</label>
            <input type="text" class="form-control" id="data_pembagi" placeholder="Data Pembagi" name="data_pembagi" value="<?php echo $datas['data_pembagi'] ?>">
          </div>
          <div class="form-group">
            <label for="capaian_tw">Capaian Triwulan</label>
            <input type="text" class="form-control" id="capaian_tw" placeholder="Capaian Triwulan" name="capaian_tw" value="<?php echo $datas['capaian_tw'] ?>">
          </div>
          <button type="submit" class="btn btn-success" value="Submit" name="proses">Simpan</button>
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