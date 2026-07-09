<?php
include "../koneksi.php";

/* =========================================
   AMBIL DATA YANG AKAN DIEDIT
========================================= */

if (isset($_GET['nim']) && isset($_GET['nid'])) {

    $old_nim = mysqli_real_escape_string(
        $conn,
        $_GET['nim']
    );

    $old_nid = mysqli_real_escape_string(
        $conn,
        $_GET['nid']
    );

    $query =
    "SELECT *
     FROM tbl_dopem
     WHERE nim='$old_nim'
     AND nid='$old_nid'";

    $result = mysqli_query($conn, $query);

    $dataEdit = mysqli_fetch_assoc($result);

    if (!$dataEdit) {

        header("Location: dopem.php");
        exit();
    }

} else {

    header("Location: dopem.php");
    exit();
}

/* =========================================
   PROSES UPDATE
========================================= */

if (isset($_POST['update'])) {

    $nim_baru =
    mysqli_real_escape_string(
        $conn,
        $_POST['nim']
    );

    $nid_baru =
    mysqli_real_escape_string(
        $conn,
        $_POST['nid']
    );

    $update =
    "UPDATE tbl_dopem
     SET
        nim='$nim_baru',
        nid='$nid_baru'
     WHERE
        nim='$old_nim'
     AND
        nid='$old_nid'";

    mysqli_query($conn, $update);

    echo "
    <script>
        alert('Data dosen pembimbing berhasil diperbarui');
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

    <title>Edit Dosen Pembimbing</title>

    <link rel="stylesheet" href="edit_dopem.css">

    <link rel="stylesheet"
          href="../assets/navbar/navbar.css">

    <link rel="stylesheet"
          href="../assets/body/body.css">

    <script src="../assets/navbar/navbar.js"></script>

</head>

<body>

<!-- NAVBAR -->

<div class="navbar">

    <div class="icon">
        <img src="../home/image/logo.png"
             alt="logo">
    </div>

    <div class="menu">
        <ul>

            <li>
                <a href="../home/index.php">
                    Home
                </a>
            </li>

            <li>
                <a href="../mahasiswa/mahasiswa.php">
                    Mahasiswa
                </a>
            </li>

            <li>
                <a href="../matkul/matakuliah.php">
                    Matkul
                </a>
            </li>

            <li>
                <a href="dopem.php">
                    Dosen
                </a>
            </li>

            <li>
                <a href="../anggota/anggota.php">
                    Anggota
                </a>
            </li>

            <li>
                <a href="../logout.php">
                    Logout
                </a>
            </li>

        </ul>
    </div>

</div>

<!-- FORM -->

<div class="crud-container">

    <div class="form-box">

        <span class="tagline">
            DOSEN PEMBIMBING MANAGEMENT
        </span>

        <h2>
            Edit Data <span>Dopem</span>
        </h2>

        <p class="desc">
            Ubah hubungan antara mahasiswa
            dan dosen pembimbing yang telah
            tersimpan di database.
        </p>

        <form method="POST">

            <!-- MAHASISWA -->

            <div class="input-group">

                <label>
                    Mahasiswa
                </label>

                <select name="nim" required>

                    <?php

                    $mhs =
                    mysqli_query(
                        $conn,
                        "SELECT *
                         FROM tbl_mhs
                         ORDER BY namamhs ASC"
                    );

                    while (
                        $row =
                        mysqli_fetch_assoc($mhs)
                    ) {

                        $selected =
                        ($row['nim']
                        == $dataEdit['nim'])
                        ? "selected"
                        : "";

                        echo "
                        <option
                        value='{$row['nim']}'
                        $selected>

                        {$row['nim']} -
                        {$row['namamhs']}

                        </option>";
                    }

                    ?>

                </select>

            </div>

            <!-- DOSEN -->

            <div class="input-group">

                <label>
                    Dosen Pembimbing
                </label>

                <select name="nid" required>

                    <?php

                    $dosen =
                    mysqli_query(
                        $conn,
                        "SELECT *
                         FROM tbl_dosen
                         ORDER BY namados ASC"
                    );

                    while (
                        $row =
                        mysqli_fetch_assoc($dosen)
                    ) {

                        $selected =
                        ($row['nid']
                        == $dataEdit['nid'])
                        ? "selected"
                        : "";

                        echo "
                        <option
                        value='{$row['nid']}'
                        $selected>

                        {$row['nid']} -
                        {$row['namados']}

                        </option>";
                    }

                    ?>

                </select>

            </div>

            <!-- BUTTON -->

            <div class="button-group">

                <a href="dopem.php"
                   class="btn-back">

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