<?php
        include "../koneksi.php";
        if (isset($_POST['proses'])) {
        $nama_prodi = $_POST['nama_prodi'];
        $id_jurusan = $_POST['id_jurusan'];
                            
        $query = "INSERT INTO prodi (nama_prodi, id_jurusan) VALUES ('$nama_prodi', '$id_jurusan')";
        echo var_dump($query);
        if (mysqli_query($koneksi, $query)) {
        echo "Data berhasil ditambahkan ke database";
        } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
        }
        header("location:prodi.php");
    }
      
?>
