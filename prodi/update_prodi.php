<?php
include '../koneksi.php'; // Sertakan file koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirim dari form
    $id_prodi = $_POST['id_prodi'];
    $nama_prodi = $_POST['nama_prodi'];

    // Query untuk update data jurusan
    $query = "UPDATE prodi SET nama_prodi='$nama_prodi' WHERE id_prodi='$id_prodi'";

    // Jalankan query untuk mengupdate data
    if (mysqli_query($koneksi, $query)) {
        // Jika berhasil diupdate, arahkan kembali ke halaman utama dengan pesan sukses
        header("location: prodi.php");
        exit(); // Keluar dari script
    } 
}
?>
