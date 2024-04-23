<?php 
// koneksi database
include '../koneksi.php';
 
// menangkap data id yang dikirim dari URL
$id_jurusan = $_GET['id_jurusan'];
 
// Menghapus data dari tabel program studi yang terkait dengan jurusan yang akan dihapus
mysqli_query($koneksi,"DELETE FROM prodi WHERE id_jurusan='$id_jurusan'");
 
// Menghapus data dari tabel jurusan
mysqli_query($koneksi,"DELETE FROM jurusan WHERE id_jurusan='$id_jurusan'");
 
// Mengalihkan halaman kembali ke halaman jurusan.php
header("location:jurusan.php");
 
?>
