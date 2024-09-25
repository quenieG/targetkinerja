<?php
// Memulai session
session_start();

// Melakukan koneksi ke database
include '../../includes/koneksi.php';

// Cek apakah pengguna adalah admin
if ($_SESSION['role'] !== 'admin') {
    $_SESSION['message'] = "Hanya admin yang dapat mengubah data";
    $_SESSION['msg_type'] = 'error';
    header("location:../../view/triwulan/index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirim dari form
    $id_triwulan = $_POST['id_triwulan'];
    $nama_triwulan = $_POST['nama_triwulan'];
    $tahun_triwulan = $_POST['tahun_triwulan'];

    // Validasi nama_triwulan agar hanya 1, 2, 3, atau 4 yang diterima
    if (!in_array($nama_triwulan, ['1', '2', '3', '4'])) {
        // Jika nama_triwulan tidak valid, simpan pesan error ke dalam session
        $_SESSION['message'] = "Nama triwulan tidak valid. Hanya triwulan 1, 2, 3, dan 4 yang diperbolehkan.";
        $_SESSION['msg_type'] = 'error';
    } else {
        // Query untuk update data triwulan
        $query = "UPDATE triwulan SET nama_triwulan='$nama_triwulan' , tahun_triwulan='$tahun_triwulan' WHERE id_triwulan='$id_triwulan'";

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
    }

    // Mengalihkan halaman kembali ke halaman triwulan.php
    header("location:../../view/triwulan/index.php");
    exit(); // Keluar dari script
}
?>
