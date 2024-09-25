<?php
// Memulai session
session_start();

include '../../includes/koneksi.php'; // Sertakan file koneksi ke database

// Cek apakah pengguna adalah admin
if ($_SESSION['role'] !== 'admin') {
    $_SESSION['message'] = "Hanya admin yang dapat mengubah data";
    $_SESSION['msg_type'] = 'error';
    header("location:../../view/jurusan/index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirim dari form
    $id_jurusan = $_POST['id_jurusan'];
    $nama_jurusan = $_POST['nama_jurusan'];

    // Query untuk update data jurusan
    $query = "UPDATE jurusan SET nama_jurusan='$nama_jurusan' WHERE id_jurusan='$id_jurusan'";

    // Jalankan query untuk mengupdate data
    if (mysqli_query($koneksi, $query)) {
        // Jika berhasil diupdate, arahkan kembali ke halaman utama dengan pesan sukses
        $_SESSION['message'] = "Data berhasil diupdate";
        $_SESSION['msg_type'] = "success";
        header("location:../../view/jurusan/index.php");
        exit(); // Keluar dari script
    } else {
        // Jika gagal diupdate, arahkan kembali ke halaman utama dengan pesan error
        $_SESSION['message'] = "Data gagal diupdate";
        $_SESSION['msg_type'] = "error";
        header("location:../../view/jurusan/index.php");
        exit(); // Keluar dari script
    }
}
