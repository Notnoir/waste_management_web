@extends('layouts.main_warga')

@section('content')
<div class="container mx-auto p-6">
    {{-- flowbite toast --}}
    @if (session()->has('success'))
    <div id="toast-success"
        class="animate__animated animate__bounceInRight fixed top-5 right-5 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
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

    <h2 class="text-3xl font-semibold mb-6">Riwayat Transaksi</h2>

    <!-- Saldo -->
    <div class="flex justify-between items-center bg-white shadow-sm rounded-lg p-4 mb-6">
        <div class="text-lg font-semibold">
            Saldo Anda: <span class="text-green-600">Rp {{ number_format($balance, 2, ',', '.') }}</span>
        </div>
        <div class="text-white bg-[#31e146] hover:bg-[#3fc04e] focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5">
            <a href="{{ route('warga.transactions.create') }}">Top Up Saldo</a>
        </div>
    </div>

    <!-- Tabel Transaksi -->
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-50 text-gray-900">
                <tr class="border-b">
                    <th class="px-4 py-2 text-left font-semibold text-gray-700">#</th>
                    <th class="px-4 py-2 text-left font-semibold text-gray-700">Tanggal</th>
                    <th class="px-4 py-2 text-left font-semibold text-gray-700">Nominal</th>
                    <th class="px-4 py-2 text-left font-semibold text-gray-700">Jenis Transaksi</th>
                    <th class="px-4 py-2 text-left font-semibold text-gray-700">Status</th>
                    <th class="px-4 py-2 text-left font-semibold text-gray-700">Metode Pembayaran</th>
                    <th class="px-4 py-2 text-left font-semibold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                <tr class="border-b hover:bg-gray-100">
                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2">{{ $transaction->created_at->format('d M Y') }}</td>
                    <td class="px-4 py-2">Rp {{ number_format($transaction->amount, 2, ',', '.') }}</td>
                    <td class="px-4 py-2">
                        @if ($transaction->type == 'top_up')
                        <span class="">Top Up</span>
                        @else
                        <span class="">Pickup Payment</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">
                        @if ($transaction->status == 'success')
                        <span
                            class="bg-green-200 text-green-600 px-2 inline-flex text-xs leading-5 font-semibold rounded-full">Success</span>
                        @elseif ($transaction->status == 'pending')
                        <span
                            class="bg-yellow-200 text-yellow-600 px-2 inline-flex text-xs leading-5 font-semibold rounded-full">Pending</span>
                        @else
                        <span
                            class="bg-red-200 text-red-600 px-2 inline-flex text-xs leading-5 font-semibold rounded-full">Failed</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">
                        @if ($transaction->payment_method == 'bank_transfer')
                        <span class="">Transfer Bank</span>
                        @elseif ($transaction->payment_method == 'e_wallet')
                        <span class="">E-Wallet </span>
                        @else
                        <span class="">Kartu Kredit</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">
                        <a href="{{ route('warga.transactions.show', $transaction->id) }}"
                            class="text-blue-600 hover:underline">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    // auto close toast
    setTimeout(function() {
        var toastSuccess = document.getElementById('toast-success');
            toastSuccess.classList.add('animate__animated', 'animate__fadeOut');
            setTimeout(function() {
                toastSuccess.style.display = 'none';
            }, 1000);
        }, 2000);
</script>
@endsection