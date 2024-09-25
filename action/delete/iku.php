<?php 
// Memulai session
session_start();

// Melakukan koneksi ke database
include '../../includes/koneksi.php';

// Cek apakah pengguna adalah admin
if ($_SESSION['role'] !== 'admin') {
    $_SESSION['message'] = "Hanya admin yang dapat menghapus data";
    $_SESSION['msg_type'] = 'error';
    header("location:../../view/iku/index.php");
    exit;
}
 
// Menangkap data id yang dikirim dari url
$id = $_GET['id_iku'];
 
// Menghapus data dari database
$query = "DELETE FROM iku WHERE id_iku='$id'";
if (mysqli_query($koneksi, $query)) {
    // Jika berhasil dihapus, arahkan kembali ke halaman utama dengan pesan sukses
    $_SESSION['message'] = "Data berhasil dihapus";
    $_SESSION['msg_type'] = 'success';
} else {
    // Jika gagal dihapus, arahkan kembali ke halaman utama dengan pesan error
    $_SESSION['message'] = "Data gagal dihapus: " . mysqli_error($koneksi);
    $_SESSION['msg_type'] = 'error';
}

// Mengalihkan halaman kembali ke halaman iku.php
header("location:../../view/iku/index.php");
?>