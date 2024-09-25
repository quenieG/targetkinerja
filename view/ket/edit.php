<?php
// Menyertakan file header.php
include '../../includes/header.php';
?>

<div class="row d-flex justify-content-center">
    <div class="col-lg-11 mb-4">
        <div class="form-group; text-right">
            <?php
            include '../../includes/koneksi.php';
            $id_ket = $_GET['id_ket'];
            $no = 1;
            $data = mysqli_query($koneksi, "SELECT *, keterangan.id_triwulan as id_tw, keterangan.id_prodi as id_pro
                                FROM keterangan
                                JOIN iku ON iku.id_iku = keterangan.id_iku
                                JOIN triwulan ON triwulan.id_triwulan = keterangan.id_triwulan
                                JOIN prodi ON prodi.id_prodi = keterangan.id_prodi
                                WHERE keterangan.id_ket = '" . $id_ket . "'");
            $datas = mysqli_fetch_assoc($data);
            ?>
            <a href="../tw/index.php?id_triwulan=<?php echo $datas['id_tw']; ?>&id_prodi=<?php echo  $datas['id_pro']; ?>" class="btn btn-sm btn-danger" name="cancel" type="cancel"></i>Cancel</a>
        </div>
        <br />
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?php echo $datas['nama_triwulan']; ?> - <?php echo $datas['nama_prodi']; ?> (EDIT)</h6>
            </div>
            <div class="card-body">
                <form method="post" action="../../action/update/ket.php">
                    <input type="hidden" value="<?php echo $id_ket; ?>" class="form-control" id="id_ket" name="id_ket">
                    <input type="hidden" value="<?php echo $datas['id_tw']; ?>" class="form-control" id="id_triwulan" name="id_triwulan">
                    <input type="hidden" value="<?php echo $datas['id_pro']; ?>" class="form-control" id="id_prodi" name="id_prodi">
                    <div class="form-group">
                        <label for="indikator">Indikator</label>
                        <select class="form-control" name="indikator">
                            <option value="<?php echo $datas['id_iku'] ?>"><?php echo $datas['indikator']; ?></option>
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
                        <input type="text" class="form-control" id="progres" placeholder="Progres" name="progres" value="<?php echo $datas['progres'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="kendala">Kendala</label>
                        <input type="text" class="form-control" id="kendala" placeholder="Kendala" name="kendala" value="<?php echo $datas['kendala'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="strategi">Strategi</label>
                        <input type="text" class="form-control" id="strategi" placeholder="Strategi" name="strategi" value="<?php echo $datas['strategi'] ?>">
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