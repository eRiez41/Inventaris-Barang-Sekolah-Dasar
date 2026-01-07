<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Inventaris SD Empangsari</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Custom Glassmorphism */
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-indigo-100 via-purple-100 to-pink-100 h-screen flex items-center justify-center overflow-hidden">

    <div class="absolute top-0 left-0 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-2xl opacity-70 animate-blob"></div>
    <div class="absolute top-0 right-0 w-72 h-72 bg-yellow-300 rounded-full mix-blend-multiply filter blur-2xl opacity-70 animate-blob animation-delay-2000"></div>
    <div class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-2xl opacity-70 animate-blob animation-delay-4000"></div>

    <div class="relative w-full max-w-md p-8 glass rounded-2xl shadow-2xl">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800 tracking-tight">Inventaris SDN Empangsari</h1>
            <p class="text-gray-500 text-sm mt-2">Masuk untuk mengelola aset sekolah</p>
        </div>

        <?php 
        if(isset($_GET['pesan']) && $_GET['pesan']=="gagal"){
            echo '
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 mb-4 rounded-r text-sm" role="alert">
                <p class="font-bold">Login Gagal</p>
                <p>Username atau password salah.</p>
            </div>';
        }
        ?>

        <form action="fungsi/auth.php" method="POST" class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                <input type="text" name="username" required autocomplete="off" 
                    class="w-full px-4 py-3 rounded-xl bg-white/50 border border-gray-200 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 transition-all outline-none text-gray-700 placeholder-gray-400"
                    placeholder="Masukan username">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" required 
                    class="w-full px-4 py-3 rounded-xl bg-white/50 border border-gray-200 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 transition-all outline-none text-gray-700 placeholder-gray-400"
                    placeholder="••••••••">
            </div>

            <button type="submit" 
                class="w-full py-3.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold shadow-lg shadow-indigo-500/30 transition-all transform hover:-translate-y-0.5 active:translate-y-0">
                Masuk Sistem
            </button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-xs text-gray-400">© 2025 SDN Empangsari</p>
        </div>
    </div>

</body>
</html>