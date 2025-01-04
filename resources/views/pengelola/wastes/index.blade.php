@extends('layouts.main_pengelola')

@section('content')

<div class="p-6 space-y-4">

    <h1 class="text-3xl font-bold text-gray-800">Daftar Limbah</h1>
    <div class="flex flex-wrap justify-between items-center gap-4">
        <!-- Search Bar -->
        <form method="GET" action="{{ route('pengelola.wastes.index') }}"
            class="flex flex-col sm:flex-row gap-3 w-full sm:max-w-sm">
            <label for="default-search"
                class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative w-full">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="default-search" value="{{ $search ?? '' }}" name="search"
                    class="block w-full ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Cari Data" required />
            </div>
            <button type="submit"
                class="hidden sm:block text-white bg-[#31e146] hover:bg-[#3fc04e] focus:ring-4 focus:outline-none focus:ring-[#38ff4f8a] focus:border-[#38ff4f8a] font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Cari
            </button>
        </form>
    </div>

    <!-- Data Table -->
    <div class="bg-white shadow rounded overflow-x-auto overflow-hidden">
        <table class="w-full border-collapse text-left">
            <thead class="bg-gray-50 text-gray-700">
                <tr>
                    <th class="px-6 py-3 border-b">#</th>
                    <th class="px-6 py-3 border-b">Tipe</th>
                    <th class="px-6 py-3 border-b">Biaya</th>
                    <th class="px-6 py-3 border-b">Kategori</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($wastes as $index => $waste)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-3 border-b">{{ $loop->iteration }}</td>
                    <td class="px-6 py-3 border-b font-medium text-gray-800">{{ $waste->type }}</td>
                    <td class="px-6 py-3 border-b">Rp {{ number_format($waste->cost, 2) }}</td>
                    <td class="px-6 py-3 border-b capitalize">{{ $waste->category->name ?? 'Uncategorized' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-3 text-center text-gray-500">No waste data available.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $wastes->links('pagination::tailwind') }}
    </div>
</div>

@endsection