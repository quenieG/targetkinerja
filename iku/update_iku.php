<?php
include '../koneksi.php'; // Sertakan file koneksi ke database

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
        // Jika berhasil diupdate, arahkan kembali ke halaman utama dengan pesan sukses
        header("location: iku.php?pesan=update_sukses");
        exit(); // Keluar dari script
    } 
}
?>
