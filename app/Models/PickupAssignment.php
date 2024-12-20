<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PickupAssignment extends Model
{
    use HasFactory;

    // Menentukan nama tabel (opsional jika nama tabel sesuai konvensi Laravel)
    protected $table = 'pickup_assignments';

    // Primary key menggunakan UUID
    protected $keyType = 'string';
    public $incrementing = false;

    // Atribut yang dapat diisi (fillable)
    protected $fillable = [
        'id',
        'schedule_id',
        'vehicle_id',
        'driver_name',
        'status',
    ];

    // Relasi ke model Schedule
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    // Relasi ke model Vehicle
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
