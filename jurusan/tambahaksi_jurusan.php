<?php
        include "../koneksi.php";
        if (isset($_POST['proses'])) {
        $nama_jurusan = $_POST['nama_jurusan'];
                            
        $query = "INSERT INTO jurusan (nama_jurusan) VALUES ('$nama_jurusan')";
        if (mysqli_query($koneksi, $query)) {
        echo "Data berhasil ditambahkan ke database";
        } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
        }
        header("location:jurusan.php");
    }
      
?>