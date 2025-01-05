@extends('layouts.main_warga')

@section('content')
<!-- Header -->
<header class="bg-white shadow p-4 flex items-center justify-between">
    <img class="w-14 h-w-14 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
        alt="user photo">
    <h2 class="text-xl font-semibold">Selamat Datang, {{ auth()->user()->name }}!</h2>
    <div>
        <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Profil Saya
        </button>
    </div>
</header>

<!-- Content -->
<div class="p-6 space-y-6">
    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white shadow rounded p-4">
            <h3 class="text-lg font-semibold text-gray-700">Jadwal Pickup</h3>
            <p class="text-2xl font-bold text-green-600">{{ $activeSchedules }} Aktif</p>
        </div>
        <div class="bg-white shadow rounded p-4">
            <h3 class="text-lg font-semibold text-gray-700">Total Transaksi</h3>
            <p class="text-2xl font-bold text-green-600">Rp {{ number_format($totalTransactions, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white shadow rounded p-4">
            <h3 class="text-lg font-semibold text-gray-700">Poin Anda</h3>
            <p class="text-2xl font-bold text-green-600">{{ $totalPoints }} Poin</p>
        </div>
    </div>

    <!-- Jadwal Pickup -->
    <div class="bg-white shadow rounded">
        <div class="p-4 border-b">
            <h3 class="text-lg font-semibold">Jadwal Pickup Mendatang</h3>
        </div>
        <table class="w-full text-left table-auto border-collapse">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b">#</th>
                    <th class="px-4 py-2 border-b">Tanggal</th>
                    <th class="px-4 py-2 border-b">Jenis Sampah</th>
                    <th class="px-4 py-2 border-b">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($schedules as $schedule)
                <tr>
                    <td class="px-4 py-2 border-b">1</td>
                    <td class="px-4 py-2 border-b">{{ $schedule->pickup_date }}</td>
                    <td class="px-4 py-2 border-b">{{ $schedule->waste->type }}</td>
                    <td class="px-4 py-2 border-b">
                        <span
                            class="px-2 py-1 text-sm rounded {{ $schedule->status == 'pending' ? 'bg-yellow-100 text-yellow-600' : 'bg-green-100 text-green-600' }}">{{
                            ucfirst($schedule->status) }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Notifikasi -->
    <div class="bg-white shadow rounded">
        <div class="p-4 border-b">
            <h3 class="text-lg font-semibold">Notifikasi</h3>
        </div>
        <ul>
            <li class="p-4 border-b flex items-center justify-between">
                <span>Pickup pada 2024-01-10 sudah dijadwalkan.</span>
                <span class="text-sm text-gray-500">1 Jam Lalu</span>
            </li>
            <li class="p-4 border-b flex items-center justify-between">
                <span>Transaksi Anda berhasil sebesar Rp 200,000.</span>
                <span class="text-sm text-gray-500">3 Hari Lalu</span>
            </li>
        </ul>
    </div>
</div>
@endsection