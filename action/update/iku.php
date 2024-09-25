<?php
// Memulai session
session_start();

// Melakukan koneksi ke database
include '../../includes/koneksi.php';

// Cek apakah pengguna adalah admin
if ($_SESSION['role'] !== 'admin') {
    $_SESSION['message'] = "Hanya admin yang dapat mengubah data";
    $_SESSION['msg_type'] = 'error';
    header("location:../../view/iku/index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirim dari form
    $id_iku = $_POST['id_iku'];
    $sasaran = $_POST['sasaran'];
    $no_iku = $_POST['no_iku'];
    $indikator = $_POST['indikator'];
    $target_kinerja = $_POST['target_kinerja'];

    // Query untuk update data jurusan
    $query = "UPDATE iku SET sasaran='$sasaran', no_iku='$no_iku', indikator='$indikator', target_kinerja='$target_kinerja' WHERE id_iku='$id_iku'";

    // Jalankan query untuk mengupdate data
    if (mysqli_query($koneksi, $query)) {
        // Jika berhasil diupdate, simpan pesan sukses ke dalam session
        $_SESSION['message'] = "Data berhasil diupdate";
        $_SESSION['msg_type'] = 'success';
    } else {
        // Jika gagal diupdate, simpan pesan error dan detail error ke dalam session
        $_SESSION['message'] = "Error: " . $query . "<br>" . mysqli_error($koneksi);
        $_SESSION['msg_type'] = 'error';
    }
    // Mengalihkan halaman kembali ke halaman iku.php
    header("location:../../view/iku/index.php");
    exit(); // Keluar dari script
}
?>