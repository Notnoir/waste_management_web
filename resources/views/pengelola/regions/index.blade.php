@extends('layouts.main_pengelola')

@section('content')
<div class="p-6 space-y-4">
    <h1 class="text-3xl font-bold text-gray-800">Daftar Wilayah</h1>

    <div class="flex flex-wrap justify-between items-center gap-4">
        <!-- Search Bar -->
        <form method="GET" action="{{ route('pengelola.regions.index') }}"
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
                    placeholder="Cari Wilayah" />
            </div>
            <button type="submit"
                class="hidden sm:block text-white bg-[#31e146] hover:bg-[#3fc04e] focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-4 py-2">
                Cari
            </button>
        </form>

        <!-- Tambah Transaksi -->
        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
            class="text-white bg-[#31e146] hover:bg-[#3fc04e] focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5">
            Tambah Transaksi
        </button>
    </div>

    <!-- Success Message -->
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

    <!-- Tabel Region -->
    <div class="bg-white shadow rounded overflow-x-auto mt-4">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 border-b">#</th>
                    <th class="px-6 py-3 border-b">Nama Wilayah</th>
                    <th class="px-6 py-3 border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($regions as $index => $region)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-3 border-b">{{ $loop->iteration }}</td>
                    <td class="px-6 py-3 border-b font-medium text-gray-800">{{ $region->name }}</td>
                    <td class="px-6 py-3 border-b text-center space-x-2">
                        <button data-modal-target="edit-modal" data-modal-toggle="edit-modal"
                            data-id="{{ $region->id }}" data-name="{{ $region->name }}"
                            class="text-yellow-300 hover:underline">
                            Edit
                        </button>
                        <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                            class="text-red-500 hover:underline" data-id="{{ $region->id }}"
                            data-name="{{ $region->name }}" type="button">
                            Delete
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-3 text-center text-gray-500">Tidak ada region.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $regions->links('pagination::tailwind') }}
    </div>
</div>

<!-- Modal tambah region -->
<div id="crud-modal" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-screen bg-gray-900 bg-opacity-50">
    <div class="relative p-4 w-full max-w-md max-h-full overflow-y-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Tambah Wilayah Baru
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
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
            <form action="{{ route('pengelola.regions.store') }}" method="POST" class="p-4 md:p-5">
                @csrf
                <div class="grid gap-4">
                    <!-- Region Name -->
                    <div class="col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                            Wilayah</label>
                        <input type="text" name="name" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required>
                        @error('name') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                </div>

                <button type="submit"
                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm mt-5 px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Tambah Wilayah
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div id="edit-modal" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-screen bg-gray-900 bg-opacity-50">
    <div class="relative p-4 w-full max-w-md max-h-full overflow-y-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Edit Region</h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="edit-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <form id="editForm" action="" method="POST" class="p-4 md:p-5">
                @csrf
                @method('PUT')
                <div class="grid gap-4">
                    <!-- Region Name -->
                    <div class="col-span-2">
                        <label for="edit-name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Region Name</label>
                        <input type="text" name="name" id="edit-name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required>
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm mt-5 px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Update Region
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Hapus -->
<div id="popup-modal" tabindex="-1"
    class="hidden fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
    <div class="bg-white p-6 rounded-lg w-full max-w-md shadow-lg">
        <h3 class="text-xl font-semibold text-gray-800 border-b-2 py-3">Hapus Data</h3>
        <p class="text-gray-500 my-6">Apakah Anda yakin ingin menghapus <span id="deleteRegion"></span>?</p>
        <form id="deleteForm" action="" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex justify-end space-x-2">
                <button type="button" data-modal-hide="popup-modal"
                    class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2">
                    Batal
                </button>
                <button type="submit"
                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2">
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
    const deleteRegion = document.getElementById('deleteRegion');

    // Tambahkan event listener ke setiap tombol delete
    deleteButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const regionId = button.getAttribute('data-id'); // Ambil ID wilayah dari atribut data
            const regionName = button.getAttribute('data-name'); // Ambil nama wilayah dari atribut data

            deleteRegion.textContent = regionName; // Tampilkan nama wilayah di modal
            deleteForm.action = `/pengelola/regions/${regionId}`; // Set action form untuk delete
            deleteModal.classList.remove('hidden'); // Tampilkan modal
        });
    });

    // Event listener untuk tombol batal (menyembunyikan modal)
    const closeModalButton = document.querySelector('[data-modal-hide="popup-modal"]');
    closeModalButton.addEventListener('click', () => {
        deleteModal.classList.add('hidden'); // Sembunyikan modal
    });

    // Ambil semua tombol edit
    const editButtons = document.querySelectorAll('[data-modal-toggle="edit-modal"]');
    const editModal = document.getElementById('edit-modal');
    const editForm = document.getElementById('editForm');

    editButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            // Ambil data dari tombol
            const regionId = event.target.getAttribute('data-id');
            const name = event.target.getAttribute('data-name');

            // Isi form dengan data region
            document.getElementById('edit-name').value = name;

            // Set action form dengan ID region untuk update
            editForm.action = `/pengelola/regions/${regionId}`;

            // Tampilkan modal
            editModal.classList.remove('hidden');
        });
    });

    // Tutup modal saat klik di luar modal
    document.querySelector('[data-modal-hide="edit-modal"]').addEventListener('click', () => {
        editModal.classList.add('hidden');
    });

</script>

@endsection