@extends('layouts.main_pengelola')

@section('content')
<div class="container mx-auto mt-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Jadwal Pengambilan Sampah</h1>
        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
            onclick="document.getElementById('createScheduleModal').classList.remove('hidden')">
            + Buat Jadwal Baru
        </button>
    </div>

    <!-- Table -->
    <div class="overflow-hidden rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium">Warga</th>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium">Jenis Sampah</th>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium">Tanggal</th>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium">Kuantitas (kg)</th>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium">Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                @foreach($schedules as $schedule)
                <tr>
                    <td class="px-6 py-4">{{ $schedule->user->name }}</td>
                    <td class="px-6 py-4">{{ $schedule->waste->type }}</td>
                    <td class="px-6 py-4">{{ $schedule->pickup_date }}</td>
                    <td class="px-6 py-4">{{ $schedule->quantity }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            @if($schedule->status == 'pending') bg-yellow-100 text-yellow-800 
                            @elseif($schedule->status == 'in_progress') bg-blue-100 text-blue-800 
                            @elseif($schedule->status == 'completed') bg-green-100 text-green-800 
                            @else bg-red-100 text-red-800 @endif">
                            {{ ucfirst($schedule->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <form action="{{ route('schedules.updateStatus', $schedule->id) }}" method="POST"
                            class="inline">
                            @csrf
                            <select name="status" class="border rounded p-1">
                                <option value="pending" {{ $schedule->status == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="in_progress" {{ $schedule->status == 'in_progress' ? 'selected' : ''
                                    }}>In Progress</option>
                                <option value="completed" {{ $schedule->status == 'completed' ? 'selected' : ''
                                    }}>Completed</option>
                                <option value="cancelled" {{ $schedule->status == 'cancelled' ? 'selected' : ''
                                    }}>Cancelled</option>
                            </select>
                            <button type="submit" class="bg-green-600 text-white px-2 py-1 rounded hover:bg-green-700">
                                Update
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div id="createScheduleModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white rounded-lg w-1/2 p-6">
        <h2 class="text-lg font-bold mb-4">Buat Jadwal Baru</h2>
        <form action="{{ route('pengelola.schedules.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="user_id" class="block text-sm font-medium text-gray-700">Pilih Warga</label>
                <select name="user_id" id="user_id" class="block w-full border rounded p-2">
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="waste_id" class="block text-sm font-medium text-gray-700">Jenis Sampah</label>
                <select name="waste_id" id="waste_id" class="block w-full border rounded p-2">
                    @foreach($wastes as $waste)
                    <option value="{{ $waste->id }}">{{ $waste->type }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="pickup_date" class="block text-sm font-medium text-gray-700">Tanggal Pengambilan</label>
                <input type="date" name="pickup_date" id="pickup_date" class="block w-full border rounded p-2">
            </div>
            <div>
                <label for="quantity" class="block text-sm font-medium text-gray-700">Kuantitas (kg)</label>
                <input type="number" name="quantity" id="quantity" min="1" class="block w-full border rounded p-2">
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600"
                    onclick="document.getElementById('createScheduleModal').classList.add('hidden')">
                    Batal
                </button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection