<?php
// Memulai session
session_start();

// Melakukan koneksi ke database
include '../../includes/koneksi.php';

// Cek apakah pengguna adalah admin
if ($_SESSION['role'] !== 'admin') {
    $_SESSION['message'] = "Hanya admin yang dapat menambahkan data";
    $_SESSION['msg_type'] = 'error';
    header("location:../../view/jurusan/index.php");
    exit;
}

// Menangkap data id yang dikirim dari URL      
if (isset($_POST['proses'])) {

    // Menangkap data id yang dikirim dari URL
    $nama_jurusan = $_POST['nama_jurusan'];

    // Menyimpan data inputan ke dalam database 
    $query = "INSERT INTO jurusan (nama_jurusan) VALUES ('$nama_jurusan')";

    // Mengeksekusi query
    if (mysqli_query($koneksi, $query)) {
        // Menyimpan pesan sukses dan tipe pesan ke dalam session
        $_SESSION['message'] = "Data berhasil ditambahkan ke database";
        $_SESSION['msg_type'] = "success";
    } else {
        // Menyimpan pesan error, detail error, dan tipe pesan ke dalam session
        $_SESSION['message'] = "Error: " . $query . "<br>" . mysqli_error($koneksi);
        $_SESSION['msg_type'] = "error";
    }

    // Mengalihkan halaman kembali ke halaman jurusan.php   
    header("location:../../view/jurusan/index.php");
}