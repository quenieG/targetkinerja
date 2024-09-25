<?php 
// Memulai session
session_start();

// Melakukan koneksi ke database
include '../../includes/koneksi.php';

// Cek apakah pengguna adalah admin
if ($_SESSION['role'] !== 'admin') {
    $_SESSION['message'] = "Hanya admin yang dapat menghapus data";
    $_SESSION['msg_type'] = 'error';
    header("location:../../view/prodi/index.php");
    exit;
}
 
// Menangkap data id yang dikirim dari url
$id = $_GET['id_prodi'];
 
// Menghapus data dari database
if (mysqli_query($koneksi,"delete from prodi where id_prodi='$id'")) {
    // Jika berhasil dihapus, arahkan kembali ke halaman utama dengan pesan sukses
    $_SESSION['message'] = "Data berhasil dihapus dari database";
    $_SESSION['msg_type'] = "success";
} else {
    // Jika gagal dihapus, arahkan kembali ke halaman utama dengan pesan error
    $_SESSION['message'] = "Error: Data gagal dihapus dari database";
    $_SESSION['msg_type'] = "error";
}

// Mengalihkan halaman kembali ke halaman prodi.php
header("location:../../view/prodi/index.php");
 
?>