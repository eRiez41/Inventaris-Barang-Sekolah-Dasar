<?php
session_start();
// CEK SESSION KEPSEK
if($_SESSION['status'] != "login" || $_SESSION['role'] != 'kepsek'){
    header("location:../index.php?pesan=belum_login");
    exit();
}
include '../config/database.php';

$page = 'laporan';
$judul = 'Laporan & Cetak';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Aset</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; background-color: #F3F4F6; }</style>
</head>
<body class="flex h-screen overflow-hidden">

    <?php include '../komponen/sidebar.php'; ?>

    <main class="flex-1 flex flex-col h-screen overflow-y-auto bg-[#F3F4F6]">
        <?php include '../komponen/header.php'; ?>

        <div class="p-8 max-w-6xl mx-auto w-full">
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800">Pusat Laporan</h2>
                <p class="text-gray-500">Silakan pilih jenis laporan yang ingin dicetak.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-all">
                    <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center text-indigo-600 mb-4">
                        <i class="ri-file-list-3-line text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Semua Data Aset</h3>
                    <p class="text-sm text-gray-500 mb-6">Rekapitulasi seluruh barang inventaris sekolah.</p>
                    <a href="cetak.php?filter=semua" target="_blank" class="block w-full text-center py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition-colors">
                        <i class="ri-printer-line mr-2"></i> Print Data
                    </a>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-all">
                    <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center text-red-600 mb-4">
                        <i class="ri-tools-line text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Aset Rusak</h3>
                    <p class="text-sm text-gray-500 mb-6">Laporan khusus barang kondisi rusak/penghapusan.</p>
                    <a href="cetak.php?filter=rusak" target="_blank" class="block w-full text-center py-2.5 bg-white border border-red-200 text-red-600 hover:bg-red-50 rounded-lg font-medium transition-colors">
                        <i class="ri-printer-line mr-2"></i> Print Laporan
                    </a>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-all">
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center text-green-600 mb-4">
                        <i class="ri-map-pin-line text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Laporan per Ruangan</h3>
                    <p class="text-sm text-gray-500 mb-4">Cetak Kartu Inventaris Ruangan (KIR).</p>
                    <form action="cetak.php" method="GET" target="_blank">
                        <select name="lokasi" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 outline-none bg-white mb-4 text-sm">
                            <option value="">-- Pilih Ruangan --</option>
                            <?php
                            $q_lok = mysqli_query($conn, "SELECT DISTINCT lokasi FROM barang");
                            while($l = mysqli_fetch_array($q_lok)){
                                echo "<option value='".$l['lokasi']."'>".$l['lokasi']."</option>";
                            }
                            ?>
                        </select>
                        <button type="submit" class="block w-full text-center py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-colors">
                            <i class="ri-printer-line mr-2"></i> Print Ruangan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>