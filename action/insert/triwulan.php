<?php
// Memulai session
session_start();

// Melakukan koneksi ke database
include '../../includes/koneksi.php';

// Cek apakah pengguna adalah admin
if ($_SESSION['role'] !== 'admin') {
    $_SESSION['message'] = "Hanya admin yang dapat menambahkan data";
    $_SESSION['msg_type'] = 'error';
    header("location:../../view/triwulan/index.php");
    exit;
}

// Cek apakah tombol proses telah ditekan
if (isset($_POST['proses'])) {
    $nama_triwulan = $_POST['nama_triwulan'];
    $tahun_triwulan = $_POST['tahun_triwulan'];

    // Validasi nama triwulan
    $valid_triwulan = ['Triwulan 1', 'Triwulan 2', 'Triwulan 3', 'Triwulan 4'];
    if (!in_array($nama_triwulan, $valid_triwulan)) {
        $_SESSION['message'] = "Nama triwulan tidak valid. Hanya Triwulan 1 hingga Triwulan 4 yang diperbolehkan.";
        $_SESSION['msg_type'] = 'error';
    } else {
        // Query untuk menghitung jumlah triwulan yang sudah ada dalam tahun yang sama
        $query_count = "SELECT COUNT(*) AS total FROM triwulan WHERE tahun_triwulan = '$tahun_triwulan'";
        $result = mysqli_query($koneksi, $query_count);
        $row = mysqli_fetch_assoc($result);
        $total_triwulan = $row['total'];

        if ($total_triwulan >= 4) {
            // Jika sudah ada 4 triwulan dalam tahun yang sama, simpan pesan error ke dalam session
            $_SESSION['message'] = "Tidak dapat menambahkan lebih dari 4 triwulan dalam tahun yang sama";
            $_SESSION['msg_type'] = 'error';
        } else {
            // Query untuk memasukkan data ke dalam tabel triwulan
            $query_insert = "INSERT INTO triwulan (nama_triwulan, tahun_triwulan) VALUES ('$nama_triwulan','$tahun_triwulan')";
            if (mysqli_query($koneksi, $query_insert)) {
                // Jika query berhasil, simpan pesan sukses ke dalam session
                $_SESSION['message'] = "Data berhasil ditambahkan ke database";
                $_SESSION['msg_type'] = 'success';
            } else {
                // Jika query gagal, simpan pesan error dan detail error ke dalam session
                $_SESSION['message'] = "Error: " . $query_insert . "<br>" . mysqli_error($koneksi);
                $_SESSION['msg_type'] = 'error';
            }
        }
    }
    // Mengalihkan halaman kembali ke halaman triwulan.php
    header("location:../../view/triwulan/index.php");
}
?>
