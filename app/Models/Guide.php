<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
        'location',
        'about'
    ];

    public function user()
    {
        return $this->belongsTo(User::class); // Belongs to a User
    }

    public function reviews()
    {
        return $this->hasMany(GuideReview::class); // Has many GuideReviews
    }
    
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($guide) {
            Storage::delete('public/guides/id/' . $guide->national_id);
        });
    }
}
