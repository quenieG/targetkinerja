<?php
session_start(); // memulai session

if (!isset($_SESSION['id'])) { // memeriksa apakah user telah login
  header("Location: ../../view/auth/login.php"); // jika belum, arahkan ke halaman login
  exit;
}

$_SESSION['id'];

// Cek apakah pengguna telah melakukan logout
if (isset($_GET['logout'])) {
  // Hapus semua session
  session_destroy();
  // Redirect ke halaman login
  header("Location: ../../view/dashboard/landingpage.php");
  exit;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>IKU - Dashboard</title>
  <link rel="icon" href="assets/images/poltesa.jpg">
  <!-- Custom fonts for this template-->
  <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
  <!-- Custom styles for this template-->
  <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet" />

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.18.0/js/md5.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
</head>

<body id="page-top">
  <div id="wrapper">
    <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../../view/dashboard/dashboard.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-chart-pie"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Indikator Kinerja Utama</div>
      </a>
      <hr class="sidebar-divider my-0" />
      <li class="nav-item active">
        <a class="nav-link" href="../../view/dashboard/dashboard.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <?php
      //  echo var_dump($_SESSION['role']);
      // echo var_dump($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'Ketua Jurusan' || $_SESSION['role'] == 'Direktur' || $_SESSION['role'] == 'Wakil Direktur');
      if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'Ketua Jurusan' || $_SESSION['role'] == 'Direktur' || $_SESSION['role'] == 'Wakil Direktur') {
      ?>

        <hr class="sidebar-divider" />
        <div class="sidebar-heading">Interface</div>
        <li class="nav-item">
          <a class="nav-link" href="../../view/jurusan/index.php">
            <i class="fas fa-fw fa-folder"></i>
            <span>Jurusan</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../view/prodi/index.php">
            <i class="fas fa-fw fa-folder"></i>
            <span>Program Studi</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../view/iku/index.php">
            <i class="fas fa-fw fa-folder"></i>
            <span>Target Kinerja</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../view/triwulan/index.php">
            <i class="fas fa-fw fa-folder"></i>
            <span>Triwulan</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../view/capaian/index.php">
            <i class="fas fa-fw fa-folder"></i>
            <span>Capaian Program Studi</span></a>
        </li>
        <?php
          // Menampilkan menu "Kelola User" hanya untuk admin
          if ($_SESSION['role'] == 'admin') {
        ?>
        <li class="nav-item">
          <a class="nav-link" href="../../view/admin/index.php">
            <i class="fas fa-fw fa-folder"></i>
            <span>Kelola User</span>
          </a>
        </li>
      <?php
        } // Penutup blok if untuk admin
        } // Penutup blok if untuk role selain admin
      ?>

      <hr class="sidebar-divider" />
      <div class="sidebar-heading">Program Studi</div>

      <?php
      include "../../includes/koneksi.php"; // memanggil file koneksi.php untuk koneksi ke database
      $no = 1; // variabel untuk membuat nomor urut 

      // $query = "SELECT * FROM jurusan WHERE id_jurusan = $id";
      // $result = mysqli_query($koneksi, $query);

      // // Periksa apakah ada baris data yang dikembalikan
      // if (mysqli_num_rows($result) > 0) {
      //   $row = mysqli_fetch_assoc($result);
      //   $nama_jurusan = $row['nama_jurusan'];
      // }
      $data = "";
      $usernamee = $_SESSION['role'];
      $id = $_SESSION['id']; // Mengambil nilai username dari session
      // echo $_SESSION['role'];
      if ($usernamee != 'admin' && $usernamee != 'Ketua Jurusan' && $usernamee != 'Direktur' && $usernamee != 'Wakil Direktur') {
        // echo var_dump("dfdf");

        // Query untuk mengambil role dari tabel user
        $username_prodi = "SELECT * FROM user WHERE id = '$id'";

        $result = mysqli_query($koneksi, $username_prodi);
    
        // Periksa jika query berhasil dieksekusi
        // echo var_dump($result);
        if ($result) {
          $dx = mysqli_fetch_assoc($result); // Ambil hasil query sebagai array
          $role = $dx['id_prodi'];
          
          // Query untuk mengambil data prodi berdasarkan role
          $query_prodi = "SELECT * FROM prodi WHERE id_prodi = '$role'";
          $result_prodi = mysqli_query($koneksi, $query_prodi);
          $prodi = mysqli_fetch_assoc($result_prodi);
          // echo var_dump($prodi);
    
            // Pastikan prodi ditemukan sebelum melanjutkan
            if ($prodi) {
    ?>
                <!-- Tampilkan navigasi -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages<?php echo $prodi['id_prodi']; ?>" aria-expanded="false" aria-controls="collapsePages<?php echo $prodi['id_prodi']; ?>">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span><?php echo $prodi['nama_prodi']; ?></span>
                    </a>
                    <div id="collapsePages<?php echo $prodi['id_prodi']; ?>" class="collapse" aria-labelledby="headingPages<?php echo $prodi['id_prodi']; ?>" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Pengukuran :</h6>
                            <a class="collapse-item" href="../../view/tw/pengukuran.php?id_prodi=<?php echo $prodi['id_prodi']; ?>">Pengukuran</a>
                            <h6 class="collapse-header">Triwulan :</h6>
                            <?php
                            // Mengambil tahun saat ini
                            $tahun_sekarang = date('Y');
                            // Query untuk mengambil data triwulan berdasarkan tahun saat ini
                            $query_triwulan = "SELECT * FROM triwulan WHERE tahun_triwulan = '$tahun_sekarang' GROUP BY nama_triwulan";
                            $data_tri = mysqli_query($koneksi, $query_triwulan);
                            // Memulai loop untuk menampilkan setiap triwulan
                            while ($d_tw = mysqli_fetch_array($data_tri)) {
                            ?>
                                <a class="collapse-item" href="../../view/tw/index.php?id_triwulan=<?php echo $d_tw['id_triwulan'] ?>&id_prodi=<?php echo $prodi['id_prodi']; ?>"><?php echo $d_tw['nama_triwulan'] ?></a>
                            <?php } ?>
                        </div>
                    </div>
                </li>
    <?php
            } // Penutup if ($prodi)
        } // Penutup if ($result)
      // echo var_dump("koor");
      } // Penutup if ($username != 'admin' && $username != 'ketua jurusan')
      else if ($usernamee == 'Ketua Jurusan') {
        // echo var_dump("ketua juruan");
        $username_prodi = "SELECT * FROM user WHERE id = '$id'";
        
        $result = mysqli_query($koneksi, $username_prodi);
        
        // Periksa jika query berhasil dieksekusi
        // echo var_dump($usernamee);
        if ($result) {
          $dx = mysqli_fetch_assoc($result); // Ambil hasil query sebagai array
          $role = $dx['id_jurusan'];
          
          // Query untuk mengambil data prodi berdasarkan role
          $query_prodi = "SELECT * FROM prodi WHERE id_jurusan = '$role'";
          $data = mysqli_query($koneksi, $query_prodi); 
          // echo var_dump($usernamee);
          }
          }
          else {
            // query untuk memilih semua data dari tabel prodi
            $data = mysqli_query($koneksi, "SELECT * FROM prodi");
            // echo var_dump("admin");
          }    
      // echo var_dump($usernamee);
      if ($usernamee == 'admin' || $usernamee == 'Ketua Jurusan' || $usernamee == 'Direktur' || $usernamee == 'Wakil Direktur') {
          
      
      while ($d = mysqli_fetch_array($data)) { // perulangan while untuk menampilkan data 
      
      ?>

        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages<?php echo $d['id_prodi']; ?>" aria-expanded="false" aria-controls="collapsePages<?php echo $d['id_prodi']; ?>">
            <i class="fas fa-fw fa-chart-area"></i>
            <span><?php echo $d['nama_prodi']; ?></span>
          </a>
          <div id="collapsePages<?php echo $d['id_prodi']; ?>" class="collapse" aria-labelledby="headingPages<?php echo $d['id_prodi']; ?>" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Pengukuran :</h6>
              <a class="collapse-item" href="../../view/tw/pengukuran.php?id_prodi=<?php echo $d['id_prodi']; ?>">Pengukuran</a>
              <h6 class="collapse-header">Triwulan :</h6>
              <?php
               // Mengambil tahun saat ini
              $tahun_sekarang = date('Y');
              // Menjalankan query SQL untuk mengambil data dari tabel triwulan berdasarkan tahun saat ini
              $data_tri = mysqli_query($koneksi, "SELECT * FROM triwulan WHERE tahun_triwulan = '$tahun_sekarang' GROUP BY nama_triwulan");
                // Memulai loop untuk mengambil setiap baris hasil query
              while ($d_tw = mysqli_fetch_array($data_tri)) {
              ?>
                <a class="collapse-item" href="../../view/tw/index.php?id_triwulan=<?php echo $d_tw['id_triwulan'] ?>&id_prodi=<?php echo $d['id_prodi']; ?>"><?php echo $d_tw['nama_triwulan'] ?></a>
              <?php } ?>
            </div>
        </li>
      <?php }} ?>
      <hr class="sidebar-divider d-none d-md-block" />
    </ul>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <!-- Tombol untuk menampilkan/menyembunyikan sidebar pada layar kecil -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Elemen pada navbar sebelah kanan -->
          <ul class="navbar-nav ml-auto">
            <!-- Pembatas antara elemen navbar -->
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Tautan untuk logout -->
            <a class="dropdown-item" href="?logout=true">Logout</a>
          </ul>
        </nav>

        <?php
        // Memeriksa apakah variabel session 'message' ada dan 'msg_type' bernilai 'success'
        if (isset($_SESSION['message']) && $_SESSION['msg_type'] == 'success') {
          // Jika kondisi terpenuhi, tampilkan pesan sukses dalam alert bootstrap
          echo '<div class="alert alert-success text-center">' . $_SESSION['message'] . '</div>';

          // Hapus variabel session 'message' dan 'msg_type'
          unset($_SESSION['message']);
          unset($_SESSION['msg_type']);
        }

        // Memeriksa apakah variabel session 'message' ada dan 'msg_type' bernilai 'error'
        if (isset($_SESSION['message']) && $_SESSION['msg_type'] == 'error') {
          // Jika kondisi terpenuhi, tampilkan pesan error dalam alert bootstrap
          echo '<div class="alert alert-danger text-center">' . $_SESSION['message'] . '</div>';

          // Hapus variabel session 'message' dan 'msg_type'
          unset($_SESSION['message']);
          unset($_SESSION['msg_type']);
        }
        ?>