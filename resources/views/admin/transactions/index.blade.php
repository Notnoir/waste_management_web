@extends('layouts.main_admin')

@section('content')
<div class="p-6 space-y-4">
    <h1 class="text-3xl font-bold text-gray-800">Daftar Transaksi</h1>

    <div class="flex flex-wrap justify-between items-center gap-4">
        <!-- Search Bar -->
        <form method="GET" action="{{ route('transactions.index') }}"
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
                    placeholder="Cari Transaksi" />
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
    <div class="bg-green-100 text-red-800 border border-green-200 rounded-lg p-4 mb-6">
        {{ session('error') }}
    </div>
    @endif

    <!-- Tabel Transaksi -->
    <div class="bg-white shadow rounded overflow-x-auto mt-4">
        <table class="w-full table-auto text-left border-collapse">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 border-b">#</th>
                    <th class="px-6 py-3 border-b">Pengguna</th>
                    <th class="px-6 py-3 border-b">Tipe Transaksi</th>
                    <th class="px-6 py-3 border-b">Jadwal</th>
                    <th class="px-6 py-3 border-b">Jumlah</th>
                    <th class="px-6 py-3 border-b">Status</th>
                    <th class="px-6 py-3 border-b">Metode Pembayaran</th>
                    <th class="px-6 py-3 border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $index => $transaction)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-3 border-b">{{ $loop->iteration }}</td>
                    <td class="px-6 py-3 border-b font-medium text-gray-800">{{ $transaction->user->name }}</td>
                    <td class="px-6 py-3 border-b font-medium text-gray-800">
                        @if($transaction->type == 'top_up')
                        Top Up
                        @else
                        Pembayaran Pickup
                        @endif
                    </td>
                    <td class="px-6 py-3 border-b">
                        @if($transaction->schedule && $transaction->schedule->pickup_date)
                        {{ $transaction->schedule->pickup_date->format('d M Y') }}
                        @else
                        -
                        @endif
                    </td>
                    <td class="px-6 py-3 border-b">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                    <td class="px-6 py-3 border-b">
                        <span
                            class="{{ $transaction->status == 'pending' ? 'bg-yellow-100 text-yellow-600' : ($transaction->status == 'success' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600') }} px-2 py-1 text-sm rounded">
                            {{ ucfirst($transaction->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-3 border-b">{{ $transaction->payment_method }}</td>
                    <td class="flex px-6 py-3 border-b text-center space-x-5">
                        <a href="{{ route('transactions.show', $transaction->id) }}"
                            class="text-blue-500 hover:underline">Detail</a>
                        <button data-modal-target="edit-modal" data-modal-toggle="edit-modal"
                            data-id="{{ $transaction->id }}" data-user="{{ $transaction->user->name }}"
                            data-schedule="{{ optional($transaction->schedule)->pickup_date }}"
                            data-amount="{{ $transaction->amount }}" data-status="{{ $transaction->status }}"
                            data-payment_method="{{ $transaction->payment_method }}"
                            class="text-yellow-300 hover:underline">
                            Edit
                        </button>
                        <button type="submit" data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                            data-id="{{ $transaction->id }}" data-name="{{ $transaction->user->name }}"
                            class="text-red-500 hover:underline">
                            Hapus
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-3 text-center text-gray-500">Tidak ada transaksi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $transactions->links('pagination::tailwind') }}
    </div>
</div>

<!-- Modal tambah transaksi -->
<div id="crud-modal" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-screen bg-gray-900 bg-opacity-50">
    <div class="relative p-4 w-full max-w-md max-h-full overflow-y-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Tambah Transaksi Baru
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
            <form action="{{ route('transactions.store') }}" method="POST" class="p-4 md:p-5">
                @csrf
                <div class="grid gap-4">
                    <!-- User -->
                    <div class="col-span-2">
                        <label for="user_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pengguna</label>
                        <select name="user_id" id="user_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('user_id') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <!-- Transaction Type -->
                    <div class="col-span-2">
                        <label for="type"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Transaction
                            Type</label>
                        <select name="type" id="type"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required>
                            <option value="top_up">Top Up</option>
                            <option value="pickup_payment">Pickup Payment</option>
                        </select>
                        @error('type') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <!-- Schedule -->
                    <div class="col-span-2">
                        <label for="schedule_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jadwal</label>
                        <select name="schedule_id" id="schedule_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Select Schedule</option>
                        </select>
                        @error('schedule_id') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <!-- Amount -->
                    <div class="col-span-2">
                        <label for="amount"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah</label>
                        <input type="number" name="amount" id="amount" step="0.1"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required>
                        @error('amount') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <!-- Status -->
                    <div class="col-span-2">
                        <label for="status"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <select name="status" id="status"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required>
                            <option value="pending">Pending</option>
                            <option value="success">Success</option>
                            <option value="failed">Failed</option>
                        </select>
                        @error('status') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <!-- Payment Method -->
                    <div class="col-span-2">
                        <label for="payment_method"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Metode Pembayaran</label>
                        <input type="text" name="payment_method" id="payment_method"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="e.g., Credit Card, Bank Transfer" required>
                        @error('payment_method') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                </div>

                <button type="submit"
                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm mt-5 px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Tambahkan Transaksi
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
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Edit Transaksi</h3>
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
                    <!-- User -->
                    <div class="col-span-2">
                        <label for="edit-name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pengguna
                            (opsional)</label>
                        <select name="user_id" id="edit-name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @foreach($users as $user)
                            <option value="{{ $user->id }}" @if($user->id == old('user_id', $transaction->user_id))
                                selected @endif>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Amount -->
                    <div class="col-span-2">
                        <label for="edit-amount"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah</label>
                        <input type="number" name="amount" id="edit-amount"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required>
                    </div>

                    <!-- Status -->
                    <div class="col-span-2">
                        <label for="edit-status"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <select name="status" id="edit-status"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required>
                            <option value="pending">Pending</option>
                            <option value="success">Success</option>
                            <option value="failed">Failed</option>
                        </select>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="col-span-2">
                    <label for="edit-payment_method"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Metode Pembayaran</label>
                    <select name="payment_method" id="edit-payment_method"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        required>
                        <option value="e-wallet" @if('e-wallet'==old('payment_method', $transaction->
                            payment_method)) selected @endif>E-Wallet</option>
                        <option value="credit_card" @if('credit_card'==old('payment_method', $transaction->
                            payment_method)) selected @endif>Credit Card</option>
                        <option value="bank transfer" @if('bank_transfer'==old('payment_method', $transaction->
                            payment_method)) selected @endif>Bank Transfer</option>
                        <option value="cash" @if('cash'==old('payment_method', $transaction->payment_method)) selected
                            @endif>Cash</option>
                    </select>
                </div>

                <div>
                    <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm mt-5 px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Update Data
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
        <h3 class="text-xl font-semibold text-gray-800 border-b-2 py-3">Hapus Transaksi</h3>
        <p class="text-gray-500 my-6">Apakah Anda yakin ingin menghapus transaksi dengan pengguna <span
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
    // Event listener untuk memilih user
    document.getElementById('user_id').addEventListener('change', function() {
        const userId = this.value;
        const scheduleSelect = document.getElementById('schedule_id');
        
        // Kosongkan schedule select
        scheduleSelect.innerHTML = '<option value="">Select Schedule</option>';

        if (userId) {
            fetch(`/schedules-transactions?user_id=${userId}`)
                .then(response => response.json())
                .then(data => {
                    data.schedules.forEach(schedule => {
                        const option = document.createElement('option');
                        option.value = schedule.id;

                        // Memformat tanggal pickup_date menjadi format yang lebih mudah dibaca
                        const formattedDate = new Date(schedule.pickup_date).toLocaleDateString('id-ID'); // Format DD/MM/YYYY
                        option.textContent = formattedDate;

                        scheduleSelect.appendChild(option);
                    });
                });
        }
    });

    // Ambil semua tombol edit
    const editButtons = document.querySelectorAll('[data-modal-toggle="edit-modal"]');
    const editModal = document.getElementById('edit-modal');
    const editForm = document.getElementById('editForm');

    editButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            // Ambil data dari tombol
            const transactionId = event.target.getAttribute('data-id');
            const name = event.target.getAttribute('data-name');
            const amount = event.target.getAttribute('data-amount');
            const status = event.target.getAttribute('data-status');

            // Isi form dengan data transaksi
            document.getElementById('edit-name').value = name;
            document.getElementById('edit-amount').value = amount;
            document.getElementById('edit-status').value = status;

            // Set action form dengan ID transaksi untuk update
            editForm.action = `/admin/transactions/${transactionId}`;

            // Tampilkan modal
            editModal.classList.remove('hidden');
        });
    });

    // Tutup modal saat klik di luar modal
    document.querySelector('[data-modal-hide="edit-modal"]').addEventListener('click', () => {
        editModal.classList.add('hidden');
    });

    // Script untuk modal hapus
    const deleteButtons = document.querySelectorAll('[data-modal-toggle="popup-modal"]');
    const deleteModal = document.getElementById('popup-modal');
    const deleteForm = document.getElementById('deleteForm');
    const deleteUserName = document.getElementById('deleteUserName');

    deleteButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const transactionId = event.target.getAttribute('data-id');
            const userName = event.target.getAttribute('data-name');
            deleteUserName.textContent = userName;
            deleteForm.action = `/admin/transactions/${transactionId}`;
            deleteModal.classList.remove('hidden');
        });
    });

    document.querySelector('[data-modal-hide="popup-modal"]').addEventListener('click', () => {
        deleteModal.classList.add('hidden');
    });
</script>
@endsection