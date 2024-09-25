<?php
// Memasukkan file header.php
include '../../includes/header.php';
// Melakukan koneksi ke database
include '../../includes/koneksi.php';
?>

<!-- Form untuk memfilter data berdasarkan indikator dan tahun -->
<form action="index.php" method="get">
    <div class="container-fluid">
        <!-- Tabel untuk menampilkan data -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Kelola User</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <!-- Form dan tabel -->
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead class="bg-primary text-center text-white">
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Jurusan</th>
                                <th>Prodi</th>
                                <th>Verifikasi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            // Jika filter telah diterapkan, tampilkan data berdasarkan filter
                                // Query untuk mengambil data
                                $query = "SELECT *
                                          FROM user
                                          LEFT JOIN prodi ON prodi.id_prodi = user.id_prodi
                                          LEFT JOIN jurusan ON jurusan.id_jurusan = user.id_jurusan";
                                $result = mysqli_query($koneksi, $query);
                                $no = 1;

                                // Menampilkan data ke dalam tabel
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $no++ . "</td>";
                                    echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['role']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['nama_jurusan']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['nama_prodi']) . "</td>";
                                    $isVerified = $row['verified_at'] ? "Terverifikasi" : "Belum Diverifikasi";
                                    echo "<td>" . htmlspecialchars($isVerified) . "</td>";

                                    // Tombol Verifikasi dan Hapus
                                    echo "<td>";
                                    if (!$row['verified_at']) {
                                        echo "<button onclick='verifikasiUser(" . htmlspecialchars($row['id']) . ")' class='btn btn-success btn-sm'>Verifikasi</button>";
                                    }

                                    echo "<a href='../../action/delete/admin.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus user ini?\")'>Hapus</a>";
                                    echo "</td>";

                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
function verifikasiUser(userId) {
    if (confirm("Apakah Anda yakin ingin memverifikasi user ini?")) {
        // Kirim permintaan AJAX ke server
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "verifikasi.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = function () {
            if (xhr.status === 200) {
                // Tampilkan respons dari server untuk debugging
                alert(xhr.responseText);
                // Jika berhasil, reload halaman untuk memperbarui status
                location.reload();
            } else {
                alert("Terjadi kesalahan saat memverifikasi user. Status: " + xhr.status);
            }
        };
        xhr.onerror = function () {
            alert("Terjadi kesalahan saat mengirim permintaan.");
        };
        xhr.send("id=" + encodeURIComponent(userId));
    }
}
</script>

<?php include '../../includes/footer.php'; ?>
