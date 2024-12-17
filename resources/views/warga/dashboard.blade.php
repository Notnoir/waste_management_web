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