<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'guide_id',
        'tourist_id',
        'start_date',
        'end_date',
        'status',
    ];
}
