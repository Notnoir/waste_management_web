@extends('layouts.main_admin')

@section('content')
<div class="p-6 space-y-4">
    <h1 class="text-3xl font-bold text-gray-800">Daftar Feedback</h1>

    <div class="flex flex-wrap justify-between items-center gap-4">
        <!-- Search Bar -->
        <form method="GET" action="{{ route('feedback.index') }}"
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
                    placeholder="Cari Feedback" />
            </div>
            <button type="submit"
                class="hidden sm:block text-white bg-[#31e146] hover:bg-[#3fc04e] focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-4 py-2">
                Cari
            </button>
        </form>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="bg-green-100 text-green-800 border border-green-200 rounded-lg p-4 mb-6">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="bg-green-100 text-red-800 border border-green-200 rounded-lg p-4 mb-6">
        {{ session('error') }}
    </div>
    @endif

    <!-- Tabel Feedback -->
    <div class="bg-white shadow rounded overflow-x-auto mt-4">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 border-b">#</th>
                    <th class="px-6 py-3 border-b">User</th>
                    <th class="px-6 py-3 border-b">Jadwal</th>
                    <th class="px-6 py-3 border-b">Rating</th>
                    <th class="px-6 py-3 border-b">Komentar</th>
                    <th class="px-6 py-3 border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($feedbacks as $index => $feedback)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-3 border-b">{{ $loop->iteration }}</td>
                    <td class="px-6 py-3 border-b font-medium text-gray-800">{{ $feedback->user->name }}</td>
                    <td class="px-6 py-3 border-b">
                        {{ $feedback->schedule ? $feedback->schedule->pickup_date->format('d M Y') : '-' }}
                    </td>
                    <td class="px-6 py-3 border-b">{{ $feedback->rating }}/5</td>
                    <td class="px-6 py-3 border-b">{{ $feedback->comments ?? '-' }}</td>
                    <td class="px-6 py-3 border-b text-center space-x-2">
                        <button type="submit" data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                            data-id="{{ $feedback->id }}" data-name="{{ $feedback->user->name }}"
                            class="text-red-500 hover:underline">
                            Hapus
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-3 text-center text-gray-500">Tidak ada feedback.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $feedbacks->links('pagination::tailwind') }}
    </div>
</div>

<!-- Modal Hapus -->
<div id="popup-modal" tabindex="-1"
    class="hidden fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
    <div class="bg-white p-6 rounded-lg w-full max-w-md shadow-lg">
        <h3 class="text-xl font-semibold text-gray-800 border-b-2 py-3">Hapus Feedback</h3>
        <p class="text-gray-500 my-6">Apakah Anda yakin ingin menghapus feedback dari pengguna <span
                id="deleteUserName"></span>?</p>
        <form id="deleteForm" action="" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex justify-end space-x-2">
                <button type="button" data-modal-hide="popup-modal"
                    class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
                    Batal
                </button>
                <button type="submit"
                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
                    Hapus
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const deleteButtons = document.querySelectorAll('[data-modal-toggle="popup-modal"]');
    const deleteModal = document.getElementById('popup-modal');
    const deleteForm = document.getElementById('deleteForm');
    const deleteUserName = document.getElementById('deleteUserName');

    deleteButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const feedbackId = event.target.getAttribute('data-id');
            const userName = event.target.getAttribute('data-name');
            deleteUserName.textContent = userName;
            deleteForm.action = `/admin/feedback/${feedbackId}`; // Sesuaikan dengan route untuk menghapus feedback
            deleteModal.classList.remove('hidden');
        });
    });

    document.querySelector('[data-modal-hide="popup-modal"]').addEventListener('click', () => {
        deleteModal.classList.add('hidden');
    });
</script>


@endsection