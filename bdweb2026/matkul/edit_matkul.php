<?php
session_start();

// Validasi login
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}

include "../koneksi.php";

// TAHAP 1: Mengambil data lama ke form berdasarkan kodemk dari URL
if (isset($_GET['kodemk'])) {
    $kodemkEdit = mysqli_real_escape_string($conn, $_GET['kodemk']);
    
    $ambil = "SELECT * FROM tbl_matakuliah WHERE kodemk='$kodemkEdit'";
    $hasil = mysqli_query($conn, $ambil);
    $dataEdit = mysqli_fetch_assoc($hasil);
    
    if (!$dataEdit) {
        header("Location: matakuliah.php");
        exit();
    }
}

// TAHAP 2: Memproses perubahan data ketika tombol 'update' diklik
if (isset($_POST['update'])) {
    $kodemk = mysqli_real_escape_string($conn, $_POST['kodemk']);
    $namamk = mysqli_real_escape_string($conn, $_POST['namamk']);
    $sks    = mysqli_real_escape_string($conn, $_POST['sks']);

    // Query UPDATE data berdasarkan kodemk
    $update = "UPDATE tbl_matakuliah SET namamk='$namamk', sks='$sks' WHERE kodemk='$kodemk'";
    mysqli_query($conn, $update);

    echo "
    <script>
        alert('Data mata kuliah berhasil diupdate');
        window.location='matakuliah.php';
    </script>
    ";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Mata Kuliah</title>
    <link rel="stylesheet" href="edit_matkul.css">
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
        <h2>Update Data <span>Mata Kuliah</span></h2>
        <p class="desc">Perbarui informasi mata kuliah yang telah tersimpan dalam database.</p>

        <form method="POST">
            <div class="input-group">
                <label>KODE MATA KULIAH</label>
                <input type="text" name="kodemk" value="<?php echo htmlspecialchars($dataEdit['kodemk']); ?>" readonly>
            </div>

            <div class="input-group">
                <label>NAMA MATA KULIAH</label>
                <input type="text" name="namamk" value="<?php echo htmlspecialchars($dataEdit['namamk']); ?>" required>
            </div>

            <div class="input-group">
                <label>SKS</label>
                <input type="number" name="sks" value="<?php echo htmlspecialchars($dataEdit['sks']); ?>" min="1" max="6" required>
            </div>

            <div class="button-group">
                <a href="matakuliah.php" class="btn-back">Kembali</a>
                <button type="submit" name="update" class="btn-save">Update Data</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>