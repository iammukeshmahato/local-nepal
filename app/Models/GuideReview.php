<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuideReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'guide_id',
        'tourist_id',
        'rating',
        'review',
    ];

    public function guide()
    {
        return $this->belongsTo(Guide::class); // Belongs to a Guide
    }

    public function tourist()
    {
        return $this->belongsTo(Tourist::class); // Belongs to a Tourist
    }
}
