@extends('layouts.main_admin')

@section('content')
<!-- Content -->
<div class="p-6 space-y-6">
    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white shadow rounded p-4">
            <h3 class="text-lg font-semibold text-gray-700">Total Pengguna</h3>
            <p class="text-2xl font-bold text-[#21c434]">{{ $totalUsers }}</p>
        </div>
        <div class="bg-white shadow rounded p-4">
            <h3 class="text-lg font-semibold text-gray-700">Total Transaksi</h3>
            <p class="text-2xl font-bold text-[#21c434]">Rp {{ number_format($totalTransactions, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white shadow rounded p-4">
            <h3 class="text-lg font-semibold text-gray-700">Pengambilan Selesai</h3>
            <p class="text-2xl font-bold text-[#21c434]">{{ $completedPickups }}</p>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white shadow rounded">
        <div class="p-4 border-b">
            <h3 class="text-lg font-semibold">Transaksi Terbaru</h3>
        </div>
        <table class="w-full text-left table-auto border-collapse">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b">#</th>
                    <th class="px-4 py-2 border-b">Pengguna</th>
                    <th class="px-4 py-2 border-b">Jumlah</th>
                    <th class="px-4 py-2 border-b">Status</th>
                    <th class="px-4 py-2 border-b">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($recentTransactions as $index => $transaction)
                <tr>
                    <td class="px-4 py-2 border-b">{{ $index + 1 }}</td>
                    <td class="px-4 py-2 border-b">{{ $transaction->user->name }}</td>
                    <td class="px-4 py-2 border-b">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                    <td class="px-4 py-2 border-b">
                        <span
                            class="{{ $transaction->status == 'success' ? 'bg-green-100 text-green-600' : ($transaction->status == 'pending' ? 'bg-yellow-100 text-yellow-600' : 'bg-red-100 text-red-600') }} px-2 py-1 text-sm rounded">
                            {{ ucfirst($transaction->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-2 border-b">{{ $transaction->created_at->format('Y-m-d') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-2 text-center text-gray-500 border-b">Tidak ada transaksi terbaru
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection