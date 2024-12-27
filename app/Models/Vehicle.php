<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory;

    /**
     * The primary key type is UUID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The primary key is not auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        // 'id',
        'name',
        'license_plate',
        'capacity',
        'status',
    ];

    // Mengatur kolom 'id' menggunakan UUID
    public static function boot()
    {
        parent::boot();

        static::creating(function ($vehicle) {
            $vehicle->id = (string) Str::uuid(); // Menghasilkan UUID
        });
    }

    /**
     * Relationships to `pickup_assignments`.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pickupAssignments()
    {
        return $this->hasMany(PickupAssignment::class);
    }
}
