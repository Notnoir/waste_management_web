<?php

// app/Http/Controllers/ChatController.php
namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Models\Message;
use App\Models\ChatMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    // Menampilkan semua chat yang dimiliki oleh user
    public function index()
    {
        $chats = Auth::user()->chats; // Mendapatkan semua chat yang dimiliki oleh user
        return view('chats.index', compact('chats'));
    }

    // Membuat chat baru (baik personal atau grup)
    public function create()
    {
        return view('chats.create');
    }

    // Menyimpan chat baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required_if:type,group',
            'type' => 'required|in:personal,group',
        ]);

        // Membuat chat baru
        $chat = Chat::create([
            'name' => $request->name,
            'type' => $request->type,
        ]);

        // Menambahkan user sebagai anggota chat (admin untuk grup)
        ChatMember::create([
            'chat_id' => $chat->id,
            'user_id' => Auth::id(),
            'is_admin' => true,
        ]);

        return redirect()->route('chats.index')->with('success', 'Chat berhasil dibuat');
    }

    // Menampilkan halaman detail chat
    public function show($chatId)
    {
        $chat = Chat::with('messages.user')->findOrFail($chatId);

        // Cek apakah user adalah anggota chat
        if (!$chat->members()->where('user_id', Auth::id())->exists()) {
            return redirect()->route('chats.index')->with('error', 'Anda tidak memiliki akses ke chat ini');
        }

        return view('chats.show', compact('chat'));
    }

    public function addMember(Request $request, $chatId)
    {
        // Validasi apakah ID pengguna yang dimasukkan ada
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        // Cek apakah chat yang dimaksud ada
        $chat = Chat::findOrFail($chatId);

        // Ambil pengguna berdasarkan user_id
        $user = User::findOrFail($request->user_id);

        // Cek apakah pengguna sudah menjadi anggota chat
        if ($chat->members()->where('user_id', $user->id)->exists()) {
            return redirect()->back()->with('error', 'Pengguna sudah menjadi anggota chat ini.');
        }

        // Menambahkan anggota baru ke chat
        ChatMember::create([
            'chat_id' => $chat->id,
            'user_id' => $user->id,
            'is_admin' => false, // Anda bisa menambahkan admin flag sesuai kebutuhan
        ]);

        return redirect()->route('chats.show', $chat->id)->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function sendMessage(Request $request, $chatId)
    {
        // Validasi pesan
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        // Cek apakah chat yang dimaksud ada
        $chat = Chat::findOrFail($chatId);

        // Membuat pesan baru
        $message = new Message();
        $message->chat_id = $chat->id;
        $message->user_id = Auth::id(); // Pengirim pesan adalah pengguna yang sedang login
        $message->message = $request->message;

        // Menyimpan pesan ke database
        $message->save();

        // Mengembalikan respons dalam format JSON
        return response()->json([
            'id' => $message->id,
            'message' => $message->message,
            'user_name' => $message->user->name,
            'created_at' => $message->created_at->diffForHumans(),
        ]);
    }
}
