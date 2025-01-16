<?php

namespace App\Http\Controllers\Admin;

use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Tampilkan profil admin.
     */
    public function show()
    {
        $admin = Auth::user(); // Admin yang sedang login
        return view('admin.profile.show', compact('admin'));
    }

    /**
     * Tampilkan form edit profil admin.
     */
    public function edit()
    {
        $admin = Auth::user();
        $regions = Region::all();
        return view('admin.profile.edit', compact('admin', 'regions'));
    }

    /**
     * Update profil admin.
     */
    public function update(Request $request)
    {
        $admin = Auth::user();

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => ['required', 'email', Rule::unique('users')->ignore($admin->id)],
            'phone_number' => 'nullable|string|max:15',
            'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'current_password' => 'nullable|required_with:new_password|string',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        // Jika admin ingin mengganti password
        if ($request->filled('current_password') && $request->filled('new_password')) {
            if (!Hash::check($request->current_password, $admin->password)) {
                return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
            }
            $admin->password = Hash::make($request->new_password);
        }

        // Update data profil admin
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone_number = $request->phone_number;

        // Update foto profil jika ada
        if ($request->hasFile('profile_picture')) {
            // Hapus foto lama jika ada
            if ($admin->profile_picture) {
                Storage::delete($admin->profile_picture);
            }

            // Simpan foto baru
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $admin->profile_picture = $path;
        }

        $admin->save();

        return redirect()->route('admin.profile.show')->with('success', 'Profil admin berhasil diperbarui.');
    }
}
