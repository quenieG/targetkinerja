<?php
        include "../koneksi.php";
        if (isset($_POST['proses'])) {
        $sasaran = $_POST['sasaran'];
        $no_iku = $_POST['no_iku'];
        $indikator = $_POST['indikator'];
        $target_kinerja = $_POST['target_kinerja'];
                            
        $query = "INSERT INTO iku (sasaran, no_iku, indikator, target_kinerja) VALUES ('$sasaran', '$no_iku', '$indikator', '$target_kinerja')";
        if (mysqli_query($koneksi, $query)) {
        echo "Data berhasil ditambahkan ke database";
        } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
        }
        header("location:iku.php");
    }
      
?>