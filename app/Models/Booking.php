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

    public function guide()
    {
        return $this->belongsTo(Guide::class);
    }

    public function tourist()
    {
        return $this->belongsTo(Tourist::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
