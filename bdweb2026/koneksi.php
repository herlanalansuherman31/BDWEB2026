<?php
$host = "localhost";
$user = "root";
$pass = "Herlan311.";
$db   = "basisdata2026";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
