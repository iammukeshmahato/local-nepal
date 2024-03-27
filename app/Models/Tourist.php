<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tourist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone',
        'nationality'
    ];

    public function user()
    {
        return $this->belongsTo(User::class); // Belongs to a User
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class); // Has many Bookings
    }
}
