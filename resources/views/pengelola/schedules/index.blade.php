@extends('layouts.main_pengelola')

@section('content')
<div class="p-6 space-y-4">
    <h1 class="text-3xl font-bold text-gray-800">Jadwal Pengambilan Sampah</h1>

    <div class="flex flex-wrap justify-between items-center gap-4">
        <!-- Search Bar -->
        <form method="GET" action="{{ route('schedules.index') }}"
            class="flex flex-col sm:flex-row gap-3 w-full sm:max-w-sm">
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

        <!-- Tambah Jadwal -->
        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
            class="text-white bg-[#31e146] hover:bg-[#3fc04e] focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5">
            Tambah Jadwal
        </button>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
    <div class="bg-green-100 text-green-800 border border-green-200 rounded-lg p-4 mb-6">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-100 text-red-800 border border-red-200 rounded-lg p-4 mb-6">
        {{ session('error') }}
    </div>
    @endif

    <!-- Tabel Jadwal -->
    <div class="bg-white shadow rounded overflow-x-auto mt-4">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 border-b">#</th>
                    <th class="px-6 py-3 border-b">Nama Warga</th>
                    <th class="px-6 py-3 border-b">Jenis Sampah</th>
                    <th class="px-6 py-3 border-b">Tanggal</th>
                    <th class="px-6 py-3 border-b">Status</th>
                    <th class="px-6 py-3 border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($schedules as $schedule)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-3 border-b">{{ $loop->iteration }}</td>
                    <td class="px-6 py-3 border-b">{{ $schedule->user->name }}</td>
                    <td class="px-6 py-3 border-b">{{ $schedule->waste->type }}</td>
                    <td class="px-6 py-3 border-b">{{ $schedule->pickup_date->format('d M Y') }}</td>
                    <td class="px-6 py-3 border-b">
                        <span class="px-2 py-1 text-sm rounded-lg 
                                     {{ $schedule->status === 'completed' ? 'bg-green-100 text-green-800' : 
                                        ($schedule->status === 'cancelled' ? 'bg-red-100 text-red-800' : 
                                         'bg-yellow-100 text-yellow-800') }}">
                            {{ ucfirst($schedule->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-3 border-b text-center">
                        <form action="{{ route('schedules.updateStatus', $schedule->id) }}" method="POST"
                            class="inline space-x-2">
                            @csrf
                            <select name="status" class="bg-gray-50 border border-gray-300 rounded-lg">
                                <option value="pending" {{ $schedule->status == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="in_progress" {{ $schedule->status == 'in_progress' ? 'selected' : ''
                                    }}>In Progress</option>
                                <option value="completed" {{ $schedule->status == 'completed' ? 'selected' : ''
                                    }}>Completed</option>
                                <option value="cancelled" {{ $schedule->status == 'cancelled' ? 'selected' : ''
                                    }}>Cancelled</option>
                            </select>
                            <button type="submit"
                                class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 font-medium rounded-lg text-sm px-3 py-1">
                                Update
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-3 text-center text-gray-500">Tidak ada jadwal pengambilan sampah.
                    </td>
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
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Tambah Jadwal Baru</h3>
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

            <!-- Modal body -->
            <form action="{{ route('pengelola.schedules.store') }}" method="POST" class="p-4 md:p-5">
                @csrf
                <div class="grid gap-4">
                    <!-- Pilih Warga -->
                    <div class="col-span-2">
                        <label for="user_id" class="block mb-2 text-sm font-medium text-gray-900">Pilih Warga</label>
                        <select name="user_id" id="user_id" class="bg-gray-50 border border-gray-300 rounded-lg w-full">
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Pilih Jenis Sampah -->
                    <div class="col-span-2">
                        <label for="waste_id" class="block mb-2 text-sm font-medium text-gray-900">Jenis Sampah</label>
                        <select name="waste_id" id="waste_id"
                            class="bg-gray-50 border border-gray-300 rounded-lg w-full">
                            @foreach($wastes as $waste)
                            <option value="{{ $waste->id }}">{{ $waste->type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tanggal -->
                    <div class="col-span-2">
                        <label for="pickup_date" class="block mb-2 text-sm font-medium text-gray-900">Tanggal</label>
                        <input type="date" name="pickup_date" id="pickup_date"
                            class="bg-gray-50 border border-gray-300 rounded-lg w-full" required>
                    </div>

                    <!-- Kuantitas -->
                    <div class="col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah
                            (kg)</label>
                        <input type="number" name="quantity" step="0.1"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @error('quantity') <span class="text-red-600">{{ $message }}</span> @enderror
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

@endsection