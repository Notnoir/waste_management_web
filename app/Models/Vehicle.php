<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'id',
        'name',
        'license_plate',
        'capacity',
        'status',
    ];

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
