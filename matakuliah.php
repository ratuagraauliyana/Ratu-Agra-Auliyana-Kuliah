<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kodemk = $_POST['kodemk'];
    $nama = $_POST['nama'];
    $jumlah_sks = $_POST['jumlah_sks'];

    if (!empty($kodemk) && !empty($nama) && !empty($jumlah_sks)) {
        $query = "INSERT INTO matakuliah (kodemk, nama, jumlah_sks) VALUES ('$kodemk', '$nama', '$jumlah_sks')";
        mysqli_query($koneksi, $query);
    }
}

$query_matakuliah = "SELECT * FROM matakuliah";
$result_matakuliah = mysqli_query($koneksi, $query_matakuliah);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mata Kuliah</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-4">
        <h2 class="text-center">Data Mata Kuliah</h2>

        <form action="" method="POST">
            <label>Kode Mata Kuliah:</label>
            <input type="text" name="kodemk" required>
            <label>Nama Mata Kuliah:</label>
            <input type="text" name="nama" required>
            <label>Jumlah SKS:</label>
            <input type="number" name="jumlah_sks" required>
            <button type="submit">Tambah</button>
        </form>

        <table class="table table-bordered text-center mt-4">
            <thead class="table-dark">
                <tr>
                    <th>Kode Mata Kuliah</th>
                    <th>Nama</th>
                    <th>Jumlah SKS</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result_matakuliah)) { ?>
                    <tr>
                        <td><?php echo $row['kodemk']; ?></td>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['jumlah_sks']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>