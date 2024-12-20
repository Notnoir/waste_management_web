<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chat extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'type'
    ];

    /**
     * Relasi ke tabel `ChatMember` (anggota chat).
     */
    public function members()
    {
        return $this->hasMany(ChatMember::class);
    }

    /**
     * Relasi ke tabel `Message` (pesan dalam chat).
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
