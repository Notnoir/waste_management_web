<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    /**
     * Tampilkan daftar pengguna.
     */
    public function index(Request $request)
    {
        $search = $request->input('search'); // Ambil input pencarian

        // Query pengguna dengan filter pencarian
        $users = User::when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('role', 'like', "%{$search}%");
        })->orderBy('created_at', 'desc')->paginate(5);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Tampilkan form untuk menambah pengguna.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Simpan pengguna baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string',
            'phone_number' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'region_id' => 'required|exists:regions,id',
        ]);

        // Menyimpan pengguna
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->phone_number = $request->phone_number;
        $user->profile_picture = $request->file('profile_picture') ? $request->file('profile_picture')->store('profile_pictures', 'public') : null;
        $user->region_id = $request->region_id;
        $user->save();

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail pengguna.
     */
    public function show($id)
    {
        $user = User::findOrFail($id); // Cari pengguna berdasarkan ID
        return view('admin.users.show', compact('user'));
    }

    //Update
    public function update(Request $request, User $user)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email|max:255|unique:users,email,' . $user->id, // Validasi email tidak duplikat
            'password' => 'nullable|string|min:8', // password bersifat opsional jika tidak diubah
            'role' => 'required|in:admin,pengelola,warga', // pastikan role yang diterima valid
        ]);

        // Update data user
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Jika password diubah, hash passwordnya
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password')); // Enkripsi password
        }

        $user->role = $request->input('role');

        // Simpan perubahan ke database
        $user->save();

        // Redirect atau kembalikan response sukses
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    /**
     * Hapus pengguna.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
