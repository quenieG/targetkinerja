<?php
// Memasukkan file header.php
include '../../includes/header.php';
// Melakukan koneksi ke database
include '../../includes/koneksi.php';

// $id_user = $_SESSION['id'];

// if (isset($_GET['tahun_triwulan'])) {
//   $data_tri = mysqli_query($koneksi, "SELECT id_triwulan FROM triwulan WHERE tahun_triwulan = $_GET[tahun_triwulan] AND id_triwulan = '$_GET[id_triwulan]'");
//   $row = mysqli_fetch_assoc($data_tri);
//   $id_triwulan = isset($row['id_triwulan']) ? $row['id_triwulan'] : '';

//   $id_prodi = $_GET['id_prodi'];
//   $id_triwulan = isset($_GET['id_triwulan']) ? $_GET['id_triwulan'] : '';
//   $tahun_triwulan = isset($_GET['tahun_triwulan']) ? $_GET['tahun_triwulan'] : date('Y');

//   $data_prodi = mysqli_query($koneksi, "SELECT nama_prodi FROM prodi WHERE id_prodi = '$id_prodi'");
//   $row = mysqli_fetch_assoc($data_prodi);
//   $nama_prodi = $row['nama_prodi'];
// } else {
//   $id_triwulan = isset($_GET['id_triwulan']) ? $_GET['id_triwulan'] : '';
//   $id_prodi = $_GET['id_prodi'];

//   $data_tri = mysqli_query($koneksi, "SELECT nama_triwulan, tahun_triwulan FROM triwulan WHERE id_triwulan = '$id_triwulan'");
//   $row = mysqli_fetch_assoc($data_tri);
//   $nama_triwulan = isset($row['nama_triwulan']) ? $row['nama_triwulan'] : '';
//   $tahun_triwulan = isset($row['tahun_triwulan']) ? $row['tahun_triwulan'] : date('Y');

//   $data_prodi = mysqli_query($koneksi, "SELECT nama_prodi FROM prodi WHERE id_prodi = '$id_prodi'");
//   $row = mysqli_fetch_assoc($data_prodi);
//   $nama_prodi = $row['nama_prodi'];
// }
$id_triwulan = $_GET['id_triwulan'];
$id_prodi = $_GET['id_prodi'];
$tahun_triwulan = $_GET['tahun_triwulan'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cetak Keterangan</title>
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
      .kop-surat img {
        height: 100px;
      }

      .sidebar,
      .topbar,
      .btn,
      .form-group {
        display: none !important;
      }

      .container-fluid,
      .card-body {
        width: 100%;
        margin: 0;
        padding: 0;
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
      <script>
        window.print();
        window.onafterprint = function() {
            window.location.href = 'http://localhost/targetkinerja1/view/tw/index.php?id_triwulan=<?php echo $id_triwulan; ?>&id_prodi=<?php echo $id_prodi; ?>';
        };
      </script>
    </div>
  </div>
</body>

</html>

<?php
// Memasukkan file footer.php
include '../../includes/footer.php';
?>
