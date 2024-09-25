<?php 
// Memulai session
session_start();

// Melakukan koneksi ke database
include '../../includes/koneksi.php';

// Cek apakah pengguna adalah admin
if ($_SESSION['role'] !== 'admin') {
    $_SESSION['message'] = "Hanya admin yang dapat menghapus data";
    $_SESSION['msg_type'] = 'error';
    header("location:../../view/triwulan/index.php");
    exit;
}
 
// Menangkap data id yang dikirim dari url
$id = $_GET['id_triwulan'];
 
// Menghapus data dari database
$query = "DELETE FROM triwulan WHERE id_triwulan='$id'";
if (mysqli_query($koneksi, $query)) {
    // Jika berhasil dihapus, simpan pesan sukses ke dalam session
    $_SESSION['message'] = "Data berhasil dihapus";
    $_SESSION['msg_type'] = 'success';
} else {
    // Jika gagal dihapus, simpan pesan error dan detail error ke dalam session
    $_SESSION['message'] = "Data gagal dihapus: " . mysqli_error($koneksi);
    $_SESSION['msg_type'] = 'error';
}

// Mengalihkan halaman kembali ke halaman triwulan.php
header("location:../../view/triwulan/index.php");
?>