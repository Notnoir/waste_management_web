@extends('layouts.app')

<style>
    /* Seluruh elemen scrollbar */
    ::-webkit-scrollbar {
        width: 12px;
        /* Lebar scrollbar untuk horizontal dan vertikal */
        height: 12px;
        /* Tinggi scrollbar horizontal */
    }

    /* Track atau latar belakang scrollbar */
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        /* Warna track */
        border-radius: 6px;
        /* Membuat sudut track membulat */
    }

    /* Thumb atau handle scrollbar */
    ::-webkit-scrollbar-thumb {
        background: #888;
        /* Warna handle */
        border-radius: 6px;
        /* Membuat sudut handle membulat */
    }

    /* Hover pada thumb */
    ::-webkit-scrollbar-thumb:hover {
        background: #555;
        /* Warna handle saat di-hover */
    }

    /* Jika diperlukan untuk scrollbar horizontal */
    ::-webkit-scrollbar-horizontal {
        height: 12px;
        /* Tinggi scrollbar horizontal */
    }

    /* Track horizontal */
    ::-webkit-scrollbar-track:horizontal {
        background: #f9f9f9;
        /* Warna track horizontal */
    }

    /* Thumb horizontal */
    ::-webkit-scrollbar-thumb:horizontal {
        background: #777;
        /* Warna handle horizontal */
    }

    /* Hover untuk thumb horizontal */
    ::-webkit-scrollbar-thumb:horizontal:hover {
        background: #444;
    }
</style>

@section('content')
<div class="max-w-3xl mx-auto p-6">
    <div class="flex justify-between">
        <div class="">
            <h1 class="text-3xl font-semibold mb-4">{{ $chat->name }}</h1>
        </div>
        <div class="">
            <!-- Modal toggle -->
            <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
                Tambah pengguna
            </button>
        </div>
    </div>

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

    <!-- Pesan-pesan chat -->
    <div id="message-container" class="space-y-4 px-5 mb-6 max-h-96 sm:max-h-[900px] lg:max-h-[430px] md:max-h-[850px]"
        style="overflow-y: auto;">
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
        <form action="{{ route('chats.sendMessage', $chat->id) }}" method="POST"
            class="flex space-x-2 p-3 bg-white border-t border-gray-300 fixed bottom-6 left-1/2 transform -translate-x-1/2 w-[90%] sm:w-[80%] md:w-2/3 lg:w-1/2 rounded-lg shadow-md">
            @csrf
            <input type="text" name="message" placeholder="Ketik pesan..."
                class="flex-1 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Kirim</button>
        </form>
    </div>
</div>

<!-- Modal Tambah Pengguna -->
<div id="crud-modal" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-screen bg-gray-900 bg-opacity-50">
    <div class="relative p-4 w-full max-w-md max-h-full overflow-y-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Tambah Pengguna
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="{{ route('chats.addMember', $chat->id) }}" method="POST" enctype="multipart/form-data"
                class="p-4 md:p-5">
                @csrf
                <div class="grid gap-4">
                    <div class="col-span-2 sm:col-span-1">
                        {{-- <label for="region_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Wilayah</label>
                        <select id="region_id" name="region_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required>
                            @foreach(\App\Models\Region::all() as $region)
                            <option value="{{ $region->id }}">{{ $region->name }}</option>
                            @endforeach
                        </select> --}}
                        <select name="user_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required>
                            <option value="" disabled selected>Pilih Pengguna</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->role }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit"
                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm mt-5 px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Tambah Anggota
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Button Refresh -->
<button id="refreshPage" title="Refresh Page"
    class="fixed bottom-20 right-5 p-3 bg-blue-600 text-white rounded-full shadow-lg hover:bg-blue-700 transition duration-300"
    onclick="refreshPage()">
    <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
        height="24" fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M17.651 7.65a7.131 7.131 0 0 0-12.68 3.15M18.001 4v4h-4m-7.652 8.35a7.13 7.13 0 0 0 12.68-3.15M6 20v-4h4" />
    </svg>
</button>

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
    document.addEventListener("DOMContentLoaded", function () {
        // Fungsi untuk menggulir ke elemen terakhir dalam daftar pesan
        function scrollToBottom() {
            const messageContainer = document.getElementById('message-container');
            if (messageContainer) {
                messageContainer.scrollTop = messageContainer.scrollHeight;
            }
        }

        scrollToBottom(); // Pastikan scroll terjadi setelah halaman dimuat

        // Event listener untuk tombol scroll manual
        document.getElementById('scrollToBottom').addEventListener('click', function () {
            const messageContainer = document.getElementById('message-container');
            if (messageContainer) {
                messageContainer.scrollTop = messageContainer.scrollHeight;
            }
        });
    });

    function refreshPage() {
        location.reload(); // Memuat ulang halaman
    }
</script>
@endsection