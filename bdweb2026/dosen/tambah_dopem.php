<?php
include "../koneksi.php";

// PROSES SIMPAN DATA
if (isset($_POST['simpan'])) {

    $nim = mysqli_real_escape_string($conn, $_POST['nim']);
    $nid = mysqli_real_escape_string($conn, $_POST['nid']);

    // CEK APAKAH MAHASISWA SUDAH PUNYA DOSEN PEMBIMBING
    $cek = mysqli_query(
        $conn,
        "SELECT * FROM tbl_dopem WHERE nim='$nim'"
    );

    if (mysqli_num_rows($cek) > 0) {

        echo "
        <script>
            alert('Mahasiswa ini sudah memiliki dosen pembimbing!');
            window.location='tambah_dopem.php';
        </script>
        ";

        exit();
    }

    // SIMPAN DATA
    $query_insert =
    "INSERT INTO tbl_dopem (nim,nid)
     VALUES ('$nim','$nid')";

    mysqli_query($conn, $query_insert)
    or die(mysqli_error($conn));

    echo "
    <script>
        alert('Data dosen pembimbing berhasil ditambahkan.');
        window.location='dopem.php';
    </script>
    ";

    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Tambah Dosen Pembimbing</title>

    <link rel="stylesheet" href="tambah_dopem.css">
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
            <li><a href="dopem.php">Dosen</a></li>
            <li><a href="../anggota/anggota.php">Anggota</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </div>

</div>

<!-- FORM -->

<div class="crud-container">

    <div class="form-box">

        <span class="tagline">
            DOSEN PEMBIMBING MANAGEMENT
        </span>

        <h2>Tambah Data <span>Dopem</span></h2>

        <p class="desc">
            Hubungkan mahasiswa dengan dosen pembimbing
            yang tersedia dalam sistem akademik.
        </p>

        <form method="POST">

            <!-- MAHASISWA -->

            <div class="input-group">

                <label>Pilih Mahasiswa</label>

                <select name="nim" required>

                    <option value="">
                        -- Pilih Mahasiswa --
                    </option>

                    <?php

                    $mhs =
                    mysqli_query(
                        $conn,
                        "SELECT * FROM tbl_mhs
                         ORDER BY namamhs ASC"
                    );

                    while($data =
                          mysqli_fetch_assoc($mhs)){

                    ?>

                    <option
                        value="<?php echo $data['nim']; ?>">

                        <?php
                        echo $data['nim'];
                        echo " - ";
                        echo $data['namamhs'];
                        ?>

                    </option>

                    <?php } ?>

                </select>

            </div>

            <!-- DOSEN -->

            <div class="input-group">

                <label>Pilih Dosen Pembimbing</label>

                <select name="nid" required>

                    <option value="">
                        -- Pilih Dosen --
                    </option>

                    <?php

                    $dosen =
                    mysqli_query(
                        $conn,
                        "SELECT * FROM tbl_dosen
                         ORDER BY namados ASC"
                    );

                    while($data =
                          mysqli_fetch_assoc($dosen)){

                    ?>

                    <option
                        value="<?php echo $data['nid']; ?>">

                        <?php
                        echo $data['nid'];
                        echo " - ";
                        echo $data['namados'];
                        ?>

                    </option>

                    <?php } ?>

                </select>

            </div>

            <div class="button-group">

                <a href="dopem.php"
                   class="btn-back">

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