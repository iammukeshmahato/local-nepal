<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Models\Booking;
use App\Models\Tourist;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

class StripePaymentController extends Controller
{
    public function stripe(Request $request)
    {
        $guide_id = $request->guide_id;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $total_cost = $request->total_cost;
        $data = compact('guide_id', 'start_date', 'end_date', 'total_cost');
        return view('guest/stripe')->with($data);
    }

    public function payment(Request $request)
    {
        if (session('is_through_booking') !== null && session('is_through_booking') == true) {
            $total_cost = session('total_cost');
        } else {
            $total_cost = $request->total_cost;
        }
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $session = \Stripe\Checkout\Session::create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Guide Payment',
                    ],
                    'unit_amount' => $total_cost * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => url('/payment/stripe/success') . "?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => url('/payment/stripe/cancel'),
        ]);


        if (session('is_through_booking') !== null && session('is_through_booking') == true) {
            $transaction_id = session('transaction_id');
            $transaction = Transaction::where('id', $transaction_id)->first();
            $transaction->update([
                'session_id' => $session->id,
            ]);

            // session()->forget('is_through_booking');
            session()->forget('total_cost');
            session()->forget('transaction_id');
            return redirect($session->url);
        } else {
            $user_id = Auth::user()->id;
            $tourist = Tourist::with('user')->where('user_id', $user_id)->first();
            $booking = Booking::create(array_merge($request->all(), ['tourist_id' => $tourist->id]));

            $booking->transactions()->create([
                'booking_id' => $booking->id,
                'session_id' => $session->id,
                'amount' => $request->total_cost,
                'payment_method' => 'stripe',
                'payment_status' => 'unpaid',
            ]);
            alert()->success('Booked', 'Booking Successful');
            return redirect()->back();
        }
    }

    public function success(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $sessionId = $request->get('session_id');

        $session = \Stripe\Checkout\Session::retrieve($sessionId);

        try {
            if (!$session) {
                throw new NotFoundHttpException;
            }
            $transaction = Transaction::where('session_id', $sessionId)->first();
            $transaction->update([
                'payment_status' => 'paid',
            ]);
        } catch (\Exception $e) {
            throw new NotFoundHttpException();
        }

        if (session('is_through_booking') !== null) {
            alert()->success('Paid', 'Payment Successful');
            return redirect('/tourist/bookings');
        }

        session()->flash('success', 'Booking successful');
        return redirect('/guides/' . base64_encode($transaction->booking->guide_id));
    }

    public function cancel(Request $request)
    {
        dd($request->all());
        return view('guest/stripe-cancel');
    }
}
