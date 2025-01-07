<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasUuids, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',              // UUID
        'name',
        'email',
        'password',
        'role',
        'phone_number',
        'profile_picture',
        'balance',
        'region_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relasi ke tabel `Region`.
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Relasi ke tabel `Chats` melalui `ChatMembers`.
     */
    public function chats()
    {
        return $this->belongsToMany(Chat::class, 'chat_members')->withPivot('is_admin');
    }

    /**
     * Relasi ke tabel `Messages`.
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Relasi ke tabel `Schedules`.
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    /**
     * Relasi ke tabel `Transactions`.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Relasi ke tabel `Notifications`.
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * Relasi ke tabel `Feedback`.
     */
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
}
