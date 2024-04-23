<?php
        include "../koneksi.php";
        if (isset($_POST['proses'])) {
        $nama_triwulan = $_POST['nama_triwulan'];
                            
        $query = "INSERT INTO triwulan (nama_triwulan) VALUES ('$nama_triwulan')";
        if (mysqli_query($koneksi, $query)) {
        echo "Data berhasil ditambahkan ke database";
        } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
        }
        header("location:triwulan.php");
    }
      
?>