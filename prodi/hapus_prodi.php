<?php 
// koneksi database
include '../koneksi.php';
 
// menangkap data id yang di kirim dari url
$id = $_GET['id_prodi'];
 
 
// menghapus data dari database
mysqli_query($koneksi,"delete from prodi where id_prodi='$id'");
 
// mengalihkan halaman kembali ke index.php
header("location:prodi.php");
 
?>