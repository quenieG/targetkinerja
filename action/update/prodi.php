<?php
// Memulai session
session_start();

// Sertakan file koneksi ke database
include '../../includes/koneksi.php'; 

// Cek apakah pengguna adalah admin
if ($_SESSION['role'] !== 'admin') {
    $_SESSION['message'] = "Hanya admin yang dapat mengubah data";
    $_SESSION['msg_type'] = 'error';
    header("location:../../view/prodi/index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirim dari form
    $id_prodi = $_POST['id_prodi'];
    $id_jurusan = $_POST['id_jurusan'];
    $nama_prodi = $_POST['nama_prodi'];

    // Query untuk update data prodi
    $query = "UPDATE prodi SET id_jurusan='$id_jurusan', nama_prodi='$nama_prodi' WHERE id_prodi='$id_prodi'";


    // Jalankan query untuk mengupdate data
    if (mysqli_query($koneksi, $query)) {
        // Jika berhasil diupdate, arahkan kembali ke halaman utama dengan pesan sukses
        $_SESSION['message'] = "Data berhasil diupdate";
        $_SESSION['msg_type'] = 'success';
        header("location:../../view/prodi/index.php");
        exit(); // Keluar dari script
    } else {
        // Jika gagal diupdate, arahkan kembali ke halaman utama dengan pesan error
        $_SESSION['message'] = "Data gagal diupdate: " . mysqli_error($koneksi);
        $_SESSION['msg_type'] = 'error';
        header("location:../../view/prodi/index.php");
        exit(); // Keluar dari script
    }
}
?>