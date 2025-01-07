@extends('layouts.main_login')

@section('content')
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
        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf
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
                <div class="relative">
                    <input type="password" id="password" name="password" placeholder="Masukkan password Anda"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none"
                        required />
                    <span id="togglePassword" class="absolute inset-y-0 right-3 flex items-center cursor-pointer">
                        <i class="fas fa-eye text-gray-500"></i>
                    </span>
                </div>
                @error('password')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
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
            <a href="/register" class="text-green-500 hover:underline">Daftar sekarang</a>
        </p>
    </div>
</div>

<!-- Script untuk Toggle Password -->
<script>
    const togglePassword = document.querySelector('#togglePassword');
    const passwordField = document.querySelector('#password');

    togglePassword.addEventListener('click', function () {
        // Toggle the type attribute
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);

        // Toggle the eye icon
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
</script>
@endsection