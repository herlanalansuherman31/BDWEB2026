<?php
include "../koneksi.php";

/* =====================================
   HAPUS DATA DOPEM
===================================== */

if(isset($_GET['hapus_nim']) && isset($_GET['hapus_nid'])){

    $nim = mysqli_real_escape_string($conn,$_GET['hapus_nim']);
    $nid = mysqli_real_escape_string($conn,$_GET['hapus_nid']);

    $hapus = "
    DELETE FROM tbl_dopem
    WHERE nim='$nim'
    AND nid='$nid'
    ";

    mysqli_query($conn,$hapus);

    echo "
    <script>
        alert('Data bimbingan berhasil dihapus');
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Dosen Pembimbing</title>

    <link rel="stylesheet" href="dopem.css">

    <link rel="stylesheet"
          href="../assets/navbar/navbar.css">

    <link rel="stylesheet"
          href="../assets/body/body.css">

    <script src="../assets/navbar/navbar.js"></script>

</head>
<body>

<!-- =========================
     NAVBAR
========================= -->

<div class="navbar">

    <div class="icon">
        <img src="../home/image/logo.png" alt="logo">
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
                <a href="../rekap/rekap.php">
                    Rekap
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

<!-- =========================
     CONTENT
========================= -->

<div class="crud-container">

    <div class="table-box">

        <h3>
            👨‍🏫 DATA
            <span style="color:#23c0e7;">
                DOSEN PEMBIMBING
            </span>
        </h3>

        <a href="tambah_dopem.php"
           class="btn-add-circle"
           title="Tambah Data">

           +

        </a>

    </div>

    <div class="table-responsive">

        <table class="modern-table">

            <thead>

                <tr>

                    <th width="5%">
                        NO
                    </th>

                    <th width="15%">
                        NIM
                    </th>

                    <th width="30%">
                        Nama Mahasiswa
                    </th>

                    <th width="15%">
                        NID
                    </th>

                    <th width="25%">
                        Nama Dosen
                    </th>

                    <th width="10%">
                       ⚙️ AKSI
                    </th>

                </tr>

            </thead>

            <tbody>

            <?php

            $query = "

            SELECT

                a.nim,
                b.namamhs,
                a.nid,
                c.namados

            FROM tbl_dopem a

            JOIN tbl_mhs b
            ON a.nim = b.nim

            JOIN tbl_dosen c
            ON c.nid = a.nid

            ORDER BY b.namamhs ASC

            ";

            $result = mysqli_query($conn,$query);

            $no = 1;

            if(mysqli_num_rows($result) > 0){

                while($data =
                mysqli_fetch_assoc($result)){

            ?>

                <tr>

                    <td align="center">
                        <?= $no++; ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($data['nim']); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($data['namamhs']); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($data['nid']); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($data['namados']); ?>
                    </td>

                    <td align="center">

                        <div class="action-icons">

                            <a href="edit_dopem.php?nim=<?= urlencode($data['nim']); ?>&nid=<?= urlencode($data['nid']); ?>"
                               class="icon-btn edit"
                               title="Edit">

                               📝

                            </a>

                            <a href="dopem.php?hapus_nim=<?= urlencode($data['nim']); ?>&hapus_nid=<?= urlencode($data['nid']); ?>"
                               class="icon-btn delete"
                               title="Hapus"
                               onclick="return confirm('Hapus data bimbingan ini?')">

                               🗑

                            </a>

                        </div>

                    </td>

                </tr>

            <?php

                }

            }else{

                echo "

                <tr>

                    <td colspan='6'
                        align='center'>

                        Data dosen pembimbing masih kosong.

                    </td>

                </tr>

                ";

            }

            mysqli_close($conn);

            ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>