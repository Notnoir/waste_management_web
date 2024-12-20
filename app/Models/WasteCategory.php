<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteCategory extends Model
{
    use HasFactory;

    // Menentukan primary key berupa UUID
    protected $keyType = 'string';
    public $incrementing = false;

    // Kolom yang bisa diisi secara mass-assignment
    protected $fillable = [
        'id',        // UUID
        'name',      // Nama kategori
        'description' // Deskripsi kategori
    ];

    // Relasi: WasteCategory memiliki banyak Waste
    public function wastes()
    {
        return $this->hasMany(Waste::class, 'category_id');
    }
}
