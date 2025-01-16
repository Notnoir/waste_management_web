<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chats</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <!-- Tambahkan jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-gray-50">
    <div class="min-h-screen flex flex-col">
        <header class="w-full sticky top-0 z-50 start-0 bg-[#21c434] shadow text-white p-4">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-xl font-bold">EcoConnect</h1>
                <nav>
                    <a href="{{ route('chats.index') }}" class="px-3 py-2 hover:underline">Chats</a>
                    @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 hover:underline">Kembali ke Beranda</a>
                    @elseif(Auth::user()->role === 'pengelola')
                    <a href="{{ route('pengelola.index') }}" class="px-3 py-2 hover:underline">Kembali ke Beranda</a>
                    @elseif(Auth::user()->role === 'warga')
                    <a href="{{ route('dashboard.warga') }}" class="px-3 py-2 hover:underline">Kembali ke Beranda</a>
                    @endif
                </nav>
            </div>
        </header>
        <main class="flex-grow">
            @yield('content')
        </main>
        <footer class="text-white p-8 text-center">
            {{-- &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved. --}}
        </footer>
    </div>
</body>

</html>