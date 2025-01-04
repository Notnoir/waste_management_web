<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    /**
     * Tabel yang digunakan oleh model ini.
     *
     * @var string
     */
    protected $table = 'notifications';

    /**
     * Primary key menggunakan UUID.
     *
     * @var bool
     */
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * Field yang dapat diisi (fillable) pada model.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'message',
        'type',
        'is_read',
    ];

    /**
     * Default nilai untuk atribut tertentu.
     *
     * @var array
     */
    protected $attributes = [
        'is_read' => false,
    ];

    /**
     * Relasi dengan model User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Tandai notifikasi sebagai dibaca.
     *
     * @return bool
     */
    public function markAsRead()
    {
        $this->is_read = true;
        return $this->save();
    }

    /**
     * Tandai notifikasi sebagai belum dibaca.
     *
     * @return bool
     */
    public function markAsUnread()
    {
        $this->is_read = false;
        return $this->save();
    }

    /**
     * Scope untuk mengambil notifikasi yang belum dibaca.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope untuk mengambil notifikasi berdasarkan tipe.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }
}
