<?php
// Menyertakan file header.php
include '../../includes/header.php';
?>

<div class="row d-flex justify-content-center">
  <div class="col-lg-11 mb-4">
    <div class="form-group; text-right">
      <?php
      $id_tw = $_GET['id_triwulan'];
      $id_prodi = $_GET['id_prodi'];
      ?>
      <a href="../tw/index.php?id_triwulan=<?php echo $id_tw ?>&id_prodi=<?php echo $id_prodi; ?>" class="btn btn-sm btn-danger" name="cancel" type="cancel"></i>Cancel</a>
    </div>
    <br />
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <?php
        include '../../includes/koneksi.php';
        $no = 1;
        $data_tri = mysqli_query($koneksi, "SELECT nama_triwulan FROM triwulan WHERE id_triwulan = '$id_tw'");
        $row = mysqli_fetch_assoc($data_tri);
        $nama_triwulan = $row['nama_triwulan'];
        $data_prodi = mysqli_query($koneksi, "SELECT nama_prodi FROM prodi WHERE id_prodi = '$id_prodi'");
        $row = mysqli_fetch_assoc($data_prodi);
        $nama_prodi = $row['nama_prodi'];
        ?>
        <h6 class="m-0 font-weight-bold text-primary"><?php echo $nama_triwulan; ?> - <?php echo $nama_prodi; ?></h6>
      </div>
      <div class="card-body">
        <form method="post" action="../../action/insert/ket.php">
          <input type="hidden" value="<?php echo $id_tw; ?>" class="form-control" id="id_triwulan" name="id_triwulan">
          <input type="hidden" value="<?php echo $id_prodi; ?>" class="form-control" id="id_prodi" name="id_prodi">
          <div class="form-group">
            <label for="indikator">Indikator</label>
            <select class="form-control" name="indikator">
              <?php
              $data = mysqli_query($koneksi, "SELECT * FROM iku");
              mysqli_data_seek($data, 0); // Reset pointer data
              while ($d = mysqli_fetch_array($data)) {
              ?>
                <option value="<?php echo $d['id_iku'] ?>"><?php echo $d['indikator']; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="progres">Progres</label>
            <input type="text" class="form-control" id="progres" placeholder="Progres" name="progres">
          </div>
          <div class="form-group">
            <label for="kendala">Kendala</label>
            <input type="text" class="form-control" id="kendala" placeholder="Kendala" name="kendala">
          </div>
          <div class="form-group">
            <label for="strategi">Strategi</label>
            <input type="text" class="form-control" id="strategi" placeholder="Strategi" name="strategi">
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