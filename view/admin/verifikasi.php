<?php
// Aktifkan error reporting untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Memasukkan file koneksi ke database
include '../../includes/koneksi.php';

// Mendapatkan ID dari parameter POST
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

// Memeriksa apakah ID valid
if ($id > 0) {
    // Query untuk memperbarui status verifikasi
    $query = "UPDATE user SET verified_at = NOW() WHERE id = $id";
    if (mysqli_query($koneksi, $query)) {
        echo "User berhasil diverifikasi.";
    } else {
        echo "Terjadi kesalahan: " . mysqli_error($koneksi);
    }
} else {
    echo "ID tidak valid.";
}

// Menutup koneksi
mysqli_close($koneksi);
?>
 