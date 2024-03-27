<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationReview extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'destination_id', 'rating', 'review'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
