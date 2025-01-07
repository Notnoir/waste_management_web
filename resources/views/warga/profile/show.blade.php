@extends('layouts.main_warga')

@section('content')
<div class="container mx-auto mt-8 px-6">
    <!-- Profile Header -->
    <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-6">
        <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : 'https://via.placeholder.com/150' }}"
            alt="Profile Picture" class="w-32 h-32 rounded-full object-cover shadow-lg" />
        <div>
            <h2 class="text-3xl font-semibold text-gray-700">{{ $user->name }}</h2>
            <p class="text-gray-500">Role: {{ ucfirst($user->role) }}</p>
            <p class="text-gray-500">Terdaftar sejak: {{ $user->created_at->format('d F Y') }}</p>
        </div>
    </div>

    <!-- Profile Details -->
    <div class="bg-white p-6 rounded-lg shadow-md mt-6">
        <h3 class="text-2xl font-semibold text-gray-700 mb-4">Detail Profil</h3>
        <div class="space-y-4">
            <!-- Name -->
            <div>
                <p class="text-gray-600 font-medium">Nama Lengkap</p>
                <p class="text-gray-800">{{ $user->name }}</p>
            </div>

            <!-- Email -->
            <div>
                <p class="text-gray-600 font-medium">Email</p>
                <p class="text-gray-800">{{ $user->email }}</p>
            </div>

            <!-- Phone -->
            <div>
                <p class="text-gray-600 font-medium">Nomor Telepon</p>
                <p class="text-gray-800">{{ $user->phone_number ?? '-' }}</p>
            </div>

            <!-- Region -->
            <div>
                <p class="text-gray-600 font-medium">Wilayah</p>
                <p class="text-gray-800">{{ $user->region ? $user->region->name : 'Belum dipilih' }}</p>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('warga.profile.edit') }}"
                    class="bg-yellow-300 hover:bg-yellow-400 text-white font-medium px-6 py-2 rounded-lg shadow-md">
                    Edit
                </a>
            </div>
        </div>
    </div>
</div>
@endsection