<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guide extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'national_id',
        'status',
        'languages',
        'avg_rating',
        'rate',
    ];

    public function user()
    {
        return $this->belongsTo(User::class); // Belongs to a User
    }
}
