<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}

include "../koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Data</title>
    <link rel="stylesheet" href="rekap.css">
    <link rel="stylesheet" href="../assets/navbar/navbar.css">
    <link rel="stylesheet" href="../assets/body/body.css">
    <script src="../assets/navbar/navbar.js"></script>
</head>

<body>
    <!-- NAVIGATION BAR START -->
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
                <li><a href="rekap.php" class="active">Rekap</a></li>
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
    <!-- NAVIGATION BAR END -->

    <div class="rekap-container">
        <div class="table-box">
            <h3>📊 REKAP <span style="color: #23c0e7;">DATA AKADEMIK</span></h3>
        </div>

        <!-- TAB NAVIGATION -->
        <div class="tab-buttons">
            <button class="tab-btn active" onclick="showTab('tab1')">📚 Mahasiswa/Prodi</button>
            <button class="tab-btn" onclick="showTab('tab2')">✅ Status Kelulusan</button>
            <button class="tab-btn" onclick="showTab('tab3')">⭐ IPK Predikat</button>
            <button class="tab-btn" onclick="showTab('tab4')">🏫 Fakultas & IPK</button>
            <button class="tab-btn" onclick="showTab('tab5')">📈 Statistik Unik</button>
        </div>

        <!-- TAB CONTENT -->
        <div class="tabs-content">

            <!-- TAB 1: Jumlah Mahasiswa Berdasarkan Program Studi -->
            <div id="tab1" class="tab-content active">
                <div class="table-responsive">
                    <table class="modern-table">
                        <thead>
                            <tr>
                                <th width="5%" style="text-align: center;">NO</th>
                                <th width="50%">Program Studi (Prodi)</th>
                                <th width="45%" style="text-align: center;">Jumlah Mahasiswa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query1 = "SELECT prodi, COUNT(nim) AS jumlah_mahasiswa FROM tbl_fakultas GROUP BY prodi ORDER BY prodi ASC";
                            $result1 = mysqli_query($conn, $query1);
                            $no1 = 0;
                            $total_mhs1 = 0;

                            if (mysqli_num_rows($result1) > 0) {
                                while ($data1 = mysqli_fetch_array($result1)) {
                                    $no1++;
                                    $total_mhs1 += $data1['jumlah_mahasiswa'];
                                    echo "<tr>";
                                    echo "<td style='text-align: center;'>$no1</td>";
                                    echo "<td>" . htmlspecialchars($data1['prodi']) . "</td>";
                                    echo "<td style='text-align: center;'>" . $data1['jumlah_mahasiswa'] . "</td>";
                                    echo "</tr>";
                                }
                                echo "<tr style='background: rgba(35,192,231,.12); border-top: 2px solid #23c0e7;'>";
                                echo "<td colspan='2' style='text-align: right; padding: 15px 18px; color: #7ebeff; font-weight: bold;'>TOTAL:</td>";
                                echo "<td style='text-align: center; padding: 15px 18px; color: #7ebeff; font-weight: bold;'>" . $total_mhs1 . "</td>";
                                echo "</tr>";
                            } else {
                                echo "<tr><td colspan='3' align='center'>Data kosong.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- TAB 2: Jumlah Mahasiswa Berdasarkan Status Kelulusan -->
            <div id="tab2" class="tab-content">
                <div class="table-responsive">
                    <table class="modern-table">
                        <thead>
                            <tr>
                                <th width="5%" style="text-align: center;">NO</th>
                                <th width="50%">Status Kelulusan</th>
                                <th width="45%" style="text-align: center;">Jumlah Mahasiswa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query2 = "SELECT sts AS status_kelulusan, COUNT(nim) AS jumlah_mahasiswa FROM tbl_fakultas WHERE sts != '-' GROUP BY sts ORDER BY sts ASC";
                            $result2 = mysqli_query($conn, $query2);
                            $no2 = 0;
                            $total_mhs2 = 0;

                            if (mysqli_num_rows($result2) > 0) {
                                while ($data2 = mysqli_fetch_array($result2)) {
                                    $no2++;
                                    $total_mhs2 += $data2['jumlah_mahasiswa'];
                                    echo "<tr>";
                                    echo "<td style='text-align: center;'>$no2</td>";
                                    echo "<td>" . htmlspecialchars($data2['status_kelulusan']) . "</td>";
                                    echo "<td style='text-align: center;'>" . $data2['jumlah_mahasiswa'] . "</td>";
                                    echo "</tr>";
                                }
                                echo "<tr style='background: rgba(35,192,231,.12); border-top: 2px solid #23c0e7;'>";
                                echo "<td colspan='2' style='text-align: right; padding: 15px 18px; color: #7ebeff; font-weight: bold;'>TOTAL:</td>";
                                echo "<td style='text-align: center; padding: 15px 18px; color: #7ebeff; font-weight: bold;'>" . $total_mhs2 . "</td>";
                                echo "</tr>";
                            } else {
                                echo "<tr><td colspan='3' align='center' style='padding: 15px;'>Data kosong.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- TAB 3: Total dan Rata-rata IPK Berdasarkan Predikat -->
            <div id="tab3" class="tab-content">
                <div class="table-responsive">
                    <table class="modern-table">
                        <thead>
                            <tr>
                                <th width="5%" style="text-align: center;">NO</th>
                                <th width="25%">Predikat (Keterangan)</th>
                                <th width="23%" style="text-align: center;">Jumlah Mahasiswa</th>
                                <th width="23%" style="text-align: center;">Total IPK</th>
                                <th width="24%" style="text-align: center;">Rata-rata IPK</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query3 = "SELECT ket AS predikat, COUNT(nim) AS jumlah_mahasiswa, SUM(ipk) AS total_ipk, ROUND(AVG(ipk), 2) AS rata_rata_ipk FROM tbl_mahasiswa_ipk WHERE ket != '-' GROUP BY ket ORDER BY rata_rata_ipk DESC";
                            $result3 = mysqli_query($conn, $query3);
                            $no3 = 0;

                            if (mysqli_num_rows($result3) > 0) {
                                while ($data3 = mysqli_fetch_array($result3)) {
                                    $no3++;
                                    echo "<tr>";
                                    echo "<td style='text-align: center;'>$no3</td>";
                                    echo "<td>" . htmlspecialchars($data3['predikat']) . "</td>";
                                    echo "<td style='text-align: center;'>" . $data3['jumlah_mahasiswa'] . "</td>";
                                    echo "<td style='text-align: center;'>" . number_format($data3['total_ipk'], 2, ',', '.') . "</td>";
                                    echo "<td style='text-align: center;'>" . $data3['rata_rata_ipk'] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5' align='center' style='padding: 15px;'>Data kosong.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- TAB 4: Rekap Gabungan - Jumlah Mahasiswa & Rata-rata IPK per Fakultas -->
            <div id="tab4" class="tab-content">
                <div class="table-responsive">
                    <table class="modern-table">
                        <thead>
                            <tr>
                                <th width="5%" style="text-align: center;">NO</th>
                                <th width="35%">Kode Fakultas</th>
                                <th width="30%" style="text-align: center;">Total Mahasiswa</th>
                                <th width="30%" style="text-align: center;">Rata-rata IPK</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query4 = "SELECT f.kdfakultas, COUNT(f.nim) AS total_mahasiswa, ROUND(AVG(i.ipk), 2) AS rata_rata_ipk FROM tbl_fakultas f INNER JOIN tbl_mahasiswa_ipk i ON f.nim = i.nim GROUP BY f.kdfakultas ORDER BY f.kdfakultas ASC";
                            $result4 = mysqli_query($conn, $query4);
                            $no4 = 0;

                            if (mysqli_num_rows($result4) > 0) {
                                while ($data4 = mysqli_fetch_array($result4)) {
                                    $no4++;
                                    echo "<tr>";
                                    echo "<td style='text-align: center;'>$no4</td>";
                                    echo "<td>" . htmlspecialchars($data4['kdfakultas']) . "</td>";
                                    echo "<td style='text-align: center;'>" . $data4['total_mahasiswa'] . "</td>";
                                    echo "<td style='text-align: center;'>" . $data4['rata_rata_ipk'] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4' align='center' style='padding: 15px;'>Data kosong.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- TAB 5: Rekap Menggunakan DISTINCT -->
            <div id="tab5" class="tab-content">
                <div class="statistics-grid">
                    <?php
                    $query5 = "SELECT COUNT(DISTINCT kdfakultas) AS total_fakultas_aktif, COUNT(DISTINCT prodi) AS total_prodi_aktif FROM tbl_fakultas";
                    $result5 = mysqli_query($conn, $query5);

                    if ($result5 && mysqli_num_rows($result5) > 0) {
                        $data5 = mysqli_fetch_array($result5);
                        ?>
                        <div class="stat-card">
                            <div class="stat-icon">🏫</div>
                            <div class="stat-content">
                                <h3><?php echo $data5['total_fakultas_aktif']; ?></h3>
                                <p>Fakultas Aktif</p>
                            </div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon">📚</div>
                            <div class="stat-content">
                                <h3><?php echo $data5['total_prodi_aktif']; ?></h3>
                                <p>Program Studi Aktif</p>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>

                <div class="table-responsive">
                    <table class="modern-table">
                        <thead>
                            <tr>
                                <th width="5%" style="text-align: center;">NO</th>
                                <th width="95%">Program Studi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query_prodi = "SELECT DISTINCT prodi FROM tbl_fakultas ORDER BY prodi ASC";
                            $result_prodi = mysqli_query($conn, $query_prodi);
                            $no_prodi = 0;

                            if (mysqli_num_rows($result_prodi) > 0) {
                                while ($data_prodi = mysqli_fetch_array($result_prodi)) {
                                    $no_prodi++;
                                    echo "<tr>";
                                    echo "<td style='text-align: center;'>$no_prodi</td>";
                                    echo "<td>" . htmlspecialchars($data_prodi['prodi']) . "</td>";
                                    echo "</tr>";
                                }
                            }
                            mysqli_close($conn);
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <script>
        function showTab(tabId) {
            // Hide all tabs
            var tabs = document.querySelectorAll('.tab-content');
            tabs.forEach(function(tab) {
                tab.classList.remove('active');
            });

            // Remove active class from all buttons
            var buttons = document.querySelectorAll('.tab-btn');
            buttons.forEach(function(btn) {
                btn.classList.remove('active');
            });

            // Show selected tab
            document.getElementById(tabId).classList.add('active');

            // Add active class to clicked button
            event.target.classList.add('active');
        }
    </script>
</body>
</html>
