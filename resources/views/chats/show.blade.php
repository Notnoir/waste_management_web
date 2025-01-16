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
                <select name="user_id" class="flex-1 p-3 border border-gray-300 rounded-md" required>
                    <option value="" disabled selected>Pilih Pengguna</option>
                    @foreach($users as $user)
                    <!-- Pastikan $users berisi daftar pengguna -->
                    <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->role }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                    Tambah Anggota
                </button>
            </div>
        </form>
    </div>

    <!-- Pesan-pesan chat -->
    <div id="message-container" class="space-y-4 mb-6">
        @foreach ($chat->messages as $message)
        <div
            class="message-item flex items-start gap-2.5 {{ $message->user_id === auth()->id() ? 'justify-end' : '' }}">
            @if($message->user_id !== auth()->id())
            <img class="w-8 h-8 rounded-full"
                src="{{ $message->user->profile_picture ? asset('storage/' . $message->user->profile_picture) : 'https://via.placeholder.com/150' }}"
                alt="User image">
            @endif
            <div
                class="flex flex-col gap-1 {{ $message->user_id === auth()->id() ? 'items-end' : 'items-start' }} max-w-[320px]">
                <div class="flex items-center space-x-2 rtl:space-x-reverse">
                    <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $message->user->name }}</span>
                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">{{
                        $message->created_at->diffForHumans() }}</span>
                </div>
                <div
                    class="flex flex-col leading-1.5 p-4 border-gray-200 rounded-xl {{ $message->user_id === auth()->id() ? 'bg-blue-500 text-white rounded-s-xl rounded-se-xl' : 'bg-gray-100 text-gray-900 dark:bg-gray-700' }}">
                    <p class="text-sm font-normal">{{ $message->message }}</p>
                </div>
                <span class="text-sm font-normal text-gray-500 dark:text-gray-400">Terkirim</span>
            </div>
            @if($message->user_id === auth()->id())
            <img class="w-8 h-8 rounded-full"
                src="{{ $message->user->profile_picture ? asset('storage/' . $message->user->profile_picture) : 'https://via.placeholder.com/150' }}"
                alt="User image">
            @endif
        </div>
        @endforeach
    </div>

    <!-- Formulir untuk Mengirim Pesan -->
    <div class="relative">
        <!-- Formulir untuk Mengirim Pesan -->
        <form action="{{ route('chats.sendMessage', $chat->id) }}" method="POST"
            class="flex space-x-2 p-3 bg-white border-t border-gray-300 fixed bottom-6 left-1/2 transform -translate-x-1/2 w-[90%] md:w-2/3 lg:w-1/2 rounded-lg shadow-md">
            @csrf
            <input type="text" name="message" placeholder="Ketik pesan..."
                class="flex-1 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Kirim</button>
        </form>
    </div>
</div>
<!-- Button Scroll to Bottom -->
<button id="scrollToBottom" title="Scroll to Bottom"
    class="fixed bottom-5 right-5 p-3 bg-blue-600 text-white rounded-full shadow-lg hover:bg-blue-700 transition duration-300">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
        <path fill-rule="evenodd"
            d="M12 3a1 1 0 0 1 1 1v12.586l4.293-4.293a1 1 0 0 1 1.414 1.414l-6 6a1 1 0 0 1-1.414 0l-6-6a1 1 0 0 1 1.414-1.414L11 16.586V4a1 1 0 0 1 1-1z"
            clip-rule="evenodd" />
    </svg>
</button>


<script>
    // Scroll to the bottom of the page when the button is clicked
    document.getElementById('scrollToBottom').addEventListener('click', function () {
        window.scrollTo({
            top: document.body.scrollHeight,
            behavior: 'smooth', // Smooth scrolling effect
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        // Fungsi untuk menggulir ke elemen terakhir dalam daftar pesan
        function scrollToBottom() {
            const messageContainer = document.getElementById('message-container');
            if (messageContainer) {
                messageContainer.scrollTop = messageContainer.scrollHeight;
            }
        }

        // Panggil fungsi setelah halaman dimuat
        scrollToBottom();

        // Jika diperlukan, tambahkan observer untuk mendeteksi pesan baru (opsional)
    });

</script>
@endsection