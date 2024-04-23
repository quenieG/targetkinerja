<?php 
// koneksi database
include '../koneksi.php';
 
// menangkap data id yang di kirim dari url
$id = $_GET['id_triwulan'];
 
 
// menghapus data dari database
mysqli_query($koneksi,"delete from triwulan where id_triwulan='$id'");
 
// mengalihkan halaman kembali ke index.php
header("location:triwulan.php");
 
?>