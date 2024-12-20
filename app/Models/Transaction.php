<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Transaction extends Model
{
    use HasFactory;

    /**
     * Kolom yang akan di-cast ke tipe data tertentu.
     *
     * @var array
     */
    protected $casts = [
        'amount' => 'decimal:2',
    ];

    /**
     * Kolom yang dapat diisi secara massal.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'schedule_id',
        'amount',
        'status',
        'payment_method',
    ];

    /**
     * Boot model untuk menggunakan UUID sebagai primary key.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = (string) Str::uuid(); // Buat UUID otomatis
            }
        });
    }

    /**
     * Relasi ke model `User` (One-to-Many).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke model `Schedule` (One-to-Many).
     */
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
