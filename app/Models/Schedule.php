<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory, HasUuids;

    /**
     * Nama tabel yang terkait dengan model ini (opsional, default akan mengikuti nama plural model).
     */
    protected $table = 'schedules';

    /**
     * Primary key menggunakan UUID.
     */
    protected $keyType = 'string'; // UUID adalah string
    public $incrementing = false; // UUID tidak auto increment

    /**
     * Mass assignable attributes (atribut yang dapat diisi secara massal).
     */
    protected $fillable = [
        'user_id',
        'waste_id',
        'pickup_date',
        'quantity',
        'status',
    ];

    /**
     * Default nilai atribut yang tidak secara eksplisit diisi.
     */
    protected $attributes = [
        'status' => 'pending',
    ];

    // Casts
    protected $casts = [
        'pickup_date' => 'date', // Pastikan pickup_date dikonversi ke instance Date/Carbon
    ];

    /**
     * Relasi: Schedule dimiliki oleh satu User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi: Schedule memiliki satu jenis Waste (sampah).
     */
    public function waste()
    {
        return $this->belongsTo(Waste::class);
    }

    /**
     * Relasi: Schedule dapat memiliki banyak feedback.
     */
    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }

    /**
     * Relasi: Schedule dapat memiliki banyak transaksi.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Relasi: Schedule dapat memiliki pickup assignments (penugasan).
     */
    public function pickupAssignments()
    {
        return $this->hasMany(PickupAssignment::class);
    }
}
