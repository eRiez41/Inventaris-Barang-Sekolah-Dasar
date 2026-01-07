<?php
session_start();
if($_SESSION['status'] != "login" || $_SESSION['role'] != 'kepsek'){
    header("location:../index.php?pesan=belum_login");
    exit();
}
include '../config/database.php';

// Statistik
$q_total = mysqli_query($conn, "SELECT COUNT(*) as jumlah FROM barang");
$total_barang = mysqli_fetch_assoc($q_total)['jumlah'];
$q_rusak = mysqli_query($conn, "SELECT COUNT(*) as jumlah FROM barang WHERE kondisi='rusak'");
$barang_rusak = mysqli_fetch_assoc($q_rusak)['jumlah'];

$page = 'dashboard';
$judul = 'Dashboard Kepala Sekolah';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kepsek</title>
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
            <div class="bg-gradient-to-r from-gray-800 to-gray-700 rounded-2xl p-8 text-white shadow-xl shadow-gray-500/20 mb-8 relative overflow-hidden">
                <div class="relative z-10">
                    <h1 class="text-3xl font-bold mb-2">Selamat Datang, Bapak Kepala Sekolah.</h1>
                    <p class="opacity-90">Mohon tinjau aset yang dilaporkan rusak untuk persetujuan penghapusan.</p>
                </div>
                <i class="ri-building-4-line absolute -right-4 -bottom-8 text-9xl text-white opacity-10 rotate-12"></i>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500">Total Aset Sekolah</p>
                            <h3 class="text-3xl font-bold text-gray-800"><?php echo $total_barang; ?> <span class="text-sm font-normal text-gray-400">Unit</span></h3>
                        </div>
                        <div class="p-3 bg-blue-50 text-blue-600 rounded-xl"><i class="ri-archive-line text-2xl"></i></div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500">Aset Rusak / Perlu Dihapus</p>
                            <h3 class="text-3xl font-bold text-red-500"><?php echo $barang_rusak; ?> <span class="text-sm font-normal text-gray-400">Unit</span></h3>
                        </div>
                        <div class="p-3 bg-red-50 text-red-600 rounded-xl"><i class="ri-delete-bin-2-line text-2xl"></i></div>
                    </div>
                    <?php if($barang_rusak > 0): ?>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <a href="data_barang.php" class="text-sm text-red-600 font-medium hover:underline">Tinjau Barang Rusak &rarr;</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
</body>
</html>