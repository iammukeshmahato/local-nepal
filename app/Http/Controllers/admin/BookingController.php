<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('guide', 'tourist')->latest()->get();
        return view('admin.bookings', compact('bookings'));
    }

    public function cancel_booking($id)
    {
        $booking = Booking::with('guide', 'tourist')->find($id);
        if ((Auth::user()->role == 'tourist' && $booking->tourist->user->id == Auth::user()->id) || (Auth::user()->role == 'guide' && $booking->guide->user->id == Auth::user()->id)) {
            $booking->status = 'cancelled';
            $booking->save();
            toast('Booking Cancelled', 'success');
        } else {
            abort(403, 'Unauthorized action.');
        }
        return redirect('/' . Auth::user()->role . '/bookings');
    }

    public function accept_booking($id)
    {
        $booking = Booking::with('guide', 'tourist')->find($id);
        if ((Auth::user()->role == 'guide' && $booking->guide->user->id == Auth::user()->id)) {
            $booking->status = 'booked';
            $booking->save();
            toast('Booking Request Accepted', 'success');
        } else {
            abort(403, 'Unauthorized action.');
        }
        return redirect('/' . Auth::user()->role . '/bookings');
    }

    public function completed_booking($id)
    {
        $booking = Booking::with('guide', 'tourist')->find($id);
        if ((Auth::user()->role == 'guide' && $booking->guide->user->id == Auth::user()->id)) {
            $booking->status = 'completed';
            $booking->save();
            toast('Booking Completed', 'success');
        } else {
            abort(403, 'Unauthorized action.',);
        }
        return redirect('/' . Auth::user()->role . '/bookings');
    }
}
