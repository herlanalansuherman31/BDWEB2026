<?php
//path ke koneksi database
include "../koneksi.php";

// Logika Hapus Data Mahasiswa jika tombol hapus diklik
if (isset($_GET['hapus'])) {
    $hapus_nim = mysqli_real_escape_string($conn, $_GET['hapus']);


// Hapus data mahasiswa dari tabel tbl_mhs berdasarkan nim (hilang dari database)
    $query_delete = "DELETE FROM tbl_mhs WHERE nim = '$hapus_nim'";
    mysqli_query($conn, $query_delete);
    header("Location: mahasiswa.php");
    

    echo "<script>alert('Data mahasiswa berhasil dihapus.'); window.location.href='mahasiswa.php';</script>";

    exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="mahasiswa.css">
    <link rel="stylesheet" href="../assets/navbar/navbar.css">
    <link rel="stylesheet" href="../assets/body/body.css">
    <script src="../assets/navbar/navbar.js"></script>


    
</head>


<body>

<!-- NAVIGATION BAR START -->
    <div class="navbar">
                <div class = "icon">
                    <img src="../home/image/logo.png" alt="logo">
                </div>
                
            <div class="menu">
                <ul>
                    <li><a href="../home/index.php">Home</a></li>
                    <li><a href="mahasiswa.php">Mahasiswa</a></li>
                    <li><a href="../matkul/matakuliah.php">Matkul</a></li>
                    <li><a href="../dosen/dopem.php">Dosen</a></li>
                    <li><a href="../anggota/anggota.php">Anggota</a></li>
                    <li><a href="../rekap/rekap.php">Rekap</a></li>
                    <li><a href="../logout.php">Logout</a></li>

                </ul>
            </div>

            <!-- NAVIGATION BAR END -->


            </div>
        <div class="crud-container">
            <div class="table-box">
                <h3>🎓 DATA <span style="color: #23c0e7;">MAHASISWA</span></h3>
                <a href="tambah_mahasiswa.php" class="btn-add-circle" title="Tambah Data Mahasiswa">+</a>
            </div>

            <div class="table-responsive">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th width="5%" style="text-align: center;">NO</th>
                            <th width="15%">NIM</th>
                            <th width="30%">Nama Mahasiswa</th>
                            <th width="25%">Phone</th>
                            <th width="10%" style="text-align: center;">⚙️ AKSI</th>
                        </tr>
                    </thead>
                    <tbody>

                        <!-- Memanggil data mahasiswa dari database dengan query SELECT -->

                        <?php
                        $query = "SELECT * FROM tbl_mhs ORDER BY nim ASC";  
                $result = mysqli_query($conn, $query);
                $no = 0;

                if (mysqli_num_rows($result) > 0) {
                    while ($data = mysqli_fetch_array($result)) {
                        $no++;
                        echo "<tr>";
                        echo "<td style='text-align: center;'>$no</td>";
                        echo "<td>" . htmlspecialchars($data['nim']) . "</td>";
                        echo "<td>". htmlspecialchars($data["namamhs"]) ."</td>";
                        echo "<td>" . htmlspecialchars($data['phone']) . "</td>";

                        // Tombol Edit dan Hapus dengan parameter nim untuk mengidentifikasi data yang akan diedit atau dihapus
                        echo "<td align='center'>
                                    <div class='action-icons'>
                                        <a href='edit_mahasiswa.php?nim=" . urlencode($data['nim']) . "' class='icon-btn edit' title='Edit'>✏️</a> 
                                        <a href='mahasiswa.php?hapus=" . urlencode($data['nim']) . "' class='icon-btn delete' title='Hapus' onclick='return confirm(\"Hapus mahasiswa ini secara permanen?\")'>🗑</a>
                                    </div>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4' align='center'>Data mahasiswa kosong.</td></tr>";
                    }
                    mysqli_close($conn);
                    ?>
                    </tbody>
                </table>

            </div>
        </div>


</body>
</html>