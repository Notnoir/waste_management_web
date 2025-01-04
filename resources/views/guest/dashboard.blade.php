@extends('layouts.main_guest')

@section('content')
<div class="container mx-auto py-4">
    <!-- Top Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        <div class="bg-white shadow rounded p-4 text-center">
            <div class="flex justify-center items-center mb-4 text-green-500">
                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            <h3 class="text-gray-600 text-sm">Pengguna Aktif</h3>
            <p class="text-2xl font-bold">1,200+</p>
        </div>
        <div class="bg-white shadow rounded p-4 text-center">
            <div class="flex justify-center items-center mb-4 text-blue-500">
                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <h3 class="text-gray-600 text-sm">Total Pickup</h3>
            <p class="text-2xl font-bold">10,000+</p>
        </div>
        <div class="bg-white shadow rounded p-4 text-center">
            <div class="flex justify-center items-center mb-4 text-yellow-500">
                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h3 class="text-gray-600 text-sm">Kepuasan Pelanggan</h3>
            <p class="text-2xl font-bold">98%</p>
        </div>
    </div>

    <!-- Main Feature -->
    <div class="bg-white shadow p-6 rounded text-center mb-4">
        <h1 class="text-green-600 text-3xl font-bold mb-3">EcoConnect</h1>
        <h2 class="text-gray-800 text-2xl font-bold mb-3">Mulai Perjalanan Hijau Anda</h2>
        <p class="text-gray-700 mb-4 mx-auto max-w-xl">
            Bergabunglah dengan komunitas peduli lingkungan dan mulai kontribusi untuk bumi yang lebih bersih
        </p>
        <a href="/register" class="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600">
            Daftar Sekarang
        </a>
    </div>

    <!-- Features Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div class="bg-white shadow rounded p-4 flex items-center">
            <div class="bg-blue-100 p-3 rounded-full text-blue-500 mr-4">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <h3 class="text-gray-800 font-semibold">Penjadwalan Mudah</h3>
                <p class="text-gray-600 text-sm">Atur jadwal pickup sampah sesuai kebutuhan Anda</p>
            </div>
        </div>
        <div class="bg-white shadow rounded p-4 flex items-center">
            <div class="bg-green-100 p-3 rounded-full text-green-500 mr-4">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <h3 class="text-gray-800 font-semibold">Sistem Poin Rewards</h3>
                <p class="text-gray-600 text-sm">Dapatkan rewards dari setiap kontribusi Anda</p>
            </div>
        </div>
    </div>

    <!-- Bottom Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-white shadow rounded p-4">
            <h3 class="text-gray-800 font-semibold mb-4">Jenis Sampah Yang Kami Kelola</h3>
            <div>
                <div class="flex justify-between items-center mb-3">
                    <span class="text-gray-600">Organik</span>
                    <span class="text-green-500 font-medium">40%</span>
                </div>
                <div class="flex justify-between items-center mb-3">
                    <span class="text-gray-600">Plastik</span>
                    <span class="text-green-500 font-medium">35%</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Kertas</span>
                    <span class="text-green-500 font-medium">25%</span>
                </div>
            </div>
        </div>
        <div class="bg-white shadow rounded p-4">
            <h3 class="text-gray-800 font-semibold mb-4">Statistik Platform</h3>
            <div>
                <div class="flex justify-between items-center mb-3">
                    <span class="text-gray-600">Total Penggunaan</span>
                    <span class="text-blue-500 font-medium">15,000+ Jam</span>
                </div>
                <div class="flex justify-between items-center mb-3">
                    <span class="text-gray-600">Pengguna Aktif Harian</span>
                    <span class="text-blue-500 font-medium">1,200+</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Rating Aplikasi</span>
                    <span class="text-blue-500 font-medium">4.8/5.0</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
