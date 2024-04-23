<?php 
// koneksi database
include 'koneksi.php';

// menangkap data id yang dikirim dari URL
$id_capaian = $_GET['id_capaian'];

// mengambil id_triwulan dari capaian yang akan dihapus
$query = mysqli_query($koneksi, "SELECT id_triwulan FROM capaian WHERE id_capaian='$id_capaian'");
$data = mysqli_fetch_assoc($query);
$id_tw = $data['id_triwulan'];

// menghapus data dari database
mysqli_query($koneksi,"DELETE FROM capaian WHERE id_capaian='$id_capaian'");

// mengalihkan halaman kembali ke halaman tw.php
header("Location: tw.php?id_triwulan=" . $id_tw);
?>
