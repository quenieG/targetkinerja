<?php
// Memasukkan file header.php
include '../../includes/header.php';
// Melakukan koneksi ke database
include '../../includes/koneksi.php';
?>

<!-- Form untuk memfilter data berdasarkan indikator dan tahun -->
<form action="index.php" method="get">
    <div class="container-fluid">
        <!-- Baris untuk input filter -->
        <div class="form-group row justify-content-end">
            <!-- Kolom untuk memilih indikator -->
            <div class="col-4">
                <div class="input-group mr-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="indikator-addon">Indikator :</span>
                    </div>
                    <!-- Dropdown untuk memilih indikator -->
                    <select id="indikator" name="indikator" class="form-control" aria-describedby="indikator-addon">
                        <?php
                        // Mengambil data indikator dari database
                        $indikators = mysqli_query($koneksi, "SELECT no_iku, indikator FROM iku ORDER BY no_iku");
                        echo "<option selected disabled hidden value=''>Pilih Indikator</option>";
                        // Menampilkan data indikator ke dalam dropdown
                        while ($indikator = mysqli_fetch_assoc($indikators)) {
                            echo "<option value='" . $indikator['no_iku'] . "'>" . $indikator['indikator'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <!-- Kolom untuk memilih tahun -->
            <div class="col-4">
                <div class="input-group mr-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="indikator-addon">Tahun :</span>
                    </div>
                    <!-- Dropdown untuk memilih tahun -->
                    <select id="tahun" name="tahun" class="form-control" aria-describedby="indikator-addon">
                        <?php
                        // Mengambil data tahun dari database
                        $tahun_query = mysqli_query($koneksi, "SELECT DISTINCT tahun_triwulan FROM triwulan ORDER BY tahun_triwulan DESC");
                        echo "<option selected disabled hidden value=''>Pilih Tahun</option>";
                        // Menampilkan data tahun ke dalam dropdown
                        while ($tahun_row = mysqli_fetch_assoc($tahun_query)) {
                            echo "<option value='" . $tahun_row['tahun_triwulan'] . "'>" . $tahun_row['tahun_triwulan'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <!-- Tombol untuk melakukan filter -->
            <button type="submit" name="filter" class="btn btn-warning mr-2">
                <i class="fas fa-filter"></i> Filter
            </button>
            <!-- Tombol untuk mencetak tabel -->
            <a href="cetak_capaian.php?indikator=<?php echo isset($_GET['indikator']) ? $_GET['indikator'] : ''; ?>&tahun=<?php echo isset($_GET['tahun']) ? $_GET['tahun'] : ''; ?>" class="btn btn-info mr-2"><i class="fa fa-print"></i> Print</a>
        </div>
        <br />
        <!-- Tabel untuk menampilkan data -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Capaian Program Studi</h6>
                <?php
                // Jika filter telah diterapkan, tampilkan indikator dan tahun yang dipilih
                if (isset($_GET['filter'])) {
                    $indikator = mysqli_real_escape_string($koneksi, $_GET['indikator']);
                    $tahun = mysqli_real_escape_string($koneksi, $_GET['tahun']);

                    $indikator_query = mysqli_query($koneksi, "SELECT indikator, no_iku FROM iku WHERE no_iku = '$indikator'");
                    $indikator_row = mysqli_fetch_assoc($indikator_query);
                    $indikator_no = $indikator_row['no_iku'];
                    $indikator_name = $indikator_row['indikator'];

                    echo "<h6 class='m-0'></br><b>Indikator</b> : $indikator_no - $indikator_name. </br><b>Tahun</b> : $tahun</h6>";
                }
                ?>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <form>
                        <!-- Struktur tabel -->
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead class="bg-primary text-center text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Program Studi</th>
                                    <th>Triwulan 1</th>
                                    <th>Triwulan 2</th>
                                    <th>Triwulan 3</th>
                                    <th>Triwulan 4</th>
                                    <th>Total</th>
                                    <th>Target Capaian</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php
                                // Jika filter telah diterapkan, tampilkan data berdasarkan filter
                                if (isset($_GET['filter'])) {
                                    $indikator = mysqli_real_escape_string($koneksi, $_GET['indikator']);
                                    $tahun = mysqli_real_escape_string($koneksi, $_GET['tahun']);

                                    // Query untuk mengambil data berdasarkan filter
                                    $query = "SELECT prodi.nama_prodi, prodi.id_prodi, iku.target_kinerja
                                            FROM prodi
                                            LEFT JOIN capaian ON prodi.id_prodi = capaian.id_prodi
                                            LEFT JOIN iku ON iku.id_iku = capaian.id_iku
                                            LEFT JOIN triwulan ON triwulan.id_triwulan = capaian.id_triwulan
                                            WHERE no_iku ='$indikator' AND tahun_triwulan='$tahun'
                                            GROUP BY prodi.nama_prodi";

                                    $result = mysqli_query($koneksi, $query);
                                    $no = 1;

                                    // Menampilkan data ke dalam tabel
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $no++ . "</td>";
                                        echo "<td>" . htmlspecialchars($row['nama_prodi']) . "</td>";
                                        
                                        $total = 0.00;
                                        for ($i = 1; $i <= 4; $i++) {
                                            $query1 = "SELECT capaian_tw/data_pembagi*100 as value_tw
                                                    FROM capaian
                                                    JOIN iku ON iku.id_iku = capaian.id_iku
                                                    JOIN triwulan ON triwulan.id_triwulan = capaian.id_triwulan
                                                    WHERE no_iku ='$indikator' AND nama_triwulan='Triwulan $i' AND tahun_triwulan='$tahun' 
                                                    AND id_prodi = {$row['id_prodi']}";
                                            $result1 = mysqli_query($koneksi, $query1);
                                            $row1 = mysqli_fetch_assoc($result1);

                                            $value_tw = isset($row1['value_tw']) ? $row1['value_tw'] : 0.00;
                                            $total += $value_tw;
                                            echo "<td class='text-center'>" . number_format($value_tw, 0) .  " % </td>";
                                        }

                                        $total = min($total, 500);
                                        $total = $total / 4;
                                        echo "<td class='text-center'>" . number_format($total, 0) . " % </td>";
                                        echo "<td class='text-center'>" . htmlspecialchars($row['target_kinerja']) . " % </td>";

                                        // Menentukan keterangan
                                        $keterangan = $total >= $row['target_kinerja'] ? "Tercapai" : "Tidak Tercapai";
                                        echo "<td class='text-center'>" . htmlspecialchars($keterangan) . "</td>";

                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</form>

<?php include '../../includes/footer.php'; ?>
