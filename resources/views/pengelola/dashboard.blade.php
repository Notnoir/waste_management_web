@extends('layouts.main_pengelola')

@section('content')
<div class="space-y-6 p-3">

    <header class="flex justify-between items-center bg-white shadow p-4 rounded-xl mb-6">
        <h2 class="text-xl font-bold">Selamat Datang, Pengelola!</h2>
        <a href="{{ route('pengelola.dailyReport') }}" class="text-blue-500 underline">
            <svg class="w-5 h-5 text-[#21c434] dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd"
                    d="M8 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1h2a2 2 0 0 1 2 2v15a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h2Zm6 1h-4v2H9a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2h-1V4Zm-6 8a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H9a1 1 0 0 1-1-1Zm1 3a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Z"
                    clip-rule="evenodd" />
            </svg>

        </a>
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
                        <button data-modal-target="confirm-modal" data-modal-toggle="confirm-modal"
                            data-action="{{ route('pengelola.updateStatus', $item->id) }}" data-status="in_progress"
                            class="text-white bg-[#31e146] hover:bg-[#3fc04e] focus:ring-4 font-medium rounded-lg text-sm px-5 py-2">
                            Proses
                        </button>
                        @endif

                        @if ($item->status !== 'pending')
                        <button
                            class="text-white bg-gray-300 cursor-not-allowed focus:ring-4 font-medium rounded-lg text-sm px-5 py-2"
                            disabled>Proses</button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Vehicles -->
    <div class="bg-white shadow rounded-xl overflow-x-auto">
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

<!-- Modal Konfirmasi proses jadwal -->
<div id="confirm-modal" tabindex="-1"
    class="hidden fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
    <div class="bg-white p-6 rounded-lg w-full max-w-md shadow-lg">
        <h3 class="text-xl font-semibold text-gray-800 border-b-2 py-3">Konfirmasi Proses</h3>
        <p class="text-gray-500 my-6">Apakah Anda yakin ingin memproses jadwal ini?</p>
        <form id="confirmForm" action="" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="status" value="">
            <div class="flex justify-end space-x-2">
                <button type="button" data-modal-hide="confirm-modal"
                    class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2">
                    Batal
                </button>
                <button type="submit"
                    class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2">
                    Konfirmasi
                </button>
            </div>
        </form>
    </div>
</div>

@if(session('success'))
<!-- Modal ke penugasan -->
<div tabindex="-1" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
    <div class="bg-white p-6 rounded-lg w-full max-w-md shadow-lg">
        <h3 class="text-xl font-semibold text-gray-800 border-b-2 py-3">Pemberitahuan</h3>
        <p class="text-gray-500 my-6">Setelah memproses jadwal pengambilan lanjutkan ke halaman penugasan untuk
            memberikan
            tugas ke
            driver</p>
        <div class="flex justify-end space-x-2">
            <a href="{{ route('pengelola.assignments.index') }}"
                class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2">Lanjut</a>
        </div>
    </div>
</div>
@endif

<script>
    const processButtons = document.querySelectorAll('[data-modal-toggle="confirm-modal"]');
    const confirmModal = document.getElementById('confirm-modal');
    const confirmForm = document.getElementById('confirmForm');

    processButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const actionUrl = button.getAttribute('data-action'); // Ambil URL untuk form action
            const statusValue = button.getAttribute('data-status'); // Ambil nilai status
            
            confirmForm.action = actionUrl; // Set form action
            confirmForm.querySelector('input[name="status"]').value = statusValue; // Set nilai input status
            
            confirmModal.classList.remove('hidden'); // Tampilkan modal
        });
    });

    // Tutup modal jika tombol "Batal" diklik
    const closeModalButton = document.querySelector('[data-modal-hide="confirm-modal"]');
    closeModalButton.addEventListener('click', () => {
        confirmModal.classList.add('hidden'); // Sembunyikan modal
    });
</script>

@endsection