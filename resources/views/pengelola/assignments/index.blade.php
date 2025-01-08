@extends('layouts.main_pengelola')

@section('content')
<div class="p-6 space-y-4">
        {{-- flowbite toast --}}
        @if (session()->has('success'))
        <div id="toast-success"
            class="animate__animated animate__bounceInRight fixed top-15 right-5 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
            role="alert">
            <div
                class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ms-3 text-sm font-normal">{{session('success')}}</div>
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                data-dismiss-target="#toast-success" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
        @endif
    <h1 class="text-3xl font-bold text-gray-800">Penugasan Pengambilan Limbah</h1>

    <div class="flex flex-wrap justify-between items-center gap-4">
        <!-- Search Bar -->
        <form method="GET" action="{{ route('pengelola.assignments.index') }}"
            class="flex flex-col sm:flex-row gap-3 w-full sm:max-w-sm">
            <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
            <div class="relative w-full">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="search" value="{{ request('search') }}" name="search"
                    class="block w-full ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50"
                    placeholder="Cari Penugasan" />
            </div>
            <button type="submit"
                class="hidden sm:block text-white bg-[#31e146] hover:bg-[#3fc04e] focus:ring-4 font-medium rounded-lg text-sm px-4 py-2">
                Cari
            </button>
        </form>

        <!-- Tambah Penugasan -->
        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
            class="text-white bg-[#31e146] hover:bg-[#3fc04e] focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5">
            Tambah Penugasan
        </button>
    </div>

    @if(session('error'))
    <div class="bg-red-100 text-red-800 border border-red-200 rounded-lg p-4 mb-6">
        {{ session('error') }}
    </div>
    @endif

    <!-- Tabel Penugasan -->
    <div class="bg-white shadow rounded overflow-x-auto mt-4">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 border-b">Sopir</th>
                    <th class="px-6 py-3 border-b">Jadwal</th>
                    <th class="px-6 py-3 border-b">Kendaraan</th>
                    <th class="px-6 py-3 border-b">Status</th>
                    <th class="px-6 py-3 border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($assignments as $assignment)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-3 border-b">{{ $assignment->driver_name }}</td>
                    <td class="px-6 py-3 border-b">{{ $assignment->schedule->pickup_date->format('d M Y') }}</td>
                    <td class="px-6 py-3 border-b">{{ $assignment->vehicle->name }}</td>
                    <td class="px-6 py-3 border-b">
                        <span class="px-2 py-1 text-sm rounded-lg
                                     {{ $assignment->status === 'completed' ? 'bg-green-100 text-green-800' : 
                                        ($assignment->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800' : 
                                         'bg-gray-100 text-gray-800') }}">
                            {{ ucfirst($assignment->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-3 border-b text-center">
                        <form action="{{ route('assignments.updateStatus', $assignment->id) }}" method="POST"
                            class="inline space-x-2">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="bg-gray-50 border border-gray-300 rounded-lg text-sm">
                                <option value="assigned" {{ $assignment->status == 'assigned' ? 'selected' : ''
                                    }}>Assigned
                                </option>
                                <option value="in_progress" {{ $assignment->status == 'in_progress' ? 'selected' : ''
                                    }}>In Progress</option>
                                <option value="completed" {{ $assignment->status == 'completed' ? 'selected' : ''
                                    }}>Completed
                                </option>
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
                    <td colspan="5" class="px-6 py-3 text-center text-gray-500">Tidak ada penugasan saat ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Penugasan -->
<div id="crud-modal" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-screen bg-gray-900 bg-opacity-50">
    <div class="relative p-4 w-full max-w-md max-h-full overflow-y-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <div class="flex items-center justify-between p-4 border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900">Tambah Penugasan Baru</h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
                    data-modal-toggle="add-assignment-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <!-- Modal body -->
            <form action="{{ route('pengelola.assignments.store') }}" method="POST" class="p-4">
                @csrf
                <div class="grid gap-4">
                    <!-- Pilih Jadwal -->
                    <div class="col-span-2">
                        <label for="schedule_id" class="block mb-2 text-sm font-medium text-gray-900">Pilih
                            Jadwal</label>
                        <select name="schedule_id" id="schedule_id"
                            class="bg-gray-50 border border-gray-300 rounded-lg w-full">
                            @foreach($schedules as $schedule)
                            <option value="{{ $schedule->id }}">{{ $schedule->pickup_date->format('d M Y') }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Pilih Kendaraan -->
                    <div class="col-span-2">
                        <label for="vehicle_id" class="block mb-2 text-sm font-medium text-gray-900">Pilih
                            Kendaraan</label>
                        <select name="vehicle_id" id="vehicle_id"
                            class="bg-gray-50 border border-gray-300 rounded-lg w-full">
                            @foreach($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Nama Driver -->
                    <div class="col-span-2">
                        <label for="driver_name" class="block mb-2 text-sm font-medium text-gray-900">Nama
                            Sopir</label>
                        <input type="text" name="driver_name" id="driver_name" placeholder="Masukkan nama driver"
                            class="bg-gray-50 border border-gray-300 rounded-lg w-full" required>
                    </div>

                    <!-- Status -->
                    <div class="col-span-2">
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                        <select name="status" id="status" class="bg-gray-50 border border-gray-300 rounded-lg w-full">
                            <option value="assigned">Assigned</option>
                            <option value="in_progress">In Progress</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                </div>

                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 font-medium rounded-lg text-sm mt-5 px-5 py-2.5">
                    Tambah Penugasan
                </button>
            </form>
        </div>
    </div>
</div>

@endsection