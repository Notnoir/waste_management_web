@extends('layouts.main_warga')

@section('content')
<div class="p-6 space-y-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Riwayat Penjemputan Limbah</h1>

    @if (session('success'))
    <div class="bg-green-100 text-green-800 p-4 rounded mb-6">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="bg-red-100 text-red-800 p-4 rounded mb-6">
        {{ session('error') }}
    </div>
    @endif

    <div class="flex flex-wrap justify-between items-center gap-4">
        <!-- Search Bar -->
        <form method="GET" action="" class="flex flex-col sm:flex-row gap-3 w-full sm:max-w-sm">
            <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
            <div class="relative w-full">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="search" value="{{ request('search') }}" name="search"
                    class="block w-full ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50"
                    placeholder="Cari Jadwal" />
            </div>
            <button type="submit"
                class="hidden sm:block text-white bg-[#31e146] hover:bg-[#3fc04e] focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-4 py-2">
                Cari
            </button>
        </form>

        <!-- Tambah Pickup -->
        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
            class="text-white bg-[#31e146] hover:bg-[#3fc04e] focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5">
            Tambah Penjemputan
        </button>
    </div>

    <div class="bg-white shadow rounded overflow-x-auto overflow-hidden">
        <table class="w-full border-collapse text-left">
            <thead class="bg-gray-50 text-gray-700">
                <tr>
                    <th class="px-6 py-3 border-b">#</th>
                    <th class="px-6 py-3 border-b">Tanggal</th>
                    <th class="px-6 py-3 border-b">Kategori Limbah</th>
                    <th class="px-6 py-3 border-b">Jumlah/Berat (kg)</th>
                    <th class="px-6 py-3 border-b">Status</th>
                    <th class="px-6 py-3 border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($schedules as $index => $schedule)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-3 border-b">{{ $loop->iteration }}</td>
                    <td class="px-6 py-3 border-b font-medium text-gray-800">{{ $schedule->pickup_date->format('d M Y')
                        }}</td>
                    <td class="px-6 py-3 border-b">{{ $schedule->waste->type }}</td>
                    <td class="px-6 py-3 border-b">{{ $schedule->quantity }}</td>
                    <td class="px-6 py-3 border-b">
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $schedule->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : ($schedule->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                            {{ ucfirst($schedule->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-3 border-b text-center space-x-4">
                        @if ($schedule->status === 'pending')
                        <button type="button" data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                            data-id="{{ $schedule->id }}"
                            data-name="Jadwal {{ $schedule->pickup_date->format('d M Y') }}"
                            class="text-red-500 hover:underline">
                            Batalkan
                        </button>
                        @else
                        <span class="text-gray-500 text-sm">Tidak ada aksi</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-3 text-center text-gray-500">Belum ada jadwal penjemputan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $schedules->links('pagination::tailwind') }}
    </div>
</div>

<!-- Modal Tambah Jadwal -->
<div id="crud-modal" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-screen bg-gray-900 bg-opacity-50">
    <div class="relative p-4 w-full max-w-md max-h-full overflow-y-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Tambah Jadwal Penjemputan</h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <form action="{{ route('warga.pickups.store') }}" method="POST" class="p-4 md:p-5">
                @csrf
                <div class="grid gap-4">
                    <!-- Pilih Jenis Sampah -->
                    <div>
                        <label for="waste_id" class="block mb-2 text-sm font-medium text-gray-900">Jenis Sampah</label>
                        <select name="waste_id" id="waste_id" class="bg-gray-50 border rounded-lg w-full">
                            @foreach($wastes as $waste)
                            <option value="{{ $waste->id }}">{{ $waste->type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tanggal -->
                    <div>
                        <label for="pickup_date" class="block mb-2 text-sm font-medium text-gray-900">Tanggal</label>
                        <input type="date" name="pickup_date" id="pickup_date"
                            class="bg-gray-50 border rounded-lg w-full" required>
                    </div>

                    <!-- Kuantitas -->
                    <div>
                        <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900">Jumlah (kg)</label>
                        <input type="number" name="quantity" step="0.1" class="bg-gray-50 border rounded-lg w-full"
                            required>
                    </div>
                </div>

                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 font-medium rounded-lg text-sm mt-5 px-5 py-2.5">
                    Tambah Jadwal
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Modal Batal -->
<div id="popup-modal" tabindex="-1"
    class="hidden fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
    <div class="bg-white p-6 rounded-lg w-full max-w-md shadow-lg">
        <h3 class="text-xl font-semibold text-gray-800 border-b-2 py-3">Batalkan Penjemputan</h3>
        <p class="text-gray-500 my-6">Apakah Anda yakin ingin membatalkan jadwal penjemputan untuk <span
                id="cancelScheduleName"></span>?</p>
        <form id="cancelForm" action="" method="POST">
            @csrf
            <div class="flex justify-end space-x-2">
                <button type="button" data-modal-hide="popup-modal"
                    class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
                    Batal
                </button>
                <button type="submit"
                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
                    Ya, Batalkan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const cancelButtons = document.querySelectorAll('[data-modal-toggle="popup-modal"]');
    const cancelModal = document.getElementById('popup-modal');
    const cancelForm = document.getElementById('cancelForm');
    const cancelScheduleName = document.getElementById('cancelScheduleName');

    cancelButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const scheduleId = event.target.getAttribute('data-id');
            const scheduleName = event.target.getAttribute('data-name');
            cancelScheduleName.textContent = scheduleName;
            cancelForm.action = `/pickups/${scheduleId}/cancel`;
            cancelModal.classList.remove('hidden');
        });
    });

    document.querySelector('[data-modal-hide="popup-modal"]').addEventListener('click', () => {
        cancelModal.classList.add('hidden');
    });
</script>
@endsection