<?php include '../../includes/header.php'; ?>

<div class="row d-flex justify-content-center">
  <div class="col-lg-11 mb-4">
    <div class="form-group; text-right">
      <a href="index.php" class="btn btn-sm btn-danger" name="cancel" type="submit"> Cancel</a>
    </div>
    <br />
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
          Edit Data Target Kinerja
        </h6>
      </div>
      <div class="card-body">
        <?php
        include '../../includes/koneksi.php';

        // Periksa jika ID jurusan dikirim melalui parameter GET
        if (isset($_GET['id'])) {
          $id = $_GET['id'];

          // Lakukan query untuk mengambil data jurusan berdasarkan ID
          $query = "SELECT * FROM iku WHERE id_iku = $id";
          $result = mysqli_query($koneksi, $query);

          // Periksa apakah ada baris data yang dikembalikan
          if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $sasaran = $row['sasaran'];
            $no_iku = $row['no_iku'];
            $indikator = $row['indikator'];
            $target_kinerja = $row['target_kinerja'];
          }
        }
        ?>
        <form method="post" action="../../action/update/iku.php">
          <input type="hidden" name="id_iku" value="<?php echo $id; ?>">
          <div class="form-group">
            <label for="sasaran">Sasaran</label>
            <input type="text" class="form-control" id="sasaran" name="sasaran" value="<?php echo $sasaran; ?>">
          </div>
          <div class="form-group">
            <label for="no_iku">NO (IKU/IKK)</label>
            <input type="text" class="form-control" id="no_iku" name="no_iku" value="<?php echo $no_iku; ?>">
          </div>
          <div class="form-group">
            <label for="indikator">Indikator</label>
            <input type="text" class="form-control" id="indikator" name="indikator" value="<?php echo $indikator; ?>">
          </div>
          <div class="form-group">
            <label for="target_kinerja">Target Perjanjian Kinerja</label>
            <input type="text" class="form-control" id="target_kinerja" name="target_kinerja" value="<?php echo $target_kinerja; ?>">
          </div>
          <button type="submit" class="btn btn-success">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>

<?php include '../../includes/footer.php'; ?>