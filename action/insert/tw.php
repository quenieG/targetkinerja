<?php
// Memulai session
session_start();

// Melakukan koneksi ke database
include '../../includes/koneksi.php';

if (isset($_POST['proses'])) {
    $tahun_triwulan = $_POST['tahun_triwulan'];
    $nama_triwulan = $_POST['nama_triwulan'];
    $id_iku = $_POST['indikator'];
    $id_prodi = $_POST['id_prodi'];
    $satuan = $_POST['satuan'];
    $data_pembagi = $_POST['data_pembagi'];
    $capaian_tw = $_POST['capaian_tw'];

    // mengambil nama prodi dari tabel prodi
    $id_user = $_GET['id_user'];

// mengambil nama prodi dari tabel prodi
$query = "SELECT id_prodi FROM prodi WHERE id_prodi = '$id_prodi'";
$queryNama = "SELECT nama_prodi FROM prodi WHERE id_prodi = '$id_prodi'";
$queryUser = "SELECT id_prodi FROM user WHERE id = '$id_user'";
$result = mysqli_query($koneksi, $query);
$resultNama = mysqli_query($koneksi, $queryNama);
$resultUser = mysqli_query($koneksi, $queryUser);
$row = mysqli_fetch_assoc($result);
$rowNama = mysqli_fetch_assoc($resultNama);
$rowUser = mysqli_fetch_assoc($resultUser);
$id_prodiRow = $row['id_prodi'];
$id_userRow = $row['id_prodi'];
$nama_prodi = $row['nama_prodi'];


if ($id_prodiRow !== $id_userRow) {
        $_SESSION['message'] = "Hanya pengguna dengan prodi " . $nama_prodi . " yang dapat menambah data";
        $_SESSION['msg_type'] = 'error';
        header("Location: ../../view/tw/index.php?id_triwulan=" . $id_triwulan . "&id_prodi=" . $id_prodi);
        exit;
    }


    // Query untuk mendapatkan id_triwulan berdasarkan tahun_triwulan
    $query_tw = "SELECT id_triwulan FROM triwulan WHERE tahun_triwulan = '$tahun_triwulan' AND nama_triwulan = '$nama_triwulan'";
    $result_tw = mysqli_query($koneksi, $query_tw);
    $row_tw = mysqli_fetch_assoc($result_tw);
    $id_triwulan = $row_tw['id_triwulan']; // id_triwulan berdasarkan tahun_triwulan

    // Query untuk memasukkan data ke dalam tabel capaian
    $query = "INSERT INTO capaian (id_triwulan, id_iku, id_prodi, satuan, data_pembagi, capaian_tw) 
    VALUES ('$id_triwulan', '$id_iku', '$id_prodi', '$satuan', '$data_pembagi', '$capaian_tw')";

    // Lakukan query
    if (mysqli_query($koneksi, $query)) {
        echo "Data berhasil ditambahkan ke database";
        header("Location: ../../view/tw/index.php?id_triwulan=" . $id_triwulan . "&id_prodi=" . $id_prodi);
        exit(); // Selesai, keluar dari script
    } else {
        // Jika query gagal, tampilkan pesan error
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
}
