<?php
session_start();
if($_SESSION['status'] != "login" || $_SESSION['role'] != 'staf'){
    header("location:../index.php?pesan=belum_login");
    exit();
}

include '../config/database.php';

// Logic Data (Tetap sama)
$q_total = mysqli_query($conn, "SELECT COUNT(*) as jumlah FROM barang");
$total_barang = mysqli_fetch_assoc($q_total)['jumlah'];
$q_baik = mysqli_query($conn, "SELECT COUNT(*) as jumlah FROM barang WHERE kondisi='baik'");
$barang_baik = mysqli_fetch_assoc($q_baik)['jumlah'];
$q_rusak = mysqli_query($conn, "SELECT COUNT(*) as jumlah FROM barang WHERE kondisi='rusak'");
$barang_rusak = mysqli_fetch_assoc($q_rusak)['jumlah'];

// VARIABEL KONFIGURASI HALAMAN (PENTING BUAT KOMPONEN)
$page = 'dashboard';
$judul = 'Overview Dashboard';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Staf</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; background-color: #F3F4F6; }</style>
</head>
<body class="flex h-screen overflow-hidden">

    <?php include '../komponen/sidebar.php'; ?>

    <main class="flex-1 flex flex-col h-screen overflow-y-auto bg-[#F3F4F6]">
        
        <?php include '../komponen/header.php'; ?>

        <div class="p-8">
            <div class="bg-gradient-to-r from-indigo-600 to-blue-500 rounded-2xl p-8 text-white shadow-xl shadow-indigo-500/20 mb-8 relative overflow-hidden">
                <div class="relative z-10">
                    <h1 class="text-3xl font-bold mb-2">Selamat Siang, <?php echo $_SESSION['nama']; ?>! 👋</h1>
                    <p class="opacity-90">Berikut ringkasan data inventaris sekolah saat ini.</p>
                </div>
                <i class="ri-database-2-line absolute -right-4 -bottom-8 text-9xl text-white opacity-10 rotate-12"></i>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                 <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow group">
                    <div class="flex justify-between items-start">
                        <div><p class="text-sm text-gray-500 mb-1">Total Aset</p><h3 class="text-3xl font-bold text-gray-800"><?php echo $total_barang; ?></h3></div>
                        <div class="p-3 bg-blue-50 rounded-xl text-blue-600"><i class="ri-archive-line text-xl"></i></div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow group">
                    <div class="flex justify-between items-start">
                        <div><p class="text-sm text-gray-500 mb-1">Kondisi Baik</p><h3 class="text-3xl font-bold text-green-600"><?php echo $barang_baik; ?></h3></div>
                        <div class="p-3 bg-green-50 rounded-xl text-green-600"><i class="ri-check-double-line text-xl"></i></div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow group">
                    <div class="flex justify-between items-start">
                        <div><p class="text-sm text-gray-500 mb-1">Perlu Perbaikan</p><h3 class="text-3xl font-bold text-red-500"><?php echo $barang_rusak; ?></h3></div>
                        <div class="p-3 bg-red-50 rounded-xl text-red-600"><i class="ri-tools-line text-xl"></i></div>
                    </div>
                </div>
            </div>

             <div class="flex gap-4">
                <a href="tambah_barang.php" class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-medium transition-all shadow-lg shadow-indigo-500/30 hover:-translate-y-1">
                    <i class="ri-add-line"></i> Input Barang Baru
                </a>
            </div>
        </div>
    </main>
</body>
</html>