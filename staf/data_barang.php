<?php
session_start();
if($_SESSION['status'] != "login" || $_SESSION['role'] != 'staf'){
    header("location:../index.php?pesan=belum_login");
    exit();
}

include '../config/database.php';

// Konfigurasi Halaman (Untuk Sidebar & Header)
$page = 'barang';
$judul = 'Data Aset Sekolah';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
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
            <?php if(isset($_GET['pesan']) && $_GET['pesan'] == 'sukses'): ?>
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r shadow-sm relative" role="alert">
                    <span class="block sm:inline">Data barang berhasil disimpan.</span>
                </div>
            <?php endif; ?>

            <?php if(isset($_GET['pesan']) && $_GET['pesan'] == 'update_sukses'): ?>
                <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-6 rounded-r shadow-sm relative" role="alert">
                    <span class="block sm:inline">Data barang berhasil diupdate.</span>
                </div>
            <?php endif; ?>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-800">List Semua Barang</h3>
                    <a href="tambah_barang.php" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700 transition-colors shadow-lg shadow-indigo-500/30">
                        + Tambah Baru
                    </a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-gray-600 text-sm uppercase tracking-wider">
                                <th class="p-4 font-semibold border-b">No</th>
                                <th class="p-4 font-semibold border-b">Kode</th>
                                <th class="p-4 font-semibold border-b">Barang</th>
                                <th class="p-4 font-semibold border-b">Kategori</th>
                                <th class="p-4 font-semibold border-b">Lokasi</th>
                                <th class="p-4 font-semibold border-b text-center">Stok</th>
                                <th class="p-4 font-semibold border-b text-center">Kondisi</th>
                                <th class="p-4 font-semibold border-b text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php
                            $no = 1;
                            $query = mysqli_query($conn, "SELECT barang.*, kategori.nama_kategori FROM barang JOIN kategori ON barang.id_kategori = kategori.id_kategori ORDER BY id_barang DESC");
                            
                            while($d = mysqli_fetch_array($query)){
                                $badge_color = ($d['kondisi'] == 'baik') ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700';
                            ?>
                            <tr class="hover:bg-gray-50 transition-colors text-sm text-gray-700">
                                <td class="p-4"><?php echo $no++; ?></td>
                                <td class="p-4"><span class="font-mono text-xs text-indigo-600 bg-indigo-50 rounded px-2 py-1"><?php echo $d['kode_barang']; ?></span></td>
                                <td class="p-4 font-medium">
                                    <?php echo $d['nama_barang']; ?>
                                    <div class="text-xs text-gray-400 mt-1"><?php echo $d['merk']; ?></div>
                                </td>
                                <td class="p-4"><?php echo $d['nama_kategori']; ?></td>
                                <td class="p-4"><?php echo $d['lokasi']; ?></td>
                                <td class="p-4 text-center font-bold"><?php echo $d['stok']; ?></td>
                                <td class="p-4 text-center">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold capitalize <?php echo $badge_color; ?>">
                                        <?php echo $d['kondisi']; ?>
                                    </span>
                                </td>
                                <td class="p-4 text-center">
                                    <a href="edit.php?id=<?php echo $d['id_barang']; ?>" class="inline-block p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit Data">
                                        <i class="ri-edit-box-line text-lg"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                
                <?php if(mysqli_num_rows($query) == 0): ?>
                <div class="p-10 text-center text-gray-400">
                    <i class="ri-inbox-line text-5xl mb-3 block opacity-50"></i>
                    <p>Belum ada data barang.</p>
                </div>
                <?php endif; ?>

            </div>
        </div>
    </main>
</body>
</html>