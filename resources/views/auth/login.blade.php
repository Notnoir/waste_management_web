@extends('layouts.main_login')

@section('content')
<!-- Container Utama -->
<!-- Container Utama -->
<div class="flex bg-white rounded-lg shadow-lg overflow-hidden w-full max-w-4xl">
    <!-- Bagian Gambar -->
    <div class="hidden md:block md:w-1/2">
        <img src="/img/login.png" alt="Login Image" class="w-full h-full object-cover" />
    </div>

    <!-- Bagian Form Login -->
    <div class="w-full md:w-1/2 p-8">
        <!-- Logo atau Judul -->
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-700">Login</h1>
            <p class="text-gray-500 mt-2">Masuk ke akun Anda</p>
        </div>

        <!-- Form Login -->
        <form action="#" method="POST" class="space-y-6">
            <!-- Input Email -->
            <div>
                <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                <input type="email" id="email" name="email" placeholder="Masukkan email Anda"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none"
                    required />
            </div>

            <!-- Input Password -->
            <div>
                <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password Anda"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none"
                    required />
            </div>

            <!-- Checkbox Remember Me -->
            <div class="flex items-center justify-between">
                <label class="inline-flex items-center">
                    <input type="checkbox" class="form-checkbox text-green-500" />
                    <span class="ml-2 text-gray-600 text-sm">Ingat saya</span>
                </label>
                <a href="#" class="text-sm text-green-500 hover:underline">Lupa password?</a>
            </div>

            <!-- Tombol Login -->
            <div>
                <button type="submit"
                    class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition duration-300">
                    Masuk
                </button>
            </div>
        </form>

        <!-- Link Daftar -->
        <p class="text-center text-sm text-gray-600 mt-6">
            Belum punya akun?
            <a href="/dashboard" class="text-green-500 hover:underline">Daftar sekarang</a>
        </p>
    </div>
</div>
@endsection