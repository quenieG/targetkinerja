<?php
// Memulai session
session_start();

include '../../includes/koneksi.php'; // Sertakan file koneksi ke database

// Cek apakah pengguna adalah admin
if ($_SESSION['role'] !== 'admin') {
    $_SESSION['message'] = "Hanya admin yang dapat menambahkan data";
    $_SESSION['msg_type'] = 'error';
    header("location:../../view/prodi/index.php");
    exit;
}

if (isset($_POST['proses'])) {
    // Ambil data yang dikirim dari form
    $nama_prodi = $_POST['nama_prodi'];
    $id_jurusan = $_POST['id_jurusan'];

    // Query untuk menambahkan data prodi
    $query = "INSERT INTO prodi (nama_prodi, id_jurusan) VALUES ('$nama_prodi', '$id_jurusan')";

    // Jalankan query untuk menambahkan data
    if (mysqli_query($koneksi, $query)) {
        // Jika berhasil ditambahkan, arahkan kembali ke halaman utama dengan pesan sukses
        $_SESSION['message'] = "Data berhasil ditambahkan ke database";
        $_SESSION['msg_type'] = "success";
        header("location:../../view/prodi/index.php");
        exit(); // Keluar dari script
    } else {
        // Jika gagal ditambahkan, arahkan kembali ke halaman utama dengan pesan error
        $_SESSION['message'] = "Error: " . $query . "<br>" . mysqli_error($koneksi);
        $_SESSION['msg_type'] = "error";
        header("location:../../view/prodi/index.php");
        exit(); // Keluar dari script
    }
}
?>