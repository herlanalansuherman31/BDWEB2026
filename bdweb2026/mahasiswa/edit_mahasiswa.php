<?php
// Menyambungkan file ke koneksi database
include "../koneksi.php";

// TAHAP 1: Mengambil data lama ke dalam form berdasarkan NIM yang dikirim lewat URL
if (isset($_GET['nim'])) {
    
    $nimEdit = mysqli_real_escape_string($conn, $_GET['nim']);
    
    // Mencari data mahasiswa di database
    $ambil = "SELECT * FROM tbl_mhs WHERE nim='$nimEdit'";
    $hasil = mysqli_query($conn, $ambil);
    $dataEdit = mysqli_fetch_assoc($hasil);
    
    // Jika data tidak ditemukan di database, kembalikan ke halaman utama
    if (!$dataEdit) {
        header("Location: mahasiswa.php");
        exit();
    }
}

// TAHAP 2: Memproses perubahan data ketika tombol 'update' diklik
if (isset($_POST['update'])) {
    
    // Menangkap data dari form inputan yang baru diketik oleh user
    $nim   = mysqli_real_escape_string($conn, $_POST['nim']);
    $nama  = mysqli_real_escape_string($conn, $_POST['namamhs']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']); // Menangkap inputan phone baru

    // Perintah SQL untuk mengubah nama dan phone sekaligus berdasarkan nim
    $update = "UPDATE tbl_mhs SET namamhs='$nama', phone='$phone' WHERE nim='$nim'";
    
    // Menjalankan perintah update ke database
    mysqli_query($conn, $update);

    // Memunculkan alert sukses dan memindahkan kembali user ke halaman utama mahasiswa.php
    echo "
    <script>
        alert('Data berhasil diupdate');
        window.location='mahasiswa.php';
    </script>
    ";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Mahasiswa</title>
    <link rel="stylesheet" href="edit_mahasiswa.css">
    <link rel="stylesheet" href="../assets/navbar/navbar.css">
    <link rel="stylesheet" href="../assets/body/body.css">

</head>

<!-- JAVASCRIPT UNTUK FUNCTION SCROLL NAVBAR -->

<script>

window.addEventListener('scroll', function(){

    const navbar = document.querySelector('.navbar');

    if(window.scrollY > 50){

        navbar.classList.add('scrolled');

    }else{

        navbar.classList.remove('scrolled');

    }

});

</script>


<!-- END OF JAVASCRIPT -->

<body>


<!-- NAVBAR START -->
<div class="navbar">

    <div class="icon">
        <img src="../home/image/logo.png" alt="logo">
    </div>

    <div class="menu">
        <ul>
            <li><a href="../home/index.php">Home</a></li>
            <li><a href="mahasiswa.php">Mahasiswa</a></li>
            <li><a href="../matkul/matakuliah.php">Matkul</a></li>
            <li><a href="../dosen/dopem.php">Dosen</a></li>
            <li><a href="../anggota/anggota.php">Anggota</a></li>
            <li><a href="../logout.php">Logout</a></li>

        </ul>
    </div>

</div>

<!-- NAVBAR END -->

<div class="crud-container">

    <div class="form-box">

        <span class="tagline">
            STUDENT MANAGEMENT
        </span>

        <h2>Update Data <span>Mahasiswa</span></h2>

        <p class="desc">
            Perbarui informasi mahasiswa yang telah tersimpan dalam database.
        </p>

        <form method="POST">

            <div class="input-group">

                <label>NIM</label>

                <input type="text"
                       name="nim"
                       value="<?php echo htmlspecialchars($dataEdit['nim']); ?>"
                       readonly>

            </div>

            <div class="input-group">

                <label>Nama Mahasiswa</label>

                <input type="text"
                       name="namamhs"
                       value="<?php echo htmlspecialchars($dataEdit['namamhs']); ?>"
                       required>

            </div>

            <div class="input-group">

                <label>No. HP</label>

                <input type="text"
                       name="phone"
                       value="<?php echo htmlspecialchars($dataEdit['phone']); ?>"
                       required>

            </div>

            <div class="button-group">

                <a href="mahasiswa.php" class="btn-back">
                    Kembali
                </a>

                <button type="submit"
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