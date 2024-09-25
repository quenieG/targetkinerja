<?php
// Memasukkan file header.php
include '../../includes/header.php';
// Melakukan koneksi ke database
include '../../includes/koneksi.php';

// Mendapatkan filter indikator dan tahun dari URL
$indikator = isset($_GET['indikator']) ? mysqli_real_escape_string($koneksi, $_GET['indikator']) : '';
$tahun = isset($_GET['tahun']) ? mysqli_real_escape_string($koneksi, $_GET['tahun']) : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Capaian Program Studi</title>
    <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet" />
    <style>
        .kop-surat {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .kop-surat img {
            height: 100px;
            margin-right: 20px;
        }
        .kop-surat .text {
            font-family: Times, serif;
            text-align: center;
        }
        .kop-surat .text h1 {
            margin: 0;
            font-size: 25px;
            font-weight: bold;
        }
        .kop-surat .text h3 {
            margin: 5px 0;
            font-size: 23px;
            font-weight: bold;
        }
        .kop-surat .text p {
            margin: 5px 0;
            font-size: 18px;
        }

        @media print {
            /* Hide elements that are not necessary for printing */
            .sidebar, .topbar, .btn, .form-group {
                display: none !important;
            }

            /* Ensure the content takes full width */
            .container-fluid, .card-body {
                width: 100%;
                margin: 0;
                padding: 0;
            }

            /* Maintain the styles for kop surat */
            .kop-surat img {
                height: 100px;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="kop-surat d-flex row">
            <img src="../../assets/images/monokrom.png" alt="Logo">
            <div class="text">
                <h1>KEMENTRIAN PENDIDIKAN, KEBUDAYAAN RISET, DAN TEKNOLOGI</h1>
                <h3><b>POLITEKNIK NEGERI SAMBAS</b></h3>
                <p>Jl. Raya Sejangkung, Sambas, 79462 Kalimantan Barat</p>
                <p>Tlp: (0562) 6303123 Laman : www.poltesa.ac.id; email : info@poltesa.ac.id</p>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form>
                <!-- Struktur tabel -->
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                        if (!empty($indikator) && !empty($tahun)) {
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
            <script>
                window.print();
                window.onafterprint = function() {
                    window.location.href = 'index.php'; // Replace with the actual path to your index page
                };
            </script>
        </div>
    </div>
</body>
</html>
