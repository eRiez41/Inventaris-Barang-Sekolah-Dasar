<?php 
session_start();
include '../config/database.php';

// Tangkap data dari form
$username = $_POST['username'];
$password = md5($_POST['password']); // Enkripsi MD5 sesuai request

// Mencegah SQL Injection sederhana
$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);

// Cek database
$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
$cek = mysqli_num_rows($query);

if($cek > 0){
    $data = mysqli_fetch_assoc($query);

    // Set Session
    $_SESSION['username'] = $username;
    $_SESSION['nama'] = $data['nama_lengkap'];
    $_SESSION['role'] = $data['role'];
    $_SESSION['status'] = "login";

    // Cek Role untuk Redirect
    if($data['role'] == "staf"){
        header("location:../staf/index.php");
    } else if($data['role'] == "kepsek"){
        header("location:../kepsek/index.php");
    } else {
        header("location:../index.php?pesan=gagal");
    }

} else {
    header("location:../index.php?pesan=gagal");
}
?>