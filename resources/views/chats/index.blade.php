<!-- resources/views/chats/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-3xl font-semibold mb-4">Daftar Chat</h1>

    @if(session('success'))
    <div class="bg-green-500 text-white p-4 mb-4 rounded-md">{{ session('success') }}</div>
    @endif

    <div class="mb-4">
        <a href="{{ route('chats.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Buat
            Chat Baru</a>
    </div>

    <div class="space-y-4">
        @foreach ($chats as $chat)
        <div class="flex items-center justify-between p-4 bg-gray-100 rounded-lg shadow-md">
            <div>
                <a href="{{ route('chats.show', $chat->id) }}"
                    class="text-xl font-medium text-blue-600 hover:underline">{{ $chat->name }}</a>
                <p class="text-sm text-gray-500">{{ $chat->type }}</p>
            </div>
            <span class="text-sm text-gray-400">{{ $chat->created_at->diffForHumans() }}</span>
        </div>
        @endforeach
    </div>
</div>
@endsection