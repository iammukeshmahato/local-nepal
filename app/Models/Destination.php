<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'cover_image', 'location', 'type', 'slug'];

    public function reviews()
    {
        return $this->hasMany(DestinationReview::class);
    }
}
