@extends('layouts.main_warga')

@section('content')
<div class="container mx-auto mt-8 px-6">
    {{-- flowbite toast --}}
    @if (session()->has('success'))
    <div id="toast-success"
        class="animate__animated animate__bounceInRight fixed top-5 right-5 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
        role="alert">
        <div
            class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
            </svg>
            <span class="sr-only">Check icon</span>
        </div>
        <div class="ms-3 text-sm font-normal">{{session('success')}}</div>
        <button type="button"
            class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
            data-dismiss-target="#toast-success" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>
    @endif

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