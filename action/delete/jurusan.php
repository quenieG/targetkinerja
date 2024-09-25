<?php
// Memulai session
session_start();

// Melakukan koneksi ke database
include '../../includes/koneksi.php';

// Cek apakah pengguna adalah admin
if ($_SESSION['role'] !== 'admin') {
    $_SESSION['message'] = "Hanya admin yang dapat menghapus data";
    $_SESSION['msg_type'] = 'error';
    header("location:../../view/jurusan/index.php");
    exit;
}

// Menangkap data id yang dikirim dari URL
$id_jurusan = $_GET['id_jurusan'];

// Menghapus data dari tabel program studi yang terkait dengan jurusan yang akan dihapus
$query1 = "DELETE FROM prodi WHERE id_jurusan='$id_jurusan'";
if (mysqli_query($koneksi, $query1)) {
    // Jika berhasil, lanjut ke query berikutnya
} else {
    // Jika gagal, simpan pesan error ke dalam session
    $_SESSION['message'] = "Error: " . $query1 . "<br>" . mysqli_error($koneksi);
    $_SESSION['msg_type'] = "error";
}

// Menghapus data dari tabel jurusan
$query2 = "DELETE FROM jurusan WHERE id_jurusan='$id_jurusan'";
if (mysqli_query($koneksi, $query2)) {
    // Jika berhasil, simpan pesan sukses ke dalam session
    $_SESSION['message'] = "Data berhasil dihapus dari database";
    $_SESSION['msg_type'] = "success";
} else {
    // Jika gagal, simpan pesan error ke dalam session
    $_SESSION['message'] = "Error: " . $query2 . "<br>" . mysqli_error($koneksi);
    $_SESSION['msg_type'] = "error";
}

// Mengalihkan halaman kembali ke halaman jurusan.php
header("location:../../view/jurusan/index.php");
