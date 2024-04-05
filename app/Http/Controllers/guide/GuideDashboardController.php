<?php

namespace App\Http\Controllers\guide;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Guide;
use App\Models\Language;
use App\Models\Booking;
use App\Models\GuideReview;
use App\Models\Tourist;
use App\Models\Message;


class GuideDashboardController extends Controller
{
    public function index()
    {

        $user = Auth::user();
        $guide = Guide::where('user_id', $user->id)->first();
        if (!$guide) {
            $profile_completed = false;
            $languages = Language::all();
            return view('guide.dashboard')->with(compact('user', 'languages', 'profile_completed'));
        } else {
            $profile_completed = true;

            $total_transactions_this_month = Booking::join('transactions', 'bookings.id', '=', 'transactions.booking_id')
                ->where('bookings.guide_id', $guide->id)
                ->whereMonth('bookings.created_at', date('m'))
                ->where('status', 'completed')
                ->sum('transactions.amount');

            $total_tourists_served_this_month = Booking::where('guide_id', $guide->id)->whereMonth('created_at', date('m'))->count();
            $total_reviews = GuideReview::where('guide_id', $guide->id)->count();

            $recent_bookings = Booking::with('guide', 'tourist', 'transactions')->where('guide_id', $guide->id)->latest()->limit(5)->get();
            $recent_reviews = GuideReview::with('tourist')->where('guide_id', $guide->id)->latest()->limit(5)->get();

            $data = compact('guide', 'profile_completed', 'total_transactions_this_month', 'recent_bookings', 'recent_reviews', 'total_tourists_served_this_month', 'total_reviews');

            return view('guide.dashboard')->with($data);
        }
        return view('guide.dashboard');
    }

    public function bookings()
    {
        $user_id = Auth::user()->id;
        $guide = guide::with('user')->where('user_id', $user_id)->first();
        $bookings = Booking::with('guide', 'tourist')->where('guide_id', $guide->id)->latest()->get();
        return view('guide.bookings', compact('bookings'));
    }

    public function reviews()
    {
        $user_id = Auth::user()->id;
        $guide = Guide::with('user')->where('user_id', $user_id)->first();
        $reviews = $guide->reviews;
        return view('components.reviews', compact('reviews'));
    }

    public function message($id = null)
    {
        $user = Auth::user();
        $guide = Guide::where('user_id', $user->id)->first();

        // $clients = Tourist::with('user')->get();
        $clients = Tourist::with('user', 'bookings')
            ->whereHas('bookings', function ($query) use ($guide) {
                $query->where('guide_id', $guide->id);
            })
            ->get();
        if (count($clients) == 0) {
            return view('guide.messages');
        }
        $messages = Message::where(function ($query) use ($clients) {
            $query->where('sender_id', $clients[0]->user->id)
                ->Where('receiver_id', Auth::user()->id);
        })->orWhere(function ($query) use ($clients) {
            $query->where('sender_id', Auth::user()->id)
                ->orWhere('receiver_id', $clients[0]->id);
        })->get();

        $receiver_id = $clients[0]->user->id;
        if ($id) {
            $receiver_id = $id;
            $messages = Message::where(function ($query) use ($id) {
                $query->where('sender_id', $id)
                    ->Where('receiver_id', Auth::user()->id);
            })->orWhere(function ($query) use ($id) {
                $query->where('sender_id', Auth::user()->id)
                    ->Where('receiver_id', $id);
            })->get();
            $receiver = Tourist::where('user_id', $id)->first();
            return view('guide.messages')->with(compact('clients', 'messages', 'receiver', 'receiver_id'));
        }


        return view('guide.messages')->with(compact('clients', 'messages', 'receiver_id'));
    }
}
