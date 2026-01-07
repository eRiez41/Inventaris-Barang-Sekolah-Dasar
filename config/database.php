<?php
$host = "localhost";
$user = "root";     // Sesuaikan user db lu
$pass = "root";         // Sesuaikan password db lu
$db   = "inventaris_sd";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}
?>