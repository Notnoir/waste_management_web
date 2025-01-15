<?php

// app/Http/Controllers/MessageController.php
namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // Mengirim pesan ke dalam chat tertentu
    public function send(Request $request, $chatId)
    {
        $chat = Chat::findOrFail($chatId);

        // Cek apakah user adalah anggota chat
        if (!$chat->members()->where('user_id', Auth::id())->exists()) {
            return redirect()->route('chats.index')->with('error', 'Anda tidak memiliki akses ke chat ini');
        }

        $request->validate([
            'message' => 'required|string',
        ]);

        // Menyimpan pesan
        $message = Message::create([
            'chat_id' => $chatId,
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        return redirect()->route('chats.show', $chatId)->with('success', 'Pesan berhasil dikirim');
    }

    // Menandai pesan sebagai sudah dibaca
    public function markAsRead($messageId)
    {
        $message = Message::findOrFail($messageId);
        $message->update(['is_read' => true]);

        return back();
    }
}
