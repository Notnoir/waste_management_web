@extends('layouts.main_admin')

@section('content')
<!-- Content -->
<div class="p-6 space-y-6">
    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white shadow rounded p-4">
            <h3 class="text-lg font-semibold text-gray-700">Total Pengguna</h3>
            <p class="text-2xl font-bold text-[#21c434]">1.234</p>
        </div>
        <div class="bg-white shadow rounded p-4">
            <h3 class="text-lg font-semibold text-gray-700">Total Transaksi</h3>
            <p class="text-2xl font-bold text-[#21c434]">Rp 50.000.000</p>
        </div>
        <div class="bg-white shadow rounded p-4">
            <h3 class="text-lg font-semibold text-gray-700">Pengambilan Selesai</h3>
            <p class="text-2xl font-bold text-[#21c434]">432</p>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white shadow rounded">
        <div class="p-4 border-b">
            <h3 class="text-lg font-semibold">Transaksi Terbaru</h3>
        </div>
        <table class="w-full text-left table-auto border-collapse">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b">#</th>
                    <th class="px-4 py-2 border-b">Pengguna</th>
                    <th class="px-4 py-2 border-b">Jumlah</th>
                    <th class="px-4 py-2 border-b">Status</th>
                    <th class="px-4 py-2 border-b">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="px-4 py-2 border-b">1</td>
                    <td class="px-4 py-2 border-b">John Doe</td>
                    <td class="px-4 py-2 border-b">Rp 100.000</td>
                    <td class="px-4 py-2 border-b">
                        <span class="bg-green-100 text-green-600 px-2 py-1 text-sm rounded">Berhasil</span>
                    </td>
                    <td class="px-4 py-2 border-b">2024-12-16</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 border-b">2</td>
                    <td class="px-4 py-2 border-b">Jane Smith</td>
                    <td class="px-4 py-2 border-b">Rp 200.000</td>
                    <td class="px-4 py-2 border-b">
                        <span class="bg-yellow-100 text-yellow-600 px-2 py-1 text-sm rounded">Menunggu</span>
                    </td>
                    <td class="px-4 py-2 border-b">2024-12-15</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection