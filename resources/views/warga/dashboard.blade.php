@extends('layouts.main_warga')

@section('content')
<!-- Statistik -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Total Pickup -->
    <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-sm text-gray-500">Total Pickup</h3>
        <p class="text-[#21c434] text-2xl font-bold mt-2">25</p>
    </div>
    <!-- Total Transaksi -->
    <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-sm text-gray-500">Total Transaksi</h3>
        <p class="text-[#21c434] text-2xl font-bold mt-2">Rp. 1,250,000</p>
    </div>
    <!-- Poin Anda -->
    <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-sm text-gray-500">Poin Anda</h3>
        <p class="text-[#21c434] text-2xl font-bold mt-2">120</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 my-6">
    <!-- Jadwal Pickup -->
    <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4">
        <div class="bg-green-100 p-4 rounded-full">
            <svg class="w-8 h-8 text-green-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>

        </div>
        <div>
            <h3 class="text-lg font-semibold text-gray-700">Jadwal Pickup</h3>
            <p class="text-gray-600">
                Pickup berikutnya: <span class="font-semibold">12 Juni 2024</span>
            </p>
            <p class="text-yellow-500 text-sm">Status: Pending</p>
        </div>
    </div>

    <!-- Status Transaksi -->
    <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4">
        <div class="bg-blue-100 p-4 rounded-full">
            <svg class="w-8 h-8 text-blue-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 7h1v12a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h11.5M7 14h6m-6 3h6m0-10h.5m-.5 3h.5M7 7h3v3H7V7Z" />
            </svg>

        </div>
        <div>
            <h3 class="text-lg font-semibold text-gray-700">
                Status Transaksi
            </h3>
            <p class="text-gray-600">
                Total bulan ini: <span class="font-semibold">Rp 150,000</span>
            </p>
            <p class="text-green-500 text-sm">Status: Sukses</p>
        </div>
    </div>

    <!-- Feedback -->
    <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4">
        <div class="bg-yellow-100 p-4 rounded-full">
            <svg class="w-8 h-8 text-yellow-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-width="2"
                    d="M11.083 5.104c.35-.8 1.485-.8 1.834 0l1.752 4.022a1 1 0 0 0 .84.597l4.463.342c.9.069 1.255 1.2.556 1.771l-3.33 2.723a1 1 0 0 0-.337 1.016l1.03 4.119c.214.858-.71 1.552-1.474 1.106l-3.913-2.281a1 1 0 0 0-1.008 0L7.583 20.8c-.764.446-1.688-.248-1.474-1.106l1.03-4.119A1 1 0 0 0 6.8 14.56l-3.33-2.723c-.698-.571-.342-1.702.557-1.771l4.462-.342a1 1 0 0 0 .84-.597l1.753-4.022Z" />
            </svg>
        </div>
        <div>
            <h3 class="text-lg font-semibold text-gray-700">Feedback Anda</h3>
            <p class="text-gray-600">Berikan penilaian terhadap layanan.</p>
            <button class="mt-2 bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded text-sm">
                Berikan Feedback
            </button>
        </div>
    </div>
</div>

<!-- Jadwal Pickup -->
<div class="bg-white shadow rounded-lg p-6 mt-10">
    <h3 class="text-lg font-semibold mb-4">Jadwal Pickup</h3>
    <table class="w-full text-left">
        <thead class="bg-gray-100 text-gray-600">
            <tr>
                <th class="py-2 px-4">Tanggal</th>
                <th class="py-2 px-4">Jenis Sampah</th>
                <th class="py-2 px-4">Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="py-2 px-4">2024-12-18</td>
                <td class="py-2 px-4">Organik</td>
                <td class="py-2 px-4 text-green-600">Scheduled</td>
            </tr>
            <tr>
                <td class="py-2 px-4">2024-12-20</td>
                <td class="py-2 px-4">Plastik</td>
                <td class="py-2 px-4 text-yellow-600">Pending</td>
            </tr>
            <tr>
                <td class="py-2 px-4">2024-12-22</td>
                <td class="py-2 px-4">Kaca</td>
                <td class="py-2 px-4 text-red-600">Cancelled</td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Riwayat Transaksi -->
<div class="bg-white shadow rounded-lg p-6 mt-10">
    <h3 class="text-lg font-semibold mb-4">Riwayat Transaksi</h3>
    <table class="w-full text-left">
        <thead class="bg-gray-100 text-gray-600">
            <tr>
                <th class="py-2 px-4">Tanggal</th>
                <th class="py-2 px-4">Total</th>
                <th class="py-2 px-4">Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="py-2 px-4">2024-12-10</td>
                <td class="py-2 px-4">Rp. 250,000</td>
                <td class="py-2 px-4 text-green-600">Success</td>
            </tr>
            <tr>
                <td class="py-2 px-4">2024-12-12</td>
                <td class="py-2 px-4">Rp. 150,000</td>
                <td class="py-2 px-4 text-yellow-600">Pending</td>
            </tr>
            <tr>
                <td class="py-2 px-4">2024-12-15</td>
                <td class="py-2 px-4">Rp. 300,000</td>
                <td class="py-2 px-4 text-red-600">Failed</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection