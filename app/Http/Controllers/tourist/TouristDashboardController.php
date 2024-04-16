<?php

namespace App\Http\Controllers\tourist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tourist;
use App\Models\Destination;
use App\Models\Booking;
use App\Models\GuideReview;
use App\Models\Guide;
use App\Models\Message;
use Pusher\Pusher;


class TouristDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tourist = Tourist::where('user_id', $user->id)->first();
        if (!$tourist) {
            $profile_completed = false;
            return view('tourist.dashboard')->with(compact('user', 'profile_completed'));
        } else {
            $profile_completed = true;

            $new_destinations = Destination::limit(5)->latest()->get();
            $recent_bookings = Booking::with('guide', 'tourist', 'transactions')->where('tourist_id', $tourist->id)->latest()->limit(5)->get();
            $total_spent_this_month = Booking::join('transactions', 'bookings.id', '=', 'transactions.booking_id')
                ->where('bookings.tourist_id', $tourist->id)
                ->whereMonth('bookings.created_at', date('m'))
                // ->where('transactions.payment_status', 'paid')
                ->where('status', 'completed')
                ->sum('transactions.amount');

            $destination_travelled = Booking::where('tourist_id', $tourist->id)->where('status', 'completed')->distinct('guide_id')->count();
            $total_reviews = GuideReview::where('tourist_id', $tourist->id)->count();
            $recent_reviews = GuideReview::with('guide')->where('tourist_id', $tourist->id)->latest()->limit(5)->get();

            $data = compact('tourist', 'profile_completed', 'new_destinations', 'recent_bookings', 'total_spent_this_month', 'destination_travelled', 'total_reviews', 'recent_reviews');

            return view('tourist.dashboard')->with($data);
        }
    }

    public function bookings()
    {
        $user_id = Auth::user()->id;
        $tourist = Tourist::with('user')->where('user_id', $user_id)->first();
        $bookings = Booking::with('guide', 'tourist', 'transactions')->where('tourist_id', $tourist->id)->latest()->get();
        return view('tourist.bookings', compact('bookings'));
    }

    public function reviews()
    {
        $user_id = Auth::user()->id;
        $tourist = Tourist::with('user')->where('user_id', $user_id)->first();
        $reviews = GuideReview::with('guide')->where('tourist_id', $tourist->id)->get();
        return view('components.reviews', compact('reviews'));
    }

    public function messages($id = null)
    {
        $user = Auth::user();
        $tourist = Tourist::where('user_id', $user->id)->first();

        // $clients = Guide::with('user', 'bookings')->where('bookings.tourist_id', $tourist->id)->get();
        $clients = Guide::with('user', 'bookings')
            ->whereHas('bookings', function ($query) use ($tourist) {
                $query->where('tourist_id', $tourist->id);
            })
            ->get();

        if (count($clients) == 0) {
            return view('tourist.messages');
        }
        $messages = Message::where(function ($query) use ($clients) {
            $query->where('sender_id', $clients[0]->user->id)
                ->Where('receiver_id', Auth::user()->id);
        })->orWhere(function ($query) use ($clients) {
            $query->where('sender_id', Auth::user()->id)
                ->Where('receiver_id', $clients[0]->user->id);
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
            $receiver = Guide::where('user_id', $id)->first();
            return view('tourist.messages')->with(compact('clients', 'messages', 'receiver', 'receiver_id'));
        }

        return view('tourist.messages')->with(compact('clients', 'messages', 'receiver_id'));
    }

    public function send_message(Request $request)
    {
        Message::create($request->all());
        $pusher = new Pusher("c4511fa24aeddfc52ef2", "29bbb46834eebe7e133d", "1780639", array('cluster' => 'ap2'));

        // channel-name = chat-tourist-guide
        if (Auth::user()->role == 'tourist' && $request->sender_id == Auth::user()->id)
            $channel_name = 'chat-' . $request->sender_id . '-' . $request->receiver_id;
        else
            $channel_name = 'chat-' . $request->receiver_id . '-' . $request->sender_id;
        $pusher->trigger($channel_name, 'message', [
            'message' =>  $request->message
        ]);
        return redirect()->back();
    }

    public function payment($id = null)
    {
        $booking = Booking::with('guide', 'tourist', 'transactions')->where('id', $id)->first();

        if ($booking->tourist->user->id != Auth::user()->id) {
            alert()->error('Error', 'Something Went Wrong');
            return redirect()->back();
        }

        if ($booking->transactions[0]->payment_method == 'cash') {
            $booking->transactions[0]->update(['payment_status' => 'paid']);
            alert()->success('Paid', 'Payment Successful');
            return redirect()->back();
        }

        if ($booking->transactions[0]->payment_method == 'stripe') {
            $total_cost = $booking->transactions[0]->amount;
            session()->put('total_cost', $total_cost);
            session()->put('is_through_booking', true);
            session()->put('transaction_id', $booking->transactions[0]->id);
            return redirect('/payment/stripe');
        }
    }
}
