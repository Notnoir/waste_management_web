@extends('layouts.main_warga')

@section('content')
<!-- Header -->
<header class="bg-white shadow p-4 flex items-center justify-between">
    <img class="w-14 h-w-14 rounded-full"
        src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : 'https://via.placeholder.com/150' }}"
        alt="user photo">
    <h2 class="text-xl font-semibold">Hallo, {{ auth()->user()->name }}!</h2>
    <div>
        {{-- <a href="{{ route('warga.profile.show') }}"
            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Profil Saya
        </a> --}}
        <button id="dropdownMenuIconHorizontalButton" data-dropdown-toggle="dropdownDotsHorizontal"
            class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
            type="button">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 16 3">
                <path
                    d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
            </svg>
        </button>

        <!-- Dropdown menu -->
        <div id="dropdownDotsHorizontal"
            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                aria-labelledby="dropdownMenuIconHorizontalButton">
                <li>
                    <a href="{{ route('dashboard.warga') }}"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                </li>
                <li>
                    <a href="{{ route('warga.profile.show') }}"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Pengaturan</a>
                </li>
                <li>
                    <a href="{{ route('warga.transactions.index') }}"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Saldo</a>
                </li>
            </ul>
            <div class="py-2">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full px-4 py-2 text-sm text-red-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"><span
                            class="flex items-start">Logout</span></button>
                </form>
            </div>
        </div>
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
            <h3 class="text-lg font-semibold text-gray-700">Saldo Anda</h3>
            <p class="text-2xl font-bold text-green-600">Rp {{ number_format($totalBalance, 2, ',', '.') }}</p>
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