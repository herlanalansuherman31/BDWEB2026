<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}

include "../koneksi.php";
?>

<html>
    <head>
        <title>NsqlNPb</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="../assets/navbar/navbar.css">
        <link rel="stylesheet" href="../assets/body/body.css">
    </head>
    <body>
        <div class="main">
            <div class="navbar">
                <div class = "icon">
                    <img src="image/logo.png" alt="logo">
                </div>
                
            <div class="menu">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="../mahasiswa/mahasiswa.php">Mahasiswa</a></li>
                    <li><a href="../matkul/matakuliah.php">Matkul</a></li>
                    <li><a href="../dosen/dopem.php">Dosen</a></li>
                    <li><a href="../anggota/anggota.php">Anggota</a></li>
                    <li><a href="../rekap/rekap.php">Rekap</a></li>
                    <li><a href="../logout.php">Logout</a></li>


                </ul>
            </div>

            </div>


            <!-- KONTEN  -->

                    <div class="content">

            <div class="text-content">

    <span class="tagline">DATABASE MANAGEMENT SYSTEM</span>

    <h1>
        Selamat Datang,<br>
        <span>Admin !</span>
    </h1>

    <p class="par">
        Kami mengelola data mahasiswa, mata kuliah, dan dosen pembimbing dengan sistem CRUD yang terintegrasi dengan database MySQL.  
    </p>


</div>

            <!-- TEKS SLIDER -->

            <div class="text-slider">

    <div class="quote-card">

        <div class="quote-line"></div>

        <div class="text-slides">

            <!-- QUOTE 1 -->
            <div class="slide-quote active">
                <small>01</small>

                <p>WE BUILD</p>

                <h2>SMARTER<br>SYSTEMS</h2>

                <span>FOR BETTER MANAGEMENT</span>
            </div>

            <!-- QUOTE 2 -->
            <div class="slide-quote">
                <small>02</small>

                <p>MODERN DATABASE</p>

                <h2>FAST &<br>SECURE</h2>

                <span>DESIGNED FOR STUDENTS</span>
            </div>

            <!-- QUOTE 3 -->
            <div class="slide-quote">
                <small>03</small>

                <p>DATA IS NOT</p>

                <h2>JUST<br>NUMBERS</h2>

                <span>IT'S A DECISION POWER</span>
            </div>

            <!-- QUOTE 4 -->
            <div class="slide-quote">
                <small>04</small>

                <p>CREATIVITY MEETS</p>

                <h2>LOGICAL<br>THINKING</h2>

                <span>INSIDE ONE SYSTEM</span>
            </div>

        </div>

    </div>

</div>
               
        </div> 

    </body>
</html>