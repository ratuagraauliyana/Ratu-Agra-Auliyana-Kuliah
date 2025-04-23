<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $npm = $_POST['npm'];
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];
    $alamat = $_POST['alamat'];

    if (!empty($npm) && !empty($nama) && !empty($jurusan) && !empty($alamat)) {
        $query = "INSERT INTO mahasiswa (npm, nama, jurusan, alamat) VALUES ('$npm', '$nama', '$jurusan', '$alamat')";
        mysqli_query($koneksi, $query);
    }
}

$query_mahasiswa = "SELECT * FROM mahasiswa";
$result_mahasiswa = mysqli_query($koneksi, $query_mahasiswa);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahasiswa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-4">
        <h2 class="text-center">Data Mahasiswa</h2>

        <form action="" method="POST">
            <label>NPM:</label>
            <input type="text" name="npm" required>
            <label>Nama:</label>
            <input type="text" name="nama" required>
            <label>Jurusan:</label>
            <select name="jurusan" required>
                <option value="Teknik Informatika">Teknik Informatika</option>
                <option value="Sistem Operasi">Sistem Operasi</option>
            </select>
            <label>Alamat:</label>
            <textarea name="alamat" required></textarea>
            <button type="submit">Tambah</button>
        </form>

        <table class="table table-bordered text-center mt-4">
            <thead class="table-dark">
                <tr>
                    <th>NPM</th>
                    <th>Nama</th>
                    <th>Jurusan</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result_mahasiswa)) { ?>
                    <tr>
                        <td><?php echo $row['npm']; ?></td>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['jurusan']; ?></td>
                        <td><?php echo $row['alamat']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>