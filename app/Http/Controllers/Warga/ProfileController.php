<?php

namespace App\Http\Controllers\Warga;

use App\Models\User;
use App\Models\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class ProfileController extends Controller
{
    /**
     * Tampilkan detail profil pengguna.
     */
    public function show()
    {
        $user = Auth::user(); // Ambil data pengguna yang sedang login
        return view('warga.profile.show', compact('user'));
    }

    /**
     * Tampilkan halaman edit profil.
     */
    public function edit()
    {
        $user = Auth::user(); // Dapatkan data pengguna yang sedang login
        $regions = Region::all(); // Ambil semua wilayah yang tersedia

        return view('warga.profile.edit', compact('user', 'regions'));
    }

    /**
     * Proses update profil pengguna.
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone_number' => 'nullable|string|max:15',
            'region_id' => 'nullable|exists:regions,id',
            'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', // Maks 2MB
            'current_password' => 'nullable|required_with:new_password|string',
            'new_password' => 'nullable|min:8|confirmed', // Harus cocok dengan new_password_confirmation
        ]);

        // Jika user ingin mengganti password
        if ($request->filled('current_password') && $request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
            }
            $user->password = Hash::make($request->new_password);
        }

        // Update data profil
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->region_id = $request->region_id;

        // Jika ada foto profil baru
        if ($request->hasFile('profile_picture')) {
            // Hapus foto lama jika ada
            if ($user->profile_picture) {
                Storage::delete($user->profile_picture);
            }

            // Simpan foto baru
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }

        $user->save();

        return redirect()->route('warga.profile.show')->with('success', 'Profil berhasil diperbarui.');
    }
}
