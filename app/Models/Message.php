<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'chat_id',
        'user_id',
        'message',
        'type',
        'attachment',
        'is_read',
    ];

    /**
     * Relasi ke model Chat (chat tempat pesan dikirim).
     */
    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    /**
     * Relasi ke model User (pengirim pesan).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
