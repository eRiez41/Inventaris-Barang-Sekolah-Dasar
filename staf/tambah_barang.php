<?php
session_start();
if($_SESSION['status'] != "login" || $_SESSION['role'] != 'staf'){
    header("location:../index.php?pesan=belum_login");
    exit();
}
include '../config/database.php';

// Konfigurasi Halaman
$page = 'tambah';
$judul = 'Input Aset Baru';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; background-color: #F3F4F6; }</style>
</head>
<body class="flex h-screen overflow-hidden">

    <?php include '../komponen/sidebar.php'; ?>

    <main class="flex-1 flex flex-col h-screen overflow-y-auto bg-[#F3F4F6]">
        
        <?php include '../komponen/header.php'; ?>

        <div class="p-8 max-w-5xl mx-auto w-full">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">Form Barang Masuk</h3>
                    <p class="text-sm text-gray-500">Isi data fisik barang dengan lengkap.</p>
                </div>
                
                <form action="../fungsi/proses_tambah.php" method="POST" enctype="multipart/form-data" class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        
                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kode Barang</label>
                                <input type="text" name="kode" required placeholder="Contoh: INV-2025-001" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Barang</label>
                                <input type="text" name="nama" required placeholder="Contoh: Laptop Asus" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Merk / Brand</label>
                                <input type="text" name="merk" required placeholder="Contoh: Asus, Epson" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                                <select name="kategori" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none bg-white">
                                    <option value="">-- Pilih Kategori --</option>
                                    <?php 
                                    $kat = mysqli_query($conn, "SELECT * FROM kategori");
                                    while($k = mysqli_fetch_array($kat)){
                                        echo "<option value='".$k['id_kategori']."'>".$k['nama_kategori']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi Penempatan</label>
                                <select name="lokasi" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none bg-white">
                                    <option value="Gudang">Gudang</option>
                                    <option value="Kantor Guru">Kantor Guru</option>
                                    <option value="Ruang TU">Ruang TU</option>
                                    <option value="Lab Komputer">Lab Komputer</option>
                                    <option value="Perpustakaan">Perpustakaan</option>
                                    <option value="Kelas 1">Kelas 1</option>
                                    <option value="Kelas 2">Kelas 2</option>
                                    <option value="Kelas 3">Kelas 3</option>
                                    <option value="Kelas 4">Kelas 4</option>
                                    <option value="Kelas 5">Kelas 5</option>
                                    <option value="Kelas 6">Kelas 6</option>
                                </select>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Stok</label>
                                    <input type="number" name="stok" min="1" value="1" required 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Sumber Dana</label>
                                    <select name="sumber" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none bg-white">
                                        <option value="BOS">Dana BOS</option>
                                        <option value="Yayasan">Yayasan</option>
                                        <option value="Hibah">Hibah</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Foto Barang</label>
                                <input type="file" name="foto" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-all"/>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end gap-3 border-t border-gray-100 pt-6">
                        <a href="data_barang.php" class="px-6 py-2.5 rounded-xl border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition-colors">Batal</a>
                        <button type="submit" class="px-6 py-2.5 rounded-xl bg-indigo-600 text-white font-medium hover:bg-indigo-700 shadow-lg shadow-indigo-500/30 transition-all">Simpan Data</button>
                    </div>
                </form>

            </div>
        </div>
    </main>
</body>
</html>