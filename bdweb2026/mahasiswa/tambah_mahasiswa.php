<?php
include '../koneksi.php';

// Mengecek apakah user sudah menekan tombol button bermethod POST yang bernama 'simpan'
if (isset($_POST['simpan'])){

// Menangkap data dari form inputan dan mengamankannya dengan escape string
$nim = mysqli_real_escape_string($conn, $_POST['nim']);
$namamhs = mysqli_real_escape_string($conn, $_POST['namamhs']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);

// Perintah SQL dimasukkan sesuai urutan kolom database: nim, namamhs, phone
$query_insert = "INSERT INTO tbl_mhs VALUES ('$nim', '$namamhs', '$phone')";

// Menjalankan query ke database
mysqli_query($conn, $query_insert) or die(mysqli_error($conn));

// Memunculkan pesan sukses lalu otomatis memindahkan user kembali ke halaman utama mahasiswa.php
echo "
<script>
    alert('Data mahasiswa berhasil disimpan.'); 
    window.location.href='mahasiswa.php';
    </script>";

    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mahasiswa</title>
    <link rel="stylesheet" href="tambah_mahasiswa.css">
    <link rel="stylesheet" href="tambah_mahasiswa.css">
    <link rel="stylesheet" href="../assets/navbar/navbar.css">
    <link rel="stylesheet" href="../assets/body/body.css">
    <script src="../assets/navbar/navbar.js"></script>


    
</head>
<body>
    
<body>

<div class="navbar">

    <div class="icon">
        <img src="../home/image/logo.png" alt="logo">
    </div>

    <div class="menu">
        <ul>
            <li><a href="../home/index.php">Home</a></li>
            <li><a href="../mahasiswa/mahasiswa.php">Mahasiswa</a></li>
            <li><a href="../matkul/matakuliah.php">Matkul</a></li>
            <li><a href="../dosen/dopem.php">Dosen</a></li>
            <li><a href="../anggota/anggota.php">Anggota</a></li>
            <li><a href="../logout.php">Logout</a></li>

        </ul>
    </div>

</div>

<div class="crud-container">

    <div class="form-box">

        <span class="tagline">
            STUDENT MANAGEMENT
        </span>

        <h2>Tambah Data <span>Mahasiswa</span></h2>

        <p class="desc">
            Masukkan data mahasiswa baru ke dalam sistem database akademik.
        </p>

        <form method="POST">

            <div class="input-group">
                <label>NIM</label>
                <input type="text"
                       name="nim"
                       placeholder="Masukkan NIM"
                       required>
            </div>

            <div class="input-group">
                <label>Nama Mahasiswa</label>
                <input type="text"
                       name="namamhs"
                       placeholder="Masukkan Nama Mahasiswa"
                       required>
            </div>

            <div class="input-group">
                <label>No. HP</label>
                <input type="text"
                       name="phone"
                       placeholder="Masukkan Nomor HP"
                       required>
            </div>

            <div class="button-group">

                <a href="mahasiswa.php" class="btn-back">
                    Kembali
                </a>

                <button type="submit"
                        name="simpan"
                        class="btn-save">

                    Simpan Data
                </button>

            </div>

        </form>

    </div>

</div>

</body>
</html>