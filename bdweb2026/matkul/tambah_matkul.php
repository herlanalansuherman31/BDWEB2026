<?php
session_start();

// Validasi login
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}

include '../koneksi.php';

// Mengecek jika tombol 'simpan' diklik
if (isset($_POST['simpan'])){

    // Menangkap data inputan form
    $kodemk = mysqli_real_escape_string($conn, $_POST['kodemk']);
    $namamk = mysqli_real_escape_string($conn, $_POST['namamk']);
    $sks    = mysqli_real_escape_string($conn, $_POST['sks']);

    // Perintah SQL insert data
    $query_insert = "INSERT INTO tbl_matakuliah VALUES ('$kodemk', '$namamk', '$sks')";

    mysqli_query($conn, $query_insert) or die(mysqli_error($conn));

    echo "
    <script>
        alert('Data mata kuliah berhasil disimpan.'); 
        window.location.href='matakuliah.php';
    </script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mata Kuliah</title>
    <link rel="stylesheet" href="tambah_matkul.css">
    <link rel="stylesheet" href="../assets/navbar/navbar.css">
    <link rel="stylesheet" href="../assets/body/body.css">
    <script src="../assets/navbar/navbar.js"></script>
</head>
<body>

<div class="navbar">
    <div class="icon">
        <img src="../home/image/logo.png" alt="logo">
    </div>
    <div class="menu">
        <ul>
            <li><a href="../home/index.php">Home</a></li>
            <li><a href="../mahasiswa/mahasiswa.php">Mahasiswa</a></li>
            <li><a href="matakuliah.php">Matkul</a></li>
            <li><a href="../dosen/dopem.php">Dosen</a></li>
            <li><a href="../anggota/anggota.php">Anggota</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </div>
</div>

<div class="crud-container">
    <div class="form-box">
        <span class="tagline">COURSE MANAGEMENT</span>
        <h2>Tambah Data <span>Mata Kuliah</span></h2>
        <p class="desc">Masukkan data mata kuliah baru ke dalam sistem database akademik.</p>

        <form method="POST">
            <div class="input-group">
                <label>KODE MATA KULIAH</label>
                <input type="text" name="kodemk" placeholder="Masukkan Kode MK" required>
            </div>

            <div class="input-group">
                <label>NAMA MATA KULIAH</label>
                <input type="text" name="namamk" placeholder="Masukkan Nama Mata Kuliah" required>
            </div>

            <div class="input-group">
                <label>SKS</label>
                <input type="number" name="sks" placeholder="Masukkan Jumlah SKS" min="1" max="6" required>
            </div>

            <div class="button-group">
                <a href="matakuliah.php" class="btn-back">Kembali</a>
                <button type="submit" name="simpan" class="btn-save">Simpan Data</button>
            </div>
        </form>
    </div>
</div>

</body>
</html> 