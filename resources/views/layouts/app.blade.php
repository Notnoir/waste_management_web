<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite('resources/css/app.css') {{-- Pastikan Anda sudah menambahkan Tailwind di project Laravel --}}
    <!-- Tambahkan jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-gray-50">
    <div class="min-h-screen flex flex-col">
        <header class="bg-blue-500 text-white p-4">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-xl font-bold">{{ config('app.name', 'Laravel') }}</h1>
                <nav>
                    <a href="{{ route('chats.index') }}" class="px-3 py-2 hover:underline">Chats</a>
                    <a href="#" class="px-3 py-2 hover:underline">Logout</a>
                </nav>
            </div>
        </header>
        <main class="flex-grow">
            @yield('content')
        </main>
        <footer class="bg-gray-800 text-white p-4 text-center">
            &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
        </footer>
    </div>
</body>

</html>