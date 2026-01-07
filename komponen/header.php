<header class="h-20 bg-white/80 backdrop-blur-md border-b border-gray-200 flex items-center justify-between px-8 sticky top-0 z-10">
    <h2 class="text-xl font-bold text-gray-800"><?php echo isset($judul) ? $judul : 'Inventaris Sekolah'; ?></h2>
    
    <div class="flex items-center gap-4">
        <div class="text-right hidden sm:block">
            <p class="text-sm font-bold text-gray-700"><?php echo $_SESSION['nama']; ?></p>
            <p class="text-xs text-gray-500 capitalize"><?php echo $_SESSION['role']; ?> Tata Usaha</p>
        </div>
        <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold border border-indigo-200">
            <?php echo substr($_SESSION['nama'], 0, 1); ?>
        </div>
    </div>
</header>