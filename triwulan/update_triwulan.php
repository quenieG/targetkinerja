<?php
include '../koneksi.php'; // Sertakan file koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirim dari form
    $id_triwulan = $_POST['id_triwulan'];
    $nama_triwulan = $_POST['nama_triwulan'];

    // Query untuk update data jurusan
    $query = "UPDATE triwulan SET nama_triwulan='$nama_triwulan' WHERE id_triwulan='$id_triwulan'";

    // Jalankan query untuk mengupdate data
    if (mysqli_query($koneksi, $query)) {
        // Jika berhasil diupdate, arahkan kembali ke halaman utama dengan pesan sukses
        header("location: triwulan.php");
        exit(); // Keluar dari script
    } 
}
?>