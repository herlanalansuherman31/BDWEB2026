<?php
include "../koneksi.php";

/* ==========================================
   AMBIL DATA BERDASARKAN NIM
========================================== */

if (isset($_GET['nim'])) {

    $nimEdit = mysqli_real_escape_string($conn, $_GET['nim']);

    $query = "SELECT * FROM tbl_anggota WHERE nim='$nimEdit'";
    $hasil = mysqli_query($conn, $query);

    $dataEdit = mysqli_fetch_assoc($hasil);

    if (!$dataEdit) {
        header("Location: anggota.php");
        exit();
    }
}

/* ==========================================
   PROSES UPDATE
========================================== */

if (isset($_POST['update'])) {

    $nim  = mysqli_real_escape_string($conn, $_POST['nim']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);

    $update = "
        UPDATE tbl_anggota
        SET nama='$nama'
        WHERE nim='$nim'
    ";

    mysqli_query($conn, $update);

    echo "
    <script>
        alert('Data anggota berhasil diupdate!');
        window.location='anggota.php';
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
    <title>Edit Anggota</title>

    <link rel="stylesheet" href="edit_anggota.css">
    <link rel="stylesheet" href="../assets/navbar/navbar.css">
    <link rel="stylesheet" href="../assets/body/body.css">

    <script src="../assets/navbar/navbar.js"></script>
</head>
<body>

<!-- NAVBAR -->

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

<!-- FORM -->

<div class="crud-container">

    <div class="form-box">

        <span class="tagline">
            GROUP MANAGEMENT
        </span>

        <h2>Update Data <span>Anggota</span></h2>

        <p class="desc">
            Perbarui informasi anggota kelompok yang telah tersimpan pada database.
        </p>

        <form method="POST">

            <div class="input-group">

                <label>NIM</label>

                <input
                    type="text"
                    name="nim"
                    value="<?php echo htmlspecialchars($dataEdit['nim']); ?>"
                    readonly>

            </div>

            <div class="input-group">

                <label>Nama Anggota</label>

                <input
                    type="text"
                    name="nama"
                    value="<?php echo htmlspecialchars($dataEdit['nama']); ?>"
                    required>

            </div>

            <div class="button-group">

                <a href="anggota.php" class="btn-back">
                    Kembali
                </a>

                <button
                    type="submit"
                    name="update"
                    class="btn-save">

                    Update Data

                </button>

            </div>

        </form>

    </div>

</div>

</body>
</html>