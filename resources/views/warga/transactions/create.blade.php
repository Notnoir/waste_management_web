@extends('layouts.main_warga')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-4">Create Transaction</h2>

        <form action="{{ route('warga.transactions.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="type" class="block text-sm font-medium text-gray-700">Transaction Type</label>
                <select name="type" id="type"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="top_up">Top Up</option>
                    <option value="pickup_payment">Pickup Payment</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                <input type="number" name="amount" id="amount"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <!-- Metode Pembayaran -->
            <div class="mb-4">
                <label for="payment_method" class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
                <select name="payment_method" id="payment_method"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    required>
                    <option value="">Pilih metode pembayaran</option>
                    <option value="bank_transfer" {{ old('payment_method')=='bank_transfer' ? 'selected' : '' }}>
                        Transfer Bank</option>
                    <option value="e_wallet" {{ old('payment_method')=='e_wallet' ? 'selected' : '' }}>E-Wallet</option>
                    <option value="credit_card" {{ old('payment_method')=='credit_card' ? 'selected' : '' }}>Kartu
                        Kredit</option>
                </select>
            </div>

            <button type="submit"
                class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Submit</button>
        </form>
    </div>
</div>
@endsection