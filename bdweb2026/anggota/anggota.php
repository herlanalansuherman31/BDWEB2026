<?php
// Path koneksi database
include "../koneksi.php";

// Logika Hapus Data Anggota
if (isset($_GET['hapus'])) {

    $hapus_nim = mysqli_real_escape_string(
        $conn,
        $_GET['hapus']
    );

    $query_delete =
    "DELETE FROM tbl_anggota
    WHERE nim='$hapus_nim'";

    mysqli_query(
        $conn,
        $query_delete
    );

    echo "
    <script>

    alert('Data anggota berhasil dihapus.');

    window.location.href='anggota.php';

    </script>";

    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Data Anggota</title>

<link rel="stylesheet" href="anggota.css">
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

            <li><a href="../rekap/rekap.php">Rekap</a></li>

            <li><a href="../logout.php">Logout</a></li>

        </ul>

    </div>

</div>

<!-- NAVBAR END -->


<div class="crud-container">

    <div class="table-box">

        <h3>
            👥 DATA
            <span style="color:#23c0e7;">
                ANGGOTA
            </span>
        </h3>

        <a href="tambah_anggota.php"
           class="btn-add-circle"
           title="Tambah Data Anggota">

           +

        </a>

    </div>

    <div class="table-responsive">

        <table class="modern-table">

            <thead>

                <tr>

                    <th width="10%">
                        NO
                    </th>

                    <th width="30%">
                        NIM
                    </th>

                    <th width="40%">
                        Nama Anggota
                    </th>

                    <th width="20%">
                        ⚙️ AKSI
                    </th>

                </tr>

            </thead>

            <tbody>

                <?php

                $query =
                "SELECT * FROM tbl_anggota
                ORDER BY nim ASC";

                $result =
                mysqli_query(
                    $conn,
                    $query
                );

                $no = 0;

                if (
                    mysqli_num_rows($result) > 0
                ) {

                    while(
                        $data =
                        mysqli_fetch_assoc($result)
                    ){

                        $no++;

                        echo "<tr>";

                        echo "<td>$no</td>";

                        echo "<td>"
                        . htmlspecialchars(
                            $data['nim']
                        )
                        . "</td>";

                        echo "<td>"
                        . htmlspecialchars(
                            $data['nama']
                        )
                        . "</td>";

                        echo "

                        <td>

                        <div class='action-icons'>

                        <a
                        href='edit_anggota.php?nim="
                        . urlencode($data['nim']) .
                        "'

                        class='icon-btn edit'

                        title='Edit'>

                        ✏️

                        </a>

                        <a
                        href='anggota.php?hapus="
                        . urlencode($data['nim']) .
                        "'

                        class='icon-btn delete'

                        title='Hapus'

                        onclick='return confirm(\"Hapus anggota ini secara permanen?\")'>

                        🗑️

                        </a>

                        </div>

                        </td>

                        ";

                        echo "</tr>";
                    }

                } else {

                    echo "

                    <tr>

                    <td colspan='4' align='center'>

                    Data anggota kosong.

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