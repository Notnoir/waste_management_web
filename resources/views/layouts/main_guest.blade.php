<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Platform Pengelolaan Sampah</title>
    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="flex flex-col min-h-screen bg-gray-100">
    <!-- Header -->
    <nav class="bg-green-600 shadow">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center">
                <img src="/img/logo2-putih.png" class="h-8 mr-2" alt="EcoConnect Logo">
                <span class="text-white text-lg font-bold">EcoConnect</span>
            </div>
            <div class="flex items-center space-x-4">
                <a href="/login" class="text-white">Masuk</a>
                <a href="/register" class="bg-white text-green-600 px-4 py-2 rounded">Daftar</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-4">
        <div class="container mx-auto px-4 py-3">
            <p class="text-center text-sm">&copy; 2024 Platform Pengelolaan Sampah. Semua Hak Dilindungi.</p>
        </div>
    </footer>
</body>
</html>
