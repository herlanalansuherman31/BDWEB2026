<?php
session_start();

// Validasi login
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}

// Path ke koneksi database
include "../koneksi.php";

// Logika Hapus Data Mata Kuliah jika tombol hapus diklik
if (isset($_GET['hapus'])) {
    $hapus_kodemk = mysqli_real_escape_string($conn, $_GET['hapus']);

    // Hapus data berdasarkan kodemk
    $query_delete = "DELETE FROM tbl_matakuliah WHERE kodemk = '$hapus_kodemk'";
    mysqli_query($conn, $query_delete);

    echo "<script>alert('Data mata kuliah berhasil dihapus.'); window.location.href='matakuliah.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mata Kuliah</title>
    <link rel="stylesheet" href="matakuliah.css">
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
                <li><a href="../rekap/rekap.php">Rekap</a></li>
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
    <div class="crud-container">
        <div class="table-box">
            <h3>📚 DATA <span style="color: #23c0e7;">MATA KULIAH</span></h3>
            <a href="tambah_matkul.php" class="btn-add-circle" title="Tambah Data Mata Kuliah">+</a>
        </div>

        <div class="table-responsive">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th width="5%" style="text-align: center;">NO</th>
                        <th width="20%">Kode MK</th>
                        <th width="45%">Nama Mata Kuliah</th>
                        <th width="15%">SKS</th>
                        <th width="15%" style="text-align: center;">⚙️ AKSI</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $query = "SELECT * FROM tbl_matakuliah ORDER BY kodemk ASC"; 
                    $result = mysqli_query($conn, $query);
                    $no = 0;

                    if (mysqli_num_rows($result) > 0) {
                        while ($data = mysqli_fetch_array($result)) {
                            $no++;
                            echo "<tr>";
                            echo "<td style='text-align: center;'>$no</td>";
                            echo "<td>" . htmlspecialchars($data['kodemk']) . "</td>";
                            echo "<td>" . htmlspecialchars($data['namamk']) . "</td>";
                            echo "<td>" . htmlspecialchars($data['sks']) . "</td>";

                            // Mengarahkan aksi edit ke update_matkul.php dan hapus ke file ini sendiri
                            echo "<td align='center'>
                                    <div class='action-icons'>
                                        <a href='edit_matkul.php?kodemk=" . urlencode($data['kodemk']) . "' class='icon-btn edit' title='Edit'>✏️</a> 
                                        <a href='matakuliah.php?hapus=" . urlencode($data['kodemk']) . "' class='icon-btn delete' title='Hapus' onclick='return confirm(\"Hapus mata kuliah ini secara permanen?\")'>🗑</a>
                                    </div>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' align='center'>Data mata kuliah kosong.</td></tr>";
                    }
                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html> 