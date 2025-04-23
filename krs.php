<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mahasiswa_npm = $_POST['mahasiswa_npm'];
    $matakuliah_kodemk = $_POST['matakuliah_kodemk'];

    if (!empty($mahasiswa_npm) && !empty($matakuliah_kodemk)) {
        $query = "INSERT INTO krs (mahasiswa_npm, matakuliah_kodemk) VALUES ('$mahasiswa_npm', '$matakuliah_kodemk')";
        mysqli_query($koneksi, $query);
    }
}

$query_krs = "
    SELECT 
        mahasiswa.nama AS nama_mahasiswa, 
        matakuliah.nama AS nama_matakuliah, 
        matakuliah.jumlah_sks 
    FROM krs
    INNER JOIN mahasiswa ON krs.mahasiswa_npm = mahasiswa.npm
    INNER JOIN matakuliah ON krs.matakuliah_kodemk = matakuliah.kodemk";
$result_krs = mysqli_query($koneksi, $query_krs);

$query_mahasiswa = "SELECT * FROM mahasiswa";
$result_mahasiswa = mysqli_query($koneksi, $query_mahasiswa);

$query_matakuliah = "SELECT * FROM matakuliah";
$result_matakuliah = mysqli_query($koneksi, $query_matakuliah);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data KRS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-4">
        <h2 class="text-center">Data KRS</h2>

        <form action="" method="POST">
            <label>Nama Mahasiswa:</label>
            <select name="mahasiswa_npm" required>
                <option value="">-- Pilih Mahasiswa --</option>
                <?php while ($mahasiswa = mysqli_fetch_assoc($result_mahasiswa)) { ?>
                    <option value="<?php echo $mahasiswa['npm']; ?>"><?php echo $mahasiswa['nama']; ?></option>
                <?php } ?>
            </select>
            <label>Mata Kuliah:</label>
            <select name="matakuliah_kodemk" required>
                <option value="">-- Pilih Mata Kuliah --</option>
                <?php while ($matakuliah = mysqli_fetch_assoc($result_matakuliah)) { ?>
                    <option value="<?php echo $matakuliah['kodemk']; ?>"><?php echo $matakuliah['nama']; ?></option>
                <?php } ?>
            </select>
            <button type="submit">Tambah</button>
        </form>

        <table class="table table-bordered text-center mt-4">
            <thead class="table-dark">
                <tr>
                    <th>Nama Mahasiswa</th>
                    <th>Mata Kuliah</th>
                    <th>Jumlah SKS</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result_krs)) { ?>
                    <tr>
                        <td><?php echo $row['nama_mahasiswa']; ?></td>
                        <td><?php echo $row['nama_matakuliah']; ?></td>
                        <td><?php echo $row['jumlah_sks']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>