@extends('layouts.main_admin')

@section('content')
<div class="flex-1 p-6">

    <!-- Stats Section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-lg font-bold text-gray-700">Total Jadwal Hari Ini</h3>
            <p class="mt-2 text-3xl font-bold text-blue-500">12</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-lg font-bold text-gray-700">Kendaraan Tersedia</h3>
            <p class="mt-2 text-3xl font-bold text-green-500">5</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-lg font-bold text-gray-700">Feedback Positif</h3>
            <p class="mt-2 text-3xl font-bold text-[#21c434]">89%</p>
        </div>
    </div>

    <!-- Jadwal Pickup -->
    <section class="mt-8">
        <h3 class="text-xl font-bold text-gray-700 mb-4">Jadwal Pickup Hari Ini</h3>
        <div class="bg-white rounded shadow overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="py-3 px-4">Wilayah</th>
                        <th class="py-3 px-4">Pengguna</th>
                        <th class="py-3 px-4">Tanggal</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hover:bg-gray-100">
                        <td class="py-3 px-4">Wilayah 1</td>
                        <td class="py-3 px-4">John Doe</td>
                        <td class="py-3 px-4">16 Des 2024</td>
                        <td class="py-3 px-4 text-yellow-500 font-bold">Pending</td>
                        <td class="py-3 px-4">
                            <button class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                                Mulai Pickup
                            </button>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-100">
                        <td class="py-3 px-4">Wilayah 2</td>
                        <td class="py-3 px-4">Jane Doe</td>
                        <td class="py-3 px-4">16 Des 2024</td>
                        <td class="py-3 px-4 text-green-500 font-bold">Completed</td>
                        <td class="py-3 px-4">
                            <button class="bg-gray-500 text-white px-3 py-1 rounded cursor-not-allowed">
                                Selesai
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Kendaraan -->
    <section class="mt-8">
        <h3 class="text-xl font-bold text-gray-700 mb-4">Status Kendaraan</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white p-4 rounded shadow">
                <h4 class="text-lg font-bold text-gray-700">Kendaraan 1</h4>
                <p class="text-sm text-gray-600">Plat: B 1234 XYZ</p>
                <p class="mt-2 text-green-500 font-bold">Status: Tersedia</p>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h4 class="text-lg font-bold text-gray-700">Kendaraan 2</h4>
                <p class="text-sm text-gray-600">Plat: B 5678 ABC</p>
                <p class="mt-2 text-red-500 font-bold">Status: Maintenance</p>
            </div>
        </div>
    </section>
</div>
@endsection