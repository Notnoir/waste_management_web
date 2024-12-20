<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feedback extends Model
{
    use HasFactory;

    // Nama tabel (jika tidak menggunakan konvensi default)
    protected $table = 'feedback';

    // Gunakan UUID sebagai primary key
    public $incrementing = false;
    protected $keyType = 'string';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'id',
        'user_id',
        'schedule_id',
        'rating',
        'comments',
    ];

    // Relasi ke tabel Users
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke tabel Schedules (opsional, feedback bisa tanpa schedule_id)
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
