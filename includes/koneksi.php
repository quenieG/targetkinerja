<?php
// Menentukan nama server
$servername = "localhost";

// Menentukan username untuk login ke database
$username = "root";

// Menentukan password untuk login ke database
$password = "";

// Menentukan nama database yang akan digunakan
$dbname = "target_kinerja";

// Membuat koneksi ke database
$koneksi = new mysqli($servername, $username, $password, $dbname);

// Memeriksa apakah koneksi berhasil
if ($koneksi->connect_error) {
  // Jika koneksi gagal, tampilkan pesan error dan hentikan eksekusi script
  die("Koneksi gagal: " . $koneksi->connect_error);
}
?>