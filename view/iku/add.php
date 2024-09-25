<?php include '../../includes/header.php'; ?>

<div class="row d-flex justify-content-center">
  <div class="col-lg-11 mb-4">
    <div class="form-group; text-right">
      <a href="index.php" class="btn btn-sm btn-danger" name="cancel" type="submit"> Cancel</a>
    </div>
    <br/>
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
          Tambah Data Target Kinerja
        </h6>
      </div>
      <div class="card-body">
        <form method="post" action="../../action/insert/iku.php">
          <div class="form-group">
            <label for="sasaran">Sasaran (S/SK)</label>
            <input type="text" class="form-control" id="sasaran" placeholder="Sasaran" name="sasaran">
          </div>
          <div class="form-group">
            <label for="no_iku">NO (IKU/IKK)</label>
            <input type="text" class="form-control" id="no_iku" placeholder="NO (IKU/IKK)" name="no_iku">
          </div>
          <div class="form-group">
            <label for="indikator">Indikator (IKU/IKK)</label>
            <input type="text" class="form-control" id="indikator" placeholder="Indikator" name="indikator">
          </div>
          <div class="form-group">
            <label for="target_kinerja">Target Perjanjian Kinerja</label>
            <input type="text" class="form-control" id="target_kinerja" placeholder="Target Perjanjian Kinerja" name="target_kinerja">
          </div>
          <button type="submit" class="btn btn-info" value="Submit" name="proses">Simpan</button>
          <button type="reset" class="btn btn-warning">Reset</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>

<?php include '../../includes/footer.php'; ?>