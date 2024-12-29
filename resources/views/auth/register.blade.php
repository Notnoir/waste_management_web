@extends('layouts.main_login')

@section('content')
<!-- Container Utama -->
<div class="flex bg-white rounded-lg shadow-lg overflow-hidden w-full max-w-3xl">
    <!-- Bagian Gambar -->
    <div class="hidden md:block md:w-1/2">
        <img src="/img/register.png" alt="Register Image" class="w-full h-full object-cover" />
    </div>

    <!-- Bagian Form Register -->
    <div class="w-full md:w-1/2 p-8">
        <!-- Logo atau Judul -->
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-700">Daftar</h1>
            <p class="text-gray-500 mt-2">Buat akun baru Anda</p>
        </div>

        <!-- Form Register -->
        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf
            <!-- Input Nama Lengkap -->
            <div>
                <label for="name" class="block text-gray-700 font-medium mb-2">Nama Lengkap</label>
                <input type="text" id="name" name="name" placeholder="Masukkan nama lengkap Anda"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none"
                    required />
                @error('name')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Input Email -->
            <div>
                <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                <input type="email" id="email" name="email" placeholder="Masukkan email Anda"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none"
                    required />
                @error('email')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Input Password -->
            <div>
                <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                <input type="password" id="password" name="password" placeholder="Buat password"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none"
                    required />
                @error('password')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Input Konfirmasi Password -->
            <div>
                <label for="password_confirmation" class="block text-gray-700 font-medium mb-2">Konfirmasi
                    Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    placeholder="Ulangi password Anda"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none"
                    required />
                @error('password_confirmation')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tombol Register -->
            <div>
                <button type="submit"
                    class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition duration-300">
                    Daftar
                </button>
            </div>
        </form>

        <!-- Link Login -->
        <p class="text-center text-sm text-gray-600 mt-6">
            Sudah punya akun?
            <a href="/login" class="text-green-500 hover:underline">Masuk di sini</a>
        </p>
    </div>
</div @endsection