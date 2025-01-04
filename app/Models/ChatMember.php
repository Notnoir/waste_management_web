<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChatMember extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'chat_id',
        'user_id',
        'is_admin',
    ];

    /**
     * Relasi ke model Chat.
     */
    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    /**
     * Relasi ke model User (anggota dari chat).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
