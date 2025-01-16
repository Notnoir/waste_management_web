<?php

namespace App\Http\Controllers\Pengelola;

use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller

{
    /**
     * Tampilkan profil pengelola.
     */
    public function show()
    {
        $pengelola = Auth::user(); // Pengelola yang sedang login
        return view('pengelola.profile.show', compact('pengelola'));
    }

    /**
     * Tampilkan form edit profil pengelola.
     */
    public function edit()
    {
        $pengelola = Auth::user();
        $regions = Region::all();
        return view('pengelola.profile.edit', compact('pengelola', 'regions'));
    }

    /**
     * Update profil pengelola.
     */
    public function update(Request $request)
    {
        $pengelola = Auth::user();

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => ['required', 'email', Rule::unique('users')->ignore($pengelola->id)],
            'phone_number' => 'nullable|string|max:15',
            'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'current_password' => 'nullable|required_with:new_password|string',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        // Jika pengelola ingin mengganti password
        if ($request->filled('current_password') && $request->filled('new_password')) {
            if (!Hash::check($request->current_password, $pengelola->password)) {
                return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
            }
            $pengelola->password = Hash::make($request->new_password);
        }

        // Update data profil pengelola
        $pengelola->name = $request->name;
        $pengelola->email = $request->email;
        $pengelola->phone_number = $request->phone_number;
        $pengelola->region_id = $request->region_id;

        // Update foto profil jika ada
        if ($request->hasFile('profile_picture')) {
            // Hapus foto lama jika ada
            if ($pengelola->profile_picture) {
                Storage::delete($pengelola->profile_picture);
            }

            // Simpan foto baru
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $pengelola->profile_picture = $path;
        }

        $pengelola->save();

        return redirect()->route('pengelola.profile.show')->with('success', 'Profil pengelola berhasil diperbarui.');
    }
}

