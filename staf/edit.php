<?php
session_start();
if($_SESSION['status'] != "login" || $_SESSION['role'] != 'staf'){
    header("location:../index.php?pesan=belum_login");
    exit();
}
include '../config/database.php';

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM barang WHERE id_barang='$id'");
$d = mysqli_fetch_array($query);

// Konfigurasi Halaman (Page = barang biar menu Data Barang tetap aktif)
$page = 'barang';
$judul = 'Edit Data Aset';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; background-color: #F3F4F6; }</style>
</head>
<body class="flex h-screen overflow-hidden">

    <?php include '../komponen/sidebar.php'; ?>

    <main class="flex-1 flex flex-col h-screen overflow-y-auto bg-[#F3F4F6]">
        
        <?php include '../komponen/header.php'; ?>

        <div class="p-8 max-w-4xl mx-auto w-full">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">Edit Informasi Barang</h3>
                </div>
                
                <form action="../fungsi/proses_edit.php" method="POST" enctype="multipart/form-data" class="p-8">
                    <input type="hidden" name="id" value="<?php echo $d['id_barang']; ?>">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        
                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kode Barang</label>
                                <input type="text" name="kode" value="<?php echo $d['kode_barang']; ?>" readonly 
                                    class="w-full px-4 py-2 border border-gray-200 bg-gray-100 text-gray-500 rounded-lg cursor-not-allowed">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Barang</label>
                                <input type="text" name="nama" value="<?php echo $d['nama_barang']; ?>" required 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Merk / Brand</label>
                                <input type="text" name="merk" value="<?php echo $d['merk']; ?>" required 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                                <select name="kategori" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none bg-white">
                                    <?php 
                                    $kat = mysqli_query($conn, "SELECT * FROM kategori");
                                    while($k = mysqli_fetch_array($kat)){
                                        $selected = ($k['id_kategori'] == $d['id_kategori']) ? "selected" : "";
                                        echo "<option value='".$k['id_kategori']."' $selected>".$k['nama_kategori']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="space-y-5">
                            <div class="bg-yellow-50 p-4 rounded-xl border border-yellow-200">
                                <label class="block text-sm font-bold text-yellow-800 mb-2">Kondisi Barang</label>
                                <select name="kondisi" class="w-full px-4 py-2 border border-yellow-300 rounded-lg focus:ring-2 focus:ring-yellow-500 outline-none bg-white">
                                    <option value="baik" <?php if($d['kondisi']=='baik') echo 'selected'; ?>>Baik (Layak Pakai)</option>
                                    <option value="rusak" <?php if($d['kondisi']=='rusak') echo 'selected'; ?>>Rusak (Perlu Perbaikan/Hapus)</option>
                                </select>
                                <p class="text-xs text-yellow-700 mt-2">*Ubah status ke "Rusak" jika barang sudah tidak berfungsi.</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                                <input type="text" name="lokasi" value="<?php echo $d['lokasi']; ?>" required 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Stok</label>
                                    <input type="number" name="stok" value="<?php echo $d['stok']; ?>" required 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
                                </div>
                            </div>
                            
                             <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Update Foto</label>
                                <input type="file" name="foto" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-all"/>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end gap-3 border-t border-gray-100 pt-6">
                        <a href="data_barang.php" class="px-6 py-2.5 rounded-xl border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition-colors">Kembali</a>
                        <button type="submit" class="px-6 py-2.5 rounded-xl bg-indigo-600 text-white font-medium hover:bg-indigo-700 shadow-lg shadow-indigo-500/30 transition-all">Simpan Perubahan</button>
                    </div>
                </form>

            </div>
        </div>
    </main>
</body>
</html>