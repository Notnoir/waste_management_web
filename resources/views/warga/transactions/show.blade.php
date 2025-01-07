@extends('layouts.main_warga')

@section('content')
<div class="container mx-auto p-4">
    <div class="max-w-2xl mx-auto bg-white shadow rounded-lg p-6">
        <div class="flex mb-5 border-b-2 border-gray-300 pb-4">
            <h1 class="text-2xl font-semibold text-gray-800">Detail Transaksi</h1>
            <span
                class="px-3 py-1 ml-auto text-sm font-medium {{ $transaction->status === 'success' ? 'bg-green-200 text-green-600 rounded-full' : ($transaction->status === 'pending' ? 'bg-yellow-200 text-yellow-600  rounded-full' : 'bg-red-200 text-red-600  rounded-full') }}">
                {{ ucfirst($transaction->status) }}
            </span>
        </div>

        <div class="mb-4 border-b-2 border-dashed pb-6">
            <h2 class="text-lg font-semibold text-gray-600">Informasi Transaksi</h2>
            <div class="mt-2 text-gray-700 space-y-1">
                <p><strong>ID Transaksi:</strong> {{ $transaction->id }}</p>
                <p><strong>Tanggal:</strong> {{ $transaction->created_at->format('d M Y, H:i') }}</p>
            </div>
        </div>

        <div class="mb-4 border-b-2 border-dashed pb-6">
            <h2 class="text-lg font-semibold text-gray-600">Informasi Pengguna</h2>
            <div class="mt-2 text-gray-700 space-y-1">
                <p><strong>Nama:</strong> {{ $transaction->user->name }}</p>
                <p><strong>Email:</strong> {{ $transaction->user->email }}</p>
            </div>
        </div>

        <div class="mb-4 border-b-2 border-dashed pb-6">
            <h2 class="text-lg font-semibold text-gray-600">Detail Pembayaran</h2>
            <div class="mt-2 text-gray-700 space-y-1">
                <p><strong>Jumlah:</strong> Rp {{ number_format($transaction->amount, 2, ',', '.') }}</p>
                <p><strong>Metode Pembayaran:</strong>
                    @if ($transaction->payment_method === 'bank_transfer')
                    Transfer Bank
                    @elseif ($transaction->payment_method === 'e_wallet')
                    E-Wallet
                    @else
                    Kartu Kredit
                    @endif
                </p>
            </div>
        </div>

        <div class="flex items-center justify-between mt-6">
            <a href="{{ route('warga.transactions.index') }}"
                class="inline-flex items-center px-4 py-3 text-sm font-medium text-white bg-gray-800 hover:bg-gray-900 rounded-lg focus:outline-none focus:ring focus:ring-gray-300">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali
            </a>
            @if ($transaction->status === 'pending')
            <form action="{{ route('warga.transactions.simulate', $transaction->id) }}" method="POST">
                @csrf
                <button type="submit" id="paymentButton"
                    class="btn bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg">
                    Bayar Sekarang
                </button>
                <button id="paymentLoader"
                    class="hidden btn bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg">
                    Memproses pembayaran... Mohon tunggu...
                </button>
            </form>
            @endif
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', () => {
            document.getElementById('paymentLoader').classList.remove('hidden');
            document.getElementById('paymentButton').classList.add('hidden');
        });
    });
</script>
@endsection