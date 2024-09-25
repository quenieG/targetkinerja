<?php
// Memulai session
session_start();

// Melakukan koneksi ke database
include '../../includes/koneksi.php';

// Periksa apakah tombol proses sudah diklik
if (isset($_POST['proses'])) {
    // Ambil nilai-nilai yang dikirimkan melalui formulir
    $id_capaian = $_POST['id_capaian'];
    $id_triwulan = $_POST['id_triwulan'];
    $id_prodi = $_POST['id_prodi'];
    $id_iku = $_POST['id_iku'];
    $satuan = $_POST['satuan'];
    $data_pembagi = $_POST['data_pembagi'];
    $capaian_tw = $_POST['capaian_tw'];

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
        $_SESSION['message'] = "Hanya pengguna dengan prodi " . $nama_prodi . " yang dapat mengubah data";
        $_SESSION['msg_type'] = 'error';
        header("Location: ../../view/tw/index.php?id_triwulan=" . $id_triwulan . "&id_prodi=" . $id_prodi);
        exit;
    }

    // Lakukan query untuk memperbarui data triwulan
    $query = "UPDATE capaian SET id_iku = '$id_iku', satuan = '$satuan', data_pembagi = '$data_pembagi', capaian_tw = '$capaian_tw' 
    WHERE id_capaian = '$id_capaian'";
    // Lakukan query
    if (mysqli_query($koneksi, $query)) {
        echo "Data berhasil ditambahkan ke database";
        header("Location: ../../view/tw/index.php?id_triwulan=" . $id_triwulan . "&id_prodi=" . $id_prodi);
        exit(); // Selesai, keluar dari script
    } else {
        // Jika query gagal, tampilkan pesan error
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
} else {
    // Jika pengguna mencoba mengakses file ini secara langsung tanpa mengklik tombol proses, arahkan mereka ke halaman yang sesuai
    header("Location: ../../view/tw/index.php?id_triwulan=" . $id_tw . "&id_prodi=" . $id_prodi);
    exit; // Penting: pastikan untuk keluar setelah mengalihkan pengguna
}
