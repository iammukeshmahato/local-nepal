<?php

namespace App\Http\Controllers\guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Models\Destination;
use Illuminate\Support\Facades\Auth;
use App\Models\DestinationReview;

class DestinationController extends Controller
{
    public function index()
    {
        Paginator::useBootstrap();
        $perPage = 6;
        $destinations = Destination::with('reviews')->withAvg('reviews', 'rating')->paginate($perPage);
        return view('guest.destinations', compact('destinations'));
    }

    public function show(string $slug)
    {

        // Paginator::useBootstrap();
        // $perPage = 10;
        $destination = Destination::with('reviews')->where('slug', $slug)->first();
        // if ($destination) {
        //     $reviews = $destination->reviews()->paginate($perPage);
        //     dd($reviews);
        //     return view('guest.destination_detail', compact('destination', 'reviews'));
        // }
        return view('guest.destination_detail', compact('destination'));
    }

    public function review_page(string $slug)
    {
        $destination = Destination::where('slug', $slug)->first();
        return view('guest.review_destination', compact('destination'));
    }

    public function post_review(Request $request, string $slug)
    {

        if (!Auth::check()) {
            alert()->warning('Login Required', 'Please login to add review');
            return redirect()->back();
        }

        $is_already_reviewed = DestinationReview::where('user_id', Auth::user()->id)->where('destination_id', $request->destination_id)->first() ? true : false;
        if ($is_already_reviewed) {
            alert()->warning('Already Rated', 'You have already rated this place');
            return redirect()->back();
        }

        $destination = Destination::find($request->destination_id);
        $request->validate([
            'rating' => 'required',
            'review' => 'required | string ',
        ]);
        $destination->reviews()->create(array_merge($request->all(), ['user_id' => Auth::user()->id]));
        alert()->success('Review Added', 'Review added successfully');
        return redirect('destinations/' . $slug);
    }
}
