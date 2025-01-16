@extends('layouts.main_admin') <!-- Pastikan menggunakan layout admin -->

@section('content')
<div class="container mx-auto mt-8 px-6">
    <!-- Profile Header -->
    <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-6">
        <img id="profile-picture-preview"
            src="{{ $admin->profile_picture ? asset('storage/' . $admin->profile_picture) : 'https://via.placeholder.com/150' }}"
            alt="Profile Picture" class="w-32 h-32 rounded-full object-cover border-4 border-blue-500 shadow-lg" />
        <div>
            <h2 class="text-3xl font-semibold text-gray-700">{{ $admin->name }}</h2>
            <p class="text-gray-500">Role: Admin</p>
            <p class="text-gray-500">Terdaftar sejak: {{ $admin->created_at->format('d F Y') }}</p>
        </div>
    </div>

    <!-- Form Edit Profile -->
    <div class="bg-white p-6 rounded-lg shadow-md mt-6">
        <h3 class="text-2xl font-semibold text-gray-700 mb-4">Edit Profil</h3>
        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data"
            class="space-y-4">
            @csrf
            @method('POST')

            <!-- Name -->
            <div>
                <label for="name" class="block text-gray-600 font-medium mb-1">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="{{ old('name', $admin->name) }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-gray-600 font-medium mb-1">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $admin->email) }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <!-- Phone -->
            <div>
                <label for="phone_number" class="block text-gray-600 font-medium mb-1">Nomor Telepon</label>
                <input type="text" id="phone_number" name="phone_number"
                    value="{{ old('phone_number', $admin->phone_number) }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <!-- Region -->
            <div>
                <label for="region_id" class="block text-gray-600 font-medium mb-1">Wilayah</label>
                <select id="region_id" name="region_id"
                    class="w-full border-gray-300 rounded-lg shadow-sm p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Pilih Wilayah</option>
                    @foreach ($regions as $region)
                    <option value="{{ $region->id }}" {{ old('region_id', $admin->region_id) == $region->id ? 'selected'
                        : '' }}>
                        {{ $region->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Profile Picture -->
            <div>
                <label for="profile_picture" class="block text-gray-600 font-medium mb-1">Foto Profil</label>
                <input type="file" id="profile_picture" name="profile_picture"
                    class="w-full border-gray-300 rounded-lg shadow-sm p-2" onchange="previewProfilePicture(event)" />
            </div>

            <!-- Edit Password -->
            <div class="mt-8 border-t pt-6">
                <h3 class="text-2xl font-semibold text-gray-700 mb-4">Edit Password</h3>

                <!-- Old Password -->
                <div>
                    <label for="current_password" class="block text-gray-600 font-medium mb-1">Password Lama</label>
                    <input type="password" id="current_password" name="current_password"
                        class="w-full border-gray-300 rounded-lg shadow-sm p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>

                <!-- New Password -->
                <div>
                    <label for="new_password" class="block text-gray-600 font-medium mb-1">Password Baru</label>
                    <input type="password" id="new_password" name="new_password"
                        class="w-full border-gray-300 rounded-lg shadow-sm p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>

                <!-- Confirm New Password -->
                <div>
                    <label for="new_password_confirmation" class="block text-gray-600 font-medium mb-1">Konfirmasi
                        Password Baru</label>
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                        class="w-full border-gray-300 rounded-lg shadow-sm p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
            </div>

            <!-- Save Button -->
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2 rounded-lg shadow-md">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewProfilePicture(event) {
        const input = event.target;
        const preview = document.getElementById('profile-picture-preview');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
