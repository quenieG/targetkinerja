<?php
include '../koneksi.php'; // Sertakan file koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirim dari form
    $id_jurusan = $_POST['id_jurusan'];
    $nama_jurusan = $_POST['nama_jurusan'];

    // Query untuk update data jurusan
    $query = "UPDATE jurusan SET nama_jurusan='$nama_jurusan' WHERE id_jurusan='$id_jurusan'";

    // Jalankan query untuk mengupdate data
    if (mysqli_query($koneksi, $query)) {
        // Jika berhasil diupdate, arahkan kembali ke halaman utama dengan pesan sukses
        header("location: jurusan.php");
        exit(); // Keluar dari script
    } 
}
?>
