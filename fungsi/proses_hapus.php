<?php 
session_start();
include '../config/database.php';

// Proteksi: Cuma Kepsek yang boleh akses file ini
if($_SESSION['role'] != 'kepsek'){
    echo "Anda tidak memiliki akses.";
    exit();
}

$id = $_GET['id'];

// 1. Ambil nama gambar dulu biar bisa dihapus dari folder
$q_gambar = mysqli_query($conn, "SELECT gambar FROM barang WHERE id_barang='$id'");
$data = mysqli_fetch_array($q_gambar);
$nama_gambar = $data['gambar'];

// 2. Hapus file gambar jika bukan default
if($nama_gambar != 'no-image.jpg' && file_exists('../uploads/'.$nama_gambar)){
    unlink('../uploads/'.$nama_gambar);
}

// 3. Hapus Data dari Database
$query = mysqli_query($conn, "DELETE FROM barang WHERE id_barang='$id'");

if($query){
    header("location:../kepsek/data_barang.php?pesan=hapus_sukses");
} else {
    echo "Gagal menghapus data.";
}
?>