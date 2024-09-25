<?php
// Memulai session
session_start();

// Memasukkan file koneksi.php untuk melakukan koneksi ke database
include '../../includes/koneksi.php';

// Memeriksa apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form dan mencegah serangan SQL injection
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];
    $konfirmasi_password = $_POST['confirm_password'];
    
    // Field opsional (role, prodi, dan jurusan)
    $role = !empty($_POST['role']) ? $_POST['role'] : null;
    $prodi = !empty($_POST['prodi']) ? $_POST['prodi'] : null;
    $jurusan = !empty($_POST['jurusan']) ? $_POST['jurusan'] : null;

    // Validasi input
    // Memeriksa apakah field username, password, dan konfirmasi password telah diisi
    if (empty($username) || empty($password) || empty($konfirmasi_password)) {
        $_SESSION['message'] = 'Harap isi Username, Password, dan Konfirmasi Password!';
        $_SESSION['msg_type'] = 'error';
        header("Location: ../../view/auth/register.php");
        exit;
    }

    // Memeriksa apakah password dan konfirmasi password sama
    if ($password !== $konfirmasi_password) {
        $_SESSION['message'] = 'Password dan Konfirmasi Password harus sama!';
        $_SESSION['msg_type'] = 'error';
        header("Location: ../../view/auth/register.php");
        exit;
    }

    // Memeriksa apakah username sudah ada
    $check = $koneksi->query("SELECT * FROM user WHERE username = '$username'");
    if ($check->num_rows > 0) {
        $_SESSION['message'] = 'Username sudah ada!';
        $_SESSION['msg_type'] = 'error';
        header("Location: ../../view/auth/register.php");
        exit;
    }

    // Mengenkripsi password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Menyimpan data ke database
    // Menyiapkan pernyataan SQL
    $stmt = $koneksi->prepare("INSERT INTO user (username, password, role, id_jurusan, id_prodi) VALUES (?, ?, ?, ?, ?)");
    
    // Menghubungkan parameter ke pernyataan SQL
    // Perhatikan bahwa `role`, `jurusan`, dan `prodi` bisa bernilai `null`
    $stmt->bind_param("sssss", $username, $hashed_password, $role, $jurusan, $prodi);

    // Mengeksekusi pernyataan SQL
    if ($stmt->execute()) {
        // Jika berhasil, menyimpan pesan sukses ke dalam session dan mengalihkan ke halaman login.php
        $_SESSION['message'] = 'Pengguna berhasil dibuat, Silahkan Login !';
        $_SESSION['msg_type'] = 'success';
        header("Location: ../../view/auth/login.php");
        exit;
    } else {
        // Jika gagal, menyimpan pesan error ke dalam session dan mengalihkan kembali ke halaman register.php
        $_SESSION['message'] = $stmt->error;
        $_SESSION['msg_type'] = 'error';
        header("Location: ../../view/auth/register.php");
        exit;
    }

    // Menutup pernyataan SQL
    $stmt->close();
}

// Menutup koneksi ke database
$koneksi->close();
?>
