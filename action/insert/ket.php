<?php
// Memulai session
session_start();

// Melakukan koneksi ke database
include '../../includes/koneksi.php';

if (isset($_POST['proses'])) {
    $id_iku = $_POST['indikator'];
    $id_triwulan = $_POST['id_triwulan'];
    $id_prodi = $_POST['id_prodi'];
    $progres = $_POST['progres'];
    $kendala = $_POST['kendala'];
    $strategi = $_POST['strategi'];

    $id_user = $_GET['id_user'];

// mengambil nama prodi dari tabel prodi
$query = "SELECT id_prodi FROM prodi WHERE id_prodi = '$id_prodi'";
$queryNama = "SELECT nama_prodi FROM prodi WHERE id_prodi = '$id_prodi'";
$queryUser = "SELECT id_prodi FROM user WHERE id = '$id_user'";
$result = mysqli_query($koneksi, $query);
$resultNama = mysqli_query($koneksi, $queryNama);
$resultUser = mysqli_query($koneksi, $queryUser);
$row = mysqli_fetch_assoc($result);
$rowNama = mysqli_fetch_assoc($resultNama);
$rowUser = mysqli_fetch_assoc($resultUser);
$id_prodiRow = $row['id_prodi'];
$id_userRow = $row['id_prodi'];
$nama_prodi = $row['nama_prodi'];


if ($id_prodiRow !== $id_userRow) {
        $_SESSION['message'] = "Hanya pengguna dengan prodi " . $nama_prodi . " yang dapat menambah data";
        $_SESSION['msg_type'] = 'error';
        header("Location: ../../view/tw/index.php?id_triwulan=" . $id_triwulan . "&id_prodi=" . $id_prodi);
        exit;
    }

    // Memeriksa apakah nilai $_POST['id_prodi'] ada dan tidak kosong
    if (isset($_POST['id_prodi']) && !empty($_POST['id_prodi'])) {
        $id_prodi = $_POST['id_prodi'];
    } else {
        // Jika tidak ada atau kosong, berikan nilai default atau tindakan yang sesuai
        $id_prodi = ''; // Atau sesuaikan dengan kebutuhan Anda
    }

    // Query untuk memasukkan data ke dalam tabel keterangan
    $query = "INSERT INTO keterangan (id_iku, id_triwulan, id_prodi, progres, kendala, strategi) VALUES ('$id_iku','$id_triwulan', '$id_prodi', '$progres', '$kendala', '$strategi')";

    // Lakukan query
    if (mysqli_query($koneksi, $query)) {
        echo "Data berhasil ditambahkan ke database";
        header("Location: ../../view/tw/index.php?id_triwulan=" . $id_triwulan . "&id_prodi=" . $id_prodi);
        exit(); // Selesai, keluar dari script
    } else {
        // Jika query gagal, tampilkan pesan error
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
}
