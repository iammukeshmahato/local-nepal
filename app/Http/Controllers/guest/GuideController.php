<?php

namespace App\Http\Controllers\guest;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Models\Guide;
use Illuminate\Support\Facades\Auth;
use App\Models\Tourist;
use App\Models\GuideReview;

class GuideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Paginator::useBootstrap();
        $perPage = 6; // Set the number of items per page as needed

        $guides = Guide::with('user')->where('status', 'active')->paginate($perPage);
        return view('guest.guides', compact('guides'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $guide = Guide::with('user', 'reviews')->find(base64_decode($id));
        Paginator::useBootstrap();
        $perPage = 1;
        $guide_reviews = GuideReview::with('tourist')->paginate($perPage);
        // dd($guide_reviews);
        return view('guest.guide_detail', compact('guide', 'guide_reviews'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function book_guide_form(string $id)
    {
        if (!Auth::check() || Auth::user()->role != 'tourist') {
            abort(403, 'Log in as a tourist to book a guide');
            session()->flash('error', 'You need to login to book a guide');
            return redirect('/login');
        }
        $guide = Guide::with('user')->find(base64_decode($id));
        return view('guest.book_guide', compact('guide'));
    }

    public function book_guide(Request $request)
    {
        $user_id = Auth::user()->id;
        $tourist = Tourist::with('user')->where('user_id', $user_id)->first();
        $booking = Booking::create(array_merge($request->all(), ['tourist_id' => $tourist->id]));
        session()->flash('success', 'Booking successful');
        return redirect('/guides/' . base64_encode($booking->guide_id));
    }

    public function review_guide(Request $request, string $id)
    {
        // dd($request->all());

        if (!Auth::check() || Auth::user()->role != 'tourist') {
            abort(403, 'Log in as a tourist to review a guide');
            session()->flash('error', 'You need to login to review a guide');
            return redirect('/login');
        }

        $user_id = Auth::user()->id;
        $tourist = Tourist::with('user')->where('user_id', $user_id)->first();

        $is_booking_completed = Booking::where('guide_id', base64_decode($id))->where('tourist_id', $tourist->id)->where('status', 'completed')->first() ? true : false;
        if (!$is_booking_completed) {
            session()->flash('error', 'You can only review a guide you have booked and completed a tour with');
            return redirect()->back();
        }

        $is_already_reviewed = GuideReview::where('guide_id', base64_decode($id))->where('tourist_id', $tourist->id)->first() ? true : false;
        if ($is_already_reviewed) {
            session()->flash('error', 'You have already reviewed this guide');
            return redirect()->back();
        }

        $guide_review = GuideReview::create(array_merge($request->all(), ['tourist_id' => $tourist->id]));
        session()->flash('success', 'Review submitted successfully');
        return redirect()->back();
    }

    public function delete_guide_review($id)
    {
        $guide_review = GuideReview::find(base64_decode($id));
        $guide_review->delete();
        session()->flash('success', 'Review deleted successfully');
        return redirect()->back();
    }
}
