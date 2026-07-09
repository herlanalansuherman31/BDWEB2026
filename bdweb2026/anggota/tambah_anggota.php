<?php
include '../koneksi.php';

// Mengecek apakah tombol simpan ditekan
if (isset($_POST['simpan'])) {

    // Mengamankan input
    $nim  = mysqli_real_escape_string($conn, $_POST['nim']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);

    // Query simpan data
    $query_insert = "INSERT INTO tbl_anggota (nim, nama)
                     VALUES ('$nim', '$nama')";

    mysqli_query($conn, $query_insert) or die(mysqli_error($conn));

    echo "
    <script>
        alert('Data anggota berhasil disimpan.');
        window.location.href='anggota.php';
    </script>
    ";

    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Anggota</title>

    <link rel="stylesheet" href="tambah_anggota.css">
    <link rel="stylesheet" href="../assets/navbar/navbar.css">
    <link rel="stylesheet" href="../assets/body/body.css">
    <script src="../assets/navbar/navbar.js"></script>

</head>
<body>

<!-- NAVBAR START -->

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
            <li><a href="anggota.php">Anggota</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </div>

</div>

<!-- NAVBAR END -->

<div class="crud-container">

    <div class="form-box">

        <span class="tagline">
            GROUP MEMBER MANAGEMENT
        </span>

        <h2>Tambah Data <span>Anggota</span></h2>

        <p class="desc">
            Tambahkan anggota kelompok baru ke dalam sistem database.
        </p>

        <form method="POST">

            <div class="input-group">
                <label>NIM</label>

                <input
                    type="text"
                    name="nim"
                    placeholder="Masukkan NIM"
                    required>
            </div>

            <div class="input-group">
                <label>Nama Anggota</label>

                <input
                    type="text"
                    name="nama"
                    placeholder="Masukkan Nama Anggota"
                    required>
            </div>

            <div class="button-group">

                <a href="anggota.php" class="btn-back">
                    Kembali
                </a>

                <button
                    type="submit"
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