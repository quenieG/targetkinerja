<?php
include "koneksi.php";

if (isset($_POST['proses'])) {
    $id_tw = $_POST['id_tw'];
    $id_iku = $_POST['indikator'];
    $satuan = $_POST['satuan'];
    $target_renaksi_tw = $_POST['target_renaksi_tw'];
    $capaian_tw = $_POST['capaian_tw'];
    echo var_dump($id_tw);
    
    // Query untuk memasukkan data ke dalam tabel capaian
    $query = "INSERT INTO capaian (id_triwulan, id_iku, satuan, target_renaksi_tw, capaian_tw) VALUES ('$id_tw', '$id_iku', '$satuan', '$target_renaksi_tw', '$capaian_tw')";
    
    // Lakukan query
    if (mysqli_query($koneksi, $query)) {
        echo "Data berhasil ditambahkan ke database";
        header("Location: tw.php?id_triwulan=" . $id_tw);
        exit(); // Selesai, keluar dari script
    } else {
        // Jika query gagal, tampilkan pesan error
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
}
?>
