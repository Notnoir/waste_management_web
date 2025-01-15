<!-- resources/views/chats/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-4xl font-bold text-gray-800">💬 Daftar Chat</h1>
        <a href="{{ route('chats.create') }}"
            class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white py-2 px-6 rounded-md shadow-lg hover:shadow-xl transform hover:scale-105 transition duration-300">
            + Buat Chat Baru
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 text-green-800 border border-green-300 p-4 mb-4 rounded-md shadow-sm">
        {{ session('success') }}
    </div>
    @endif

    <div class="space-y-6">
        @forelse ($chats as $chat)
        <div
            class="flex items-center justify-between p-5 bg-white border border-gray-200 rounded-lg shadow-md hover:shadow-lg transition duration-300">
            <div class="flex items-center space-x-4">
                <!-- Icon berdasarkan tipe chat -->
                @if($chat->type === 'group')
                <div
                    class="flex items-center justify-center w-10 h-10 bg-indigo-100 text-indigo-600 rounded-full shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a4 4 0 00-5-4m-7 6h5v-2a4 4 0 00-5-4m-7 6h5v-2a4 4 0 00-5-4m6-6a4 4 0 100-8 4 4 0 000 8z" />
                    </svg>
                </div>
                @else
                <div
                    class="flex items-center justify-center w-10 h-10 bg-blue-100 text-blue-600 rounded-full shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5.121 17.804A4 4 0 015 15V7a4 4 0 014-4h6a4 4 0 014 4v8a4 4 0 01-.121.804M9 11h6M9 15h6" />
                    </svg>
                </div>
                @endif

                <div>
                    <a href="{{ route('chats.show', $chat->id) }}"
                        class="text-lg font-semibold text-gray-800 hover:text-blue-600 hover:underline">
                        {{ $chat->name ?? 'Chat Tanpa Nama' }}
                    </a>
                    <p class="text-sm text-gray-500">{{ $chat->type === 'group' ? 'Grup' : 'Personal' }}</p>
                </div>
            </div>
            <span class="text-sm text-gray-400">{{ $chat->created_at->diffForHumans() }}</span>
        </div>
        @empty
        <p class="text-center text-gray-600">Tidak ada chat yang ditemukan. Mulai chat baru sekarang!</p>
        @endforelse
    </div>
</div>
@endsection