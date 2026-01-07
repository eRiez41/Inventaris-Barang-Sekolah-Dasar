<aside class="w-64 bg-white border-r border-gray-200 flex flex-col justify-between hidden md:flex z-20">
    <div>
        <div class="h-20 flex items-center px-8 border-b border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-indigo-600 flex items-center justify-center text-white font-bold shadow-indigo-500/50 shadow-lg">I</div>
                <span class="text-lg font-bold text-gray-800 tracking-tight">Inventaris<span class="text-indigo-600">SD</span></span>
            </div>
        </div>

        <nav class="p-4 space-y-1">
            <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 mt-4">Menu Utama</p>
            
            <a href="index.php" class="<?php echo ($page == 'dashboard') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'; ?> flex items-center gap-3 px-4 py-3 rounded-xl transition-colors font-medium">
                <i class="ri-dashboard-line text-xl"></i>
                <span>Dashboard</span>
            </a>
            
            <?php if($_SESSION['role'] == 'staf'): ?>
                <a href="data_barang.php" class="<?php echo ($page == 'barang') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'; ?> flex items-center gap-3 px-4 py-3 rounded-xl transition-colors font-medium">
                    <i class="ri-box-3-line text-xl"></i>
                    <span>Data Barang</span>
                </a>
                <a href="tambah_barang.php" class="<?php echo ($page == 'tambah') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'; ?> flex items-center gap-3 px-4 py-3 rounded-xl transition-colors font-medium">
                    <i class="ri-add-circle-line text-xl"></i>
                    <span>Input Barang</span>
                </a>
                <a href="laporan.php" class="<?php echo ($page == 'laporan') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'; ?> flex items-center gap-3 px-4 py-3 rounded-xl transition-colors font-medium">
                    <i class="ri-printer-line text-xl"></i>
                    <span>Laporan</span>
                </a>
            <?php endif; ?>

            <?php if($_SESSION['role'] == 'kepsek'): ?>
                <a href="data_barang.php" class="<?php echo ($page == 'barang') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'; ?> flex items-center gap-3 px-4 py-3 rounded-xl transition-colors font-medium">
                    <i class="ri-delete-bin-2-line text-xl"></i>
                    <span>Penghapusan Aset</span>
                </a>
                
                <a href="laporan.php" class="<?php echo ($page == 'laporan') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'; ?> flex items-center gap-3 px-4 py-3 rounded-xl transition-colors font-medium">
                    <i class="ri-printer-line text-xl"></i>
                    <span>Laporan</span>
                </a>
            <?php endif; ?>

        </nav>
    </div>

    <div class="p-4 border-t border-gray-100">
        <a href="../logout.php" class="flex items-center gap-3 px-4 py-3 text-red-600 hover:bg-red-50 rounded-xl transition-colors font-medium">
            <i class="ri-logout-box-line text-xl"></i>
            <span>Logout</span>
        </a>
    </div>
</aside>