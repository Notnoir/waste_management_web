<!-- resources/views/chats/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-4xl font-bold text-gray-800">💬 Daftar Obrolan</h1>
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
        <a href="{{ route('chats.show', $chat->id) }}"
            class="block p-5 bg-white border border-gray-200 rounded-lg shadow-md hover:shadow-lg hover:bg-gray-50 transition duration-300">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <!-- Icon berdasarkan tipe chat -->
                    @if($chat->type === 'group')
                    <div
                        class="flex items-center justify-center w-10 h-10 bg-indigo-100 text-indigo-600 rounded-full shadow-sm">
                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    @else
                    <div
                        class="flex items-center justify-center w-10 h-10 bg-blue-100 text-blue-600 rounded-full shadow-sm">
                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    @endif

                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">{{ $chat->name ?? 'Chat Tanpa Nama' }}</h3>
                        <p class="text-sm text-gray-500">{{ $chat->type === 'group' ? 'Grup' : 'Personal' }}</p>
                    </div>
                </div>
                <span class="text-sm text-gray-400">{{ $chat->created_at->diffForHumans() }}</span>
            </div>
        </a>
        @empty
        <p class="text-center text-gray-600">Tidak ada chat yang ditemukan. Mulai chat baru sekarang!</p>
        @endforelse

    </div>
</div>
@endsection