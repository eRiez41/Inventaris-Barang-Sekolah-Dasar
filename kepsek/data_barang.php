<?php
session_start();
if($_SESSION['status'] != "login" || $_SESSION['role'] != 'kepsek'){
    header("location:../index.php?pesan=belum_login");
    exit();
}
include '../config/database.php';

$page = 'barang';
$judul = 'Verifikasi Penghapusan Aset';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Penghapusan Barang</title>
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
            <?php if(isset($_GET['pesan']) && $_GET['pesan'] == 'hapus_sukses'): ?>
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r shadow-sm">
                    Aset berhasil dihapus dari sistem.
                </div>
            <?php endif; ?>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">Daftar Aset Sekolah</h3>
                    <p class="text-sm text-gray-500">Penghapusan hanya dapat dilakukan pada aset dengan kondisi <strong>Rusak</strong>.</p>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-gray-600 text-sm uppercase tracking-wider">
                                <th class="p-4 border-b">No</th>
                                <th class="p-4 border-b">Nama Barang</th>
                                <th class="p-4 border-b">Lokasi</th>
                                <th class="p-4 border-b text-center">Kondisi</th>
                                <th class="p-4 border-b text-center">Opsi Penghapusan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php
                            $no = 1;
                            // Kepsek biasanya prioritas lihat yang rusak dulu
                            $query = mysqli_query($conn, "SELECT * FROM barang ORDER BY kondisi DESC, id_barang DESC");
                            while($d = mysqli_fetch_array($query)){
                            ?>
                            <tr class="hover:bg-gray-50 transition-colors text-sm text-gray-700">
                                <td class="p-4"><?php echo $no++; ?></td>
                                <td class="p-4 font-medium">
                                    <?php echo $d['nama_barang']; ?>
                                    <div class="text-xs text-gray-400"><?php echo $d['kode_barang']; ?></div>
                                </td>
                                <td class="p-4"><?php echo $d['lokasi']; ?></td>
                                <td class="p-4 text-center">
                                    <?php if($d['kondisi'] == 'baik'): ?>
                                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">Baik</span>
                                    <?php else: ?>
                                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700">Rusak</span>
                                    <?php endif; ?>
                                </td>
                                <td class="p-4 text-center">
                                    <?php if($d['kondisi'] == 'rusak'): ?>
                                        <a href="../fungsi/proses_hapus.php?id=<?php echo $d['id_barang']; ?>" 
                                           class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-xs font-medium transition-colors shadow-lg shadow-red-500/30"
                                           onclick="return confirm('PERINGATAN: Aset ini akan dihapus permanen dari database. Lanjutkan?')">
                                            <i class="ri-delete-bin-line"></i> Setujui Hapus
                                        </a>
                                    <?php else: ?>
                                        <button disabled class="px-4 py-2 bg-gray-100 text-gray-400 rounded-lg text-xs font-medium cursor-not-allowed flex items-center gap-2 mx-auto">
                                            <i class="ri-lock-line"></i> Aset Aman
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>
</html>