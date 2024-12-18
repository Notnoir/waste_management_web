@extends('layouts.main_warga')

@section('content')
<div class="container mx-auto mt-8 px-6">
    <!-- Profile Header -->
    <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-6">
        <img src="https://via.placeholder.com/150" alt="Profile Picture"
            class="w-32 h-32 rounded-full object-cover border-4 border-green-500 shadow-lg" />
        <div>
            <h2 class="text-3xl font-semibold text-gray-700">Nama Pengguna</h2>
            <p class="text-gray-500">Role: Warga</p>
            <p class="text-gray-500">Terdaftar sejak: 10 Januari 2024</p>
        </div>
    </div>

    <!-- Form Edit Profile -->
    <div class="bg-white p-6 rounded-lg shadow-md mt-6">
        <h3 class="text-2xl font-semibold text-gray-700 mb-4">Edit Profil</h3>
        <form action="#" method="POST" enctype="multipart/form-data" class="space-y-4">
            <!-- Name -->
            <div>
                <label for="name" class="block text-gray-600 font-medium mb-1">Nama Lengkap</label>
                <input type="text" id="name" name="name" placeholder="Masukkan nama lengkap"
                    class="w-full border-gray-300 rounded-lg shadow-sm p-2 focus:outline-none focus:ring-2 focus:ring-green-500" />
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-gray-600 font-medium mb-1">Email</label>
                <input type="email" id="email" name="email" placeholder="Masukkan email"
                    class="w-full border-gray-300 rounded-lg shadow-sm p-2 focus:outline-none focus:ring-2 focus:ring-green-500" />
            </div>

            <!-- Phone -->
            <div>
                <label for="phone" class="block text-gray-600 font-medium mb-1">Nomor Telepon</label>
                <input type="text" id="phone" name="phone" placeholder="Masukkan nomor telepon"
                    class="w-full border-gray-300 rounded-lg shadow-sm p-2 focus:outline-none focus:ring-2 focus:ring-green-500" />
            </div>

            <!-- Region -->
            <div>
                <label for="region" class="block text-gray-600 font-medium mb-1">Region</label>
                <select id="region" name="region"
                    class="w-full border-gray-300 rounded-lg shadow-sm p-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="">Pilih Region</option>
                    <option value="Jakarta">Jakarta</option>
                    <option value="Bandung">Bandung</option>
                    <option value="Surabaya">Surabaya</option>
                </select>
            </div>

            <!-- Profile Picture -->
            <div>
                <label for="profile_picture" class="block text-gray-600 font-medium mb-1">Foto Profil</label>
                <input type="file" id="profile_picture" name="profile_picture"
                    class="w-full border-gray-300 rounded-lg shadow-sm p-2" />
            </div>

            <!-- Save Button -->
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-medium px-6 py-2 rounded-lg shadow-md">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection