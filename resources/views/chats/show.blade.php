<!-- resources/views/chats/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6">
    <h1 class="text-3xl font-semibold mb-4">{{ $chat->name }}</h1>

    <!-- Daftar Anggota Chat -->
    <div class="mb-6">
        <h2 class="text-xl font-medium mb-2">Anggota Chat:</h2>
        <ul class="space-y-2">
            @foreach ($chat->members as $member)
            <li class="flex items-center space-x-2">
                <span class="font-medium">{{ $member->user->name }}</span>
                @if ($member->is_admin)
                <span class="text-xs text-blue-500">[Admin]</span>
                @endif
            </li>
            @endforeach
        </ul>
    </div>

    <!-- Formulir untuk Menambahkan Anggota -->
    <div class="mb-6">
        <h2 class="text-xl font-medium mb-2">Tambahkan Anggota:</h2>
        <form action="{{ route('chats.addMember', $chat->id) }}" method="POST">
            @csrf
            <div class="flex space-x-2">
                <input type="text" name="user_id" placeholder="Masukkan ID Pengguna"
                    class="flex-1 p-3 border border-gray-300 rounded-md" required>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">Tambah
                    Anggota</button>
            </div>
        </form>
    </div>

    <!-- Pesan-pesan chat -->
    <div class="space-y-4 mb-6">
        @foreach ($chat->messages as $message)
        <div class="p-4 bg-gray-100 rounded-lg shadow-md">
            <div class="flex justify-between">
                <strong>{{ $message->user->name }}:</strong>
                <span class="text-sm text-gray-400">{{ $message->created_at->diffForHumans() }}</span>
            </div>
            <p class="mt-2 text-gray-700">{{ $message->message }}</p>
        </div>
        @endforeach
    </div>

    <!-- Formulir untuk Mengirim Pesan -->
    <form action="{{ route('chats.sendMessage', $chat->id) }}" method="POST" class="flex space-x-2">
        @csrf
        <input type="text" name="message" placeholder="Ketik pesan..."
            class="flex-1 p-3 border border-gray-300 rounded-md" required>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Kirim</button>
    </form>
</div>

<script>
    // AJAX untuk mengirim pesan
    $('#message-form').submit(function(event) {
        event.preventDefault(); // Menghentikan pengiriman form biasa

        // Mendapatkan nilai pesan dari input
        var message = $('#message').val();

        // Menyusun data yang akan dikirim
        var data = {
            _token: '{{ csrf_token() }}', // Token CSRF
            message: message,
        };

        // Mengirim pesan menggunakan AJAX
        $.ajax({
            url: "{{ route('chats.sendMessage', $chat->id) }}", // Pastikan URL benar
            method: "POST",
            data: data,
            success: function(response) {
                // Menambahkan pesan baru ke halaman tanpa reload
                var messageHtml = `
                    <div class="p-4 bg-gray-100 rounded-lg shadow-md message-item" data-id="${response.id}">
                        <div class="flex justify-between">
                            <strong>${response.user_name}:</strong>
                            <span class="text-sm text-gray-400">${response.created_at}</span>
                        </div>
                        <p class="mt-2 text-gray-700">${response.message}</p>
                    </div>
                `;
                $('#messages').append(messageHtml); // Menambah pesan baru ke daftar pesan
                $('#message').val(''); // Mengosongkan input setelah pesan dikirim
            },
            error: function() {
                alert('Gagal mengirim pesan!');
            }
        });
    });
</script>
@endsection