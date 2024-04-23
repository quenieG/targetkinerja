<?php
// Periksa apakah tombol proses sudah diklik
if(isset($_POST['proses'])) {
    // Lakukan koneksi ke database
    include 'koneksi.php';

    // Ambil nilai-nilai yang dikirimkan melalui formulir
    $id_tw = $_POST['id_tw'];
    $indikator = $_POST['indikator'];
    $satuan = $_POST['satuan'];
    $target_renaksi_tw = $_POST['target_renaksi_tw'];
    $capaian_tw = $_POST['capaian_tw'];

    // Lakukan query untuk memperbarui data triwulan
    $query = "UPDATE nama_tabel SET indikator = '$indikator', satuan = '$satuan', target_renaksi_tw = '$target_renaksi_tw', capaian_tw = '$capaian_tw' WHERE id_tw = '$id_tw'";
    
} else {
    // Jika pengguna mencoba mengakses file ini secara langsung tanpa mengklik tombol proses, arahkan mereka ke halaman yang sesuai
    header("Location:tw.php?id_triwulan=<?php echo $id_tw;?>");
    exit; // Penting: pastikan untuk keluar setelah mengalihkan pengguna
}
?>
