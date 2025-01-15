<!-- resources/views/chats/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6">
    <h1 class="text-3xl font-semibold mb-6">Buat Chat Baru</h1>

    <form action="{{ route('chats.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nama Chat (Opsional untuk grup):</label>
            <input type="text" name="name" id="name"
                class="mt-2 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Masukkan nama chat">
        </div>

        <div class="mb-4">
            <label for="type" class="block text-sm font-medium text-gray-700">Tipe Chat:</label>
            <select name="type" id="type"
                class="mt-2 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="personal">Personal</option>
                <option value="group">Grup</option>
            </select>
        </div>

        <button type="submit" class="mt-4 bg-blue-500 text-white py-2 px-6 rounded-md hover:bg-blue-600">Buat
            Chat</button>
    </form>
</div>
@endsection