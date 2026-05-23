<?php
session_start();
include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM tbl_user WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $_SESSION['user'] = $username;
    header("Location: index.php");
    exit();
} else {
    echo "<script>alert('Login gagal! Username atau password salah'); window.location='login.php';</script>";
}
?>
