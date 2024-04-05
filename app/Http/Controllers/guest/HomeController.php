<?php

namespace App\Http\Controllers\guest;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Guide;
use App\Models\DestinationReview;

class HomeController extends Controller
{
    public function index()
    {
        $destinations = Destination::with('reviews')->withAvg('reviews', 'rating')->orderByDesc('reviews_avg_rating')->limit(10)->get();
        $guides = Guide::with('reviews')->withAvg('reviews', 'rating')->orderByDesc('reviews_avg_rating')->limit(6)->get();
        $reviews = DestinationReview::orderByDesc('rating')->limit(6)->latest()->get();
        return view('guest.index')->with(compact('destinations', 'guides', 'reviews'));
    }
}
