<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guide;
use App\Models\Tourist;
use App\Models\Destination;
use App\Models\GuideReview;

class DashboardController extends Controller
{
    public function index()
    {
        $total_guides = Guide::count();
        $total_tourists = Tourist::count();
        $total_destinations = Destination::count();
        $new_destinations = Destination::limit(5)->latest()->get();
        $new_guides = Guide::with('user')->limit(5)->latest()->get();
        $data = compact('total_guides', 'total_tourists', 'total_destinations', 'new_destinations', 'new_guides');
        return view('admin.dashboard')->with($data);
    }

    public function reviews()
    {
        $reviews = GuideReview::with('guide', 'tourist')->latest()->get();
        return view('components.reviews', compact('reviews'));
    }
}
