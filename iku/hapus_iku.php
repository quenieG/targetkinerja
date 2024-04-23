<?php 
// koneksi database
include '../koneksi.php';
 
// menangkap data id yang di kirim dari url
$id = $_GET['id_iku'];
 
 
// menghapus data dari database
mysqli_query($koneksi,"delete from iku where id_iku='$id'");
 
// mengalihkan halaman kembali ke index.php
header("location:iku.php");
 
?>