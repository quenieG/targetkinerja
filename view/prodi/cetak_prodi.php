
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Program Studi</title>
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
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead class="bg-primary text-center text-white">
            <tr>
              <th>No</th>
              <th>Jurusan</th>
              <th>Program Studi</th>
                <th class="d-print-none">Aksi</th>
            </tr>
          </thead>
          <tbody class="text-center">
            <?php
            // Sertakan file koneksi ke database
            include '../../includes/koneksi.php';
            $no = 1;

            // Query untuk mengambil data jurusan dan program studi
            $data = mysqli_query($koneksi, "SELECT jurusan.id_jurusan, jurusan.nama_jurusan, prodi.id_prodi, prodi.nama_prodi FROM jurusan JOIN prodi ON jurusan.id_jurusan = prodi.id_jurusan; ");

            // Loop untuk menampilkan data
            while ($d = mysqli_fetch_array($data)) {
            ?>
              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $d['nama_jurusan']; ?></td>
                <td>
                  <?php
                  // Menampilkan nama program studi
                  echo $d['nama_prodi']
                  ?>
                </td>
                  <td class="d-print-none">
                    <!-- Tombol untuk mengedit dan menghapus data -->
                    <a href="edit.php?id_prodi=<?php echo $d['id_prodi']; ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                    <a href="../../action/delete/prodi.php?id_prodi=<?php echo $d['id_prodi']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus Program Studi ini?')"><i class="fas fa-trash-alt"></i></a>
                  </td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
                    <script>
                        window.print();
                        window.onafterprint = function() {
                            window.location.href = 'index.php'; // Replace with the actual path to your index page
                        };
                    </script>
                </div>
            </div>
    <?php
    include '../../includes/footer.php';
    ?>
</body>
</html>
