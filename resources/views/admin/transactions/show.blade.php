@extends('layouts.main_admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-4xl font-bold text-gray-900 mb-8 text-center">Detail Transaksi</h1>

    <div class="bg-white shadow-xl rounded-lg overflow-hidden border border-gray-200">
        <!-- Header -->
        <div class="flex justify-between items-center p-6 bg-gray-100 border-b">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Transaksi #{{ $transaction->id }}</h2>
                <p class="text-sm text-gray-500">Dibuat pada {{ $transaction->created_at->format('d M Y, H:i') }}</p>
            </div>
            <div class="flex space-x-2">
                <span
                    class="px-3 py-1 rounded-full text-lg font-medium 
                    {{ $transaction->status === 'success' ? 'bg-green-200 text-green-600' : ($transaction->status === 'pending' ? 'bg-yellow-200 text-yellow-600' : 'bg-red-200 text-red-600') }}">
                    {{ ucfirst($transaction->status) }}
                </span>
            </div>
        </div>

        <!-- Content -->
        <div class="p-6 space-y-6">
            <!-- Detail Pengguna -->
            <div>
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">Detail Pengguna</h3>
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <p class="text-lg font-medium text-gray-700">Nama:</p>
                        <p class="text-gray-600">{{ $transaction->user->name }}</p>
                    </div>
                    <div>
                        <p class="text-lg font-medium text-gray-700">Email:</p>
                        <p class="text-gray-600">{{ $transaction->user->email }}</p>
                    </div>
                    <div>
                        <p class="text-lg font-medium text-gray-700">Nomor Telepon:</p>
                        <p class="text-gray-600">{{ $transaction->user->phone_number ?? 'Tidak tersedia' }}</p>
                    </div>
                    <div>
                        <p class="text-lg font-medium text-gray-700">Wilayah:</p>
                        <p class="text-gray-600">{{ $transaction->user->region->name ?? 'Tidak tersedia' }}</p>
                    </div>
                </div>
            </div>

            <!-- Informasi Jadwal -->
            <div>
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">Informasi Jadwal</h3>
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <p class="text-lg font-medium text-gray-700">Tanggal Pengambilan:</p>
                        <p class="text-gray-600">{{ $transaction->schedule->pickup_date->format('d M Y') }}</p>
                    </div>
                    <div>
                        <p class="text-lg font-medium text-gray-700">Tipe Limbah:</p>
                        <p class="text-gray-600">{{ $transaction->schedule->waste->type }}</p>
                    </div>
                    <div>
                        <p class="text-lg font-medium text-gray-700">Kuantitas:</p>
                        <p class="text-gray-600">{{ $transaction->schedule->quantity }} kg</p>
                    </div>
                    <div>
                        <p class="text-lg font-medium text-gray-700">Biaya Limbah:</p>
                        <p class="text-gray-600">Rp {{ number_format($transaction->schedule->waste->cost, 2, ',', '.')
                            }}</p>
                    </div>
                </div>
            </div>

            <!-- Detail Transaksi -->
            <div>
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">Detail Transaksi</h3>
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <p class="text-lg font-medium text-gray-700">Jumlah:</p>
                        <p class="text-gray-600">Rp {{ number_format($transaction->amount, 2, ',', '.') }}</p>
                    </div>
                    <div>
                        <p class="text-lg font-medium text-gray-700">Metode Pembayaran:</p>
                        <p class="text-gray-600">{{ $transaction->payment_method ?? 'Tidak tersedia' }}</p>
                    </div>
                    <div>
                        <p class="text-lg font-medium text-gray-700">Status Transaksi:</p>
                        <p class="text-gray-600 capitalize">{{ $transaction->status }}</p>
                    </div>
                    <div>
                        <p class="text-lg font-medium text-gray-700">Tanggal Transaksi:</p>
                        <p class="text-gray-600">{{ $transaction->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="mt-8 text-center">
        <a href="{{ route('transactions.index') }}"
            class="inline-flex items-center px-6 py-3 text-sm font-medium text-white bg-gray-800 hover:bg-gray-900 rounded-lg focus:outline-none focus:ring focus:ring-gray-300">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali ke Daftar Transaksi
        </a>
    </div>
</div>
@endsection