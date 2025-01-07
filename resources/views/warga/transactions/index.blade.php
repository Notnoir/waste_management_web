@extends('layouts.main_warga')

@section('content')
<div class="container mx-auto p-6">
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
@endsection