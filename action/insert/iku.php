<?php
// Memulai session
session_start();

// Melakukan koneksi ke database
include '../../includes/koneksi.php';

// Cek apakah pengguna adalah admin
if ($_SESSION['role'] !== 'admin') {
    $_SESSION['message'] = "Hanya admin yang dapat menambahkan data";
    $_SESSION['msg_type'] = 'error';
    header("location:../../view/iku/index.php");
    exit;
}

// Cek apakah tombol proses telah ditekan
if (isset($_POST['proses'])) {
    $sasaran = $_POST['sasaran'];
    $no_iku = $_POST['no_iku'];
    $indikator = $_POST['indikator'];
    $target_kinerja = $_POST['target_kinerja'];

    // Query untuk memasukkan data ke dalam tabel iku
    $query = "INSERT INTO iku (sasaran, no_iku, indikator, target_kinerja) VALUES ('$sasaran', '$no_iku', '$indikator', '$target_kinerja')";
    if (mysqli_query($koneksi, $query)) {
        // Jika query berhasil, simpan pesan sukses ke dalam session
        $_SESSION['message'] = "Data berhasil ditambahkan ke database";
        $_SESSION['msg_type'] = 'success';
    } else {
        // Jika query gagal, simpan pesan error dan detail error ke dalam session
        $_SESSION['message'] = "Error: " . $query . "<br>" . mysqli_error($koneksi);
        $_SESSION['msg_type'] = 'error';
    }
    // Mengalihkan halaman kembali ke halaman iku.php
    header("location:../../view/iku/index.php");
}