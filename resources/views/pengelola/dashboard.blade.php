@extends('layouts.main_pengelola')

@section('content')
<div class="space-y-6 p-3">

    <header class="bg-white shadow p-4 rounded-xl mb-6">
        <h2 class="text-xl font-bold">Selamat Datang, Pengelola!</h2>
    </header>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white shadow rounded-xl p-4">
            <h3 class="text-lg font-bold text-gray-700">Jadwal Hari Ini</h3>
            <p class="text-2xl font-bold text-[#21c434]">{{ $jadwalHariIni }} Jadwal</p>
        </div>
        <div class="bg-white shadow rounded-xl p-4">
            <h3 class="text-lg font-bold text-gray-700">Kendaraan Tersedia</h3>
            <p class="text-2xl font-bold text-[#21c434]">{{ $kendaraanTersedia }} Kendaraan</p>
        </div>
        <div class="bg-white shadow rounded-xl p-4">
            <h3 class="text-lg font-bold text-gray-700">Rating Rata-rata</h3>
            <p class="text-2xl font-bold text-[#21c434]">{{ number_format($ratingRataRata, 1) }} ⭐</p>
        </div>
    </div>

    <!-- Pickup Schedule -->
    <div class="bg-white shadow rounded-xl mb-6">
        <div class="p-4 border-b">
            <h3 class="text-lg font-bold">Jadwal Pickup Hari Ini</h3>
        </div>
        <table class="w-full text-left table-auto border-collapse">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b">#</th>
                    <th class="px-4 py-2 border-b">Lokasi</th>
                    <th class="px-4 py-2 border-b">Jenis Sampah</th>
                    <th class="px-4 py-2 border-b">Status</th>
                    <th class="px-4 py-2 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jadwal as $item)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-2 border-b">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2 border-b">{{ $item->user->name }}</td>
                    <td class="px-4 py-2 border-b">{{ $item->waste->type }}</td>
                    <td class="px-4 py-2 border-b">
                        <span class="bg-yellow-100 text-yellow-600 px-2 py-1 text-sm rounded-xl">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-2 border-b">
                        @if ($item->status === 'pending')
                        <form action="{{ route('pengelola.updateStatus', $item->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="in_progress">
                            <button
                                class="text-white bg-[#31e146] hover:bg-[#3fc04e] focus:ring-4 font-medium rounded-lg text-sm px-5 py-2">Proses</button>
                        </form>
                        @endif
                        @if ($item->status !== 'pending')
                        <button
                            class="text-white bg-[#31e146] hover:bg-[#3fc04e] focus:ring-4 font-medium rounded-lg text-sm px-5 py-2"
                            disabled>Proses</button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Vehicles -->
    <div class="bg-white shadow rounded-xl">
        <div class="p-4 border-b">
            <h3 class="text-lg font-bold">Daftar Kendaraan</h3>
        </div>
        <table class="w-full text-left table-auto border-collapse">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b">#</th>
                    <th class="px-4 py-2 border-b">Nama Kendaraan</th>
                    <th class="px-4 py-2 border-b">Plat Nomor</th>
                    <th class="px-4 py-2 border-b">Kapasitas</th>
                    <th class="px-4 py-2 border-b">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kendaraan as $vehicle)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-3 border-b">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3 border-b">{{ $vehicle->name }}</td>
                    <td class="px-4 py-3 border-b">{{ $vehicle->license_plate }}</td>
                    <td class="px-4 py-3 border-b">{{ $vehicle->capacity }} kg</td>
                    <td class="px-4 py-3 border-b">
                        <span
                            class="{{ $vehicle->status == 'available' ? 'bg-green-100 text-green-600' : 'bg-yellow-100 text-yellow-600' }} px-2 py-1 text-sm rounded">
                            {{ ucfirst($vehicle->status) }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection