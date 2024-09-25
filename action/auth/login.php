<?php
// Memulai session
session_start();

// Memasukkan file koneksi.php untuk melakukan koneksi ke database
include '../../includes/koneksi.php';

// Memeriksa apakah form login telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data username dan password yang dikirimkan melalui form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Membuat pernyataan SQL untuk memeriksa keberadaan pengguna dengan username tertentu
    $query = "SELECT * FROM user WHERE username = ?";

    // Menyiapkan pernyataan SQL
    if ($stmt = $koneksi->prepare($query)) {
        // Menghubungkan parameter $username ke pernyataan SQL
        $stmt->bind_param("s", $username);

        // Menjalankan pernyataan SQL
        $stmt->execute();

        // Mendapatkan hasil query
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        // Memeriksa apakah pengguna ditemukan dan passwordnya benar
        if ($user && password_verify($password, $user['password'])) {
            // Periksa apakah pengguna sudah diverifikasi
            if ($user['verified_at'] !== NULL) {
                // Menyimpan pesan sukses ke dalam session
                $_SESSION['message'] = "Login berhasil!";
                $_SESSION['msg_type'] = "success";

                // Menyimpan username dan role ke dalam session
                $_SESSION['username'] = $user['username'];
                $_SESSION['id'] = $user['id'];
                $_SESSION['role'] = $user['role'];

                // Mengalihkan ke halaman beranda setelah login berhasil
                header("Location: ../../view/dashboard/dashboard.php");
                exit;
            } else {
                // Menyimpan pesan error ke dalam session
                $_SESSION['message'] = "Akun Anda belum diverifikasi oleh admin.";
                $_SESSION['msg_type'] = "error";

                // Mengalihkan ke halaman login jika akun belum diverifikasi
                header("Location: ../../view/auth/login.php");
                exit;
            }
        } else {
            // Menyimpan pesan error ke dalam session
            $_SESSION['message'] = "Username atau password salah";
            $_SESSION['msg_type'] = "error";

            // Mengalihkan ke halaman login jika login gagal
            header("Location: ../../view/auth/login.php");
            exit;
        }

        // Menutup pernyataan SQL
        $stmt->close();
    }
}

// Menutup koneksi database
$koneksi->close();
?>
