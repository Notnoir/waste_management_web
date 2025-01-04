@extends('layouts.main_pengelola')

@section('content')
<div class="p-6 bg-gray-100">
    <h2 class="text-2xl font-semibold mb-6">Laporan Harian</h2>

    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white shadow rounded p-4">
            <h3 class="text-lg font-semibold">Total Jadwal</h3>
            <p class="text-2xl font-bold text-[#21c434]">{{ $totalSchedules }}</p>
        </div>
        <div class="bg-white shadow rounded p-4">
            <h3 class="text-lg font-semibold">Selesai</h3>
            <p class="text-2xl font-bold text-green-600">{{ $completedSchedules }}</p>
        </div>
        <div class="bg-white shadow rounded p-4">
            <h3 class="text-lg font-semibold">Pending</h3>
            <p class="text-2xl font-bold text-yellow-300">{{ $pendingSchedules }}</p>
        </div>
    </div>

    <!-- Volume Sampah -->
    <div class="bg-white shadow rounded p-4 mb-6">
        <h3 class="text-lg font-semibold">Total Volume Sampah</h3>
        <p class="text-2xl font-bold text-[#21c434]">{{ $totalWasteVolume }} kg</p>
    </div>

    <!-- Sampah Berdasarkan Jenis -->
    <div class="bg-white shadow rounded p-4 mb-6">
        <h3 class="text-lg font-semibold border-b py-2">Volume Berdasarkan Jenis</h3>
        <ul>
            @foreach($wasteByType as $waste)
            <li class="flex justify-between py-3 border-b">
                <span>{{ $waste->type }}</span>
                <span>{{ $waste->total }} kg</span>
            </li>
            @endforeach
        </ul>
    </div>

    <!-- Rata-Rata Rating -->
    <div class="bg-white shadow rounded p-4 mb-6">
        <h3 class="text-lg font-semibold">Rata-Rata Rating</h3>
        <p class="text-2xl font-bold text-[#21c434]">{{ number_format($averageRating, 1) }}</p>
    </div>

    <!-- Total Transaksi -->
    <div class="bg-white shadow rounded p-4">
        <h3 class="text-lg font-semibold">Total Transaksi</h3>
        <p class="text-2xl font-bold text-[#21c434]">Rp {{ number_format($totalTransactions, 0, ',', '.') }}</p>
    </div>
</div>
@endsection