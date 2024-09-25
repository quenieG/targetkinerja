<?php 
// Memulai session
session_start();

// Melakukan koneksi ke database
include '../../includes/koneksi.php';

// menangkap data id yang dikirim dari URL
$id_capaian = $_GET['id_capaian'];
$id_triwulan = $_GET['id_triwulan'];
$id_prodi = $_GET['id_prodi'];
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
    $_SESSION['message'] = "Hanya pengguna dengan prodi " . $nama_prodi . " yang dapat menghapus data";
    $_SESSION['msg_type'] = 'error';
    header("Location: ../../view/tw/index.php?id_triwulan=" . $id_triwulan . "&id_prodi=" . $id_prodi);
    exit;
}

echo var_dump($id_capaian);
// menghapus data dari database
mysqli_query($koneksi,"DELETE FROM capaian WHERE id_capaian='$id_capaian'");

// mengalihkan halaman kembali ke halaman tw.php
header("Location: ../../view/tw/index.php?id_triwulan=" . $id_triwulan . "&id_prodi=" . $id_prodi);
?>