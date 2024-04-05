<?php

use App\Http\Controllers\admin\GuideController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\Authenticate;
use App\Models\Guide;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\guest\GuideController as GuestGuideController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Tourist;
use App\Http\Controllers\admin\TouristController;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\admin\DestinationController;
use App\Http\Controllers\admin\BookingController;
use App\Http\Controllers\admin\LanguageController;
use App\Models\Booking;
use App\Models\GuideReview;
use App\Models\Destination;
use App\Models\Message;
use App\Http\Controllers\StripePaymentController;
use App\Models\Language;
use App\Http\Controllers\guest\DestinationController as GuestDestinationController;
use App\Http\Controllers\guest\HomeController;

Route::get('/login', [AuthController::class, 'login_form']);
Route::get('/register', [AuthController::class, 'register_form']);
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/verify-email/{id}', [AuthController::class, 'verify_email'])->name('verify_email');
Route::post('/verify-email', [AuthController::class, 'verify_email'])->name('verify_email');
Route::get('/resend-otp/{id}', [AuthController::class, 'resend_otp'])->name('verify_email');
Route::get('/reset-password', [AuthController::class, 'forget_password'])->middleware('guest');
Route::post('/reset-password', [AuthController::class, 'forget_password_verify'])->middleware('guest');
Route::get('/reset-password-form/{email}/{token}', [AuthController::class, 'set_new_password'])->middleware('guest');
Route::post('/reset-password/new', [AuthController::class, 'reset_password'])->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'index']);

Route::resource('/guides', GuestGuideController::class);
Route::get('/guides/{id}/book', [GuestGuideController::class, 'book_guide_form']);
Route::post('/guides/{id}/book', [GuestGuideController::class, 'book_guide']);
Route::post('/guides/{id}/rate', [GuestGuideController::class, 'review_guide']);
Route::get('/guides/review/{id}/delete', [GuestGuideController::class, 'delete_guide_review']);
Route::get('/destinations', [GuestDestinationController::class, 'index']);
Route::get('/destinations/{slug}', [GuestDestinationController::class, 'show']);
Route::get('/destinations/{slug}/review', [GuestDestinationController::class, 'review_page']);
Route::post('/destinations/{slug}/review', [GuestDestinationController::class, 'post_review']);

// admin routes
Route::group(['prefix' => 'admin', 'middleware' => [Authenticate::class, AdminAuth::class]], function () {
    Route::get('/', function () {
        return redirect('admin/dashboard');
    });

    Route::get('/dashboard', function () {
        $total_guides = Guide::count();
        $total_tourists = Tourist::count();
        $total_destinations = Destination::count();
        $new_destinations = Destination::limit(5)->latest()->get();
        $new_guides = Guide::with('user')->limit(5)->latest()->get();
        $data = compact('total_guides', 'total_tourists', 'total_destinations', 'new_destinations', 'new_guides');
        return view('admin.dashboard')->with($data);
    });

    Route::resource('/guide', GuideController::class);
    Route::get('/guides/pending', [GuideController::class, 'pending']);
    Route::get('/guide/{id}/verify', [GuideController::class, 'verify']);
    Route::get('/guide/{id}/{status}', [GuideController::class, 'update_status']);

    Route::get('/tourist', [TouristController::class, 'index']);

    Route::resource('/destinations', DestinationController::class);
    Route::resource('/language', LanguageController::class);

    Route::get('/reviews', function () {
        $reviews = GuideReview::with('guide', 'tourist')->latest()->get();
        return view('components.reviews', compact('reviews'));
    });

    Route::get('/bookings', [BookingController::class, 'index']);
    Route::get('/update-password', function () {
        return view('admin.update_password');
    });

    Route::post('/update-password', function (Request $request) {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'password' => 'required| confirmed | min:6',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            session()->flash('error', 'Old password is incorrect');
            return redirect('admin/update-password');
        }
        $user = User::find($user->id);
        $user->password = Hash::make($request->password);
        $user->save();
        toast('Password updated successfully', 'success');
        return redirect('/admin/update-password');
    });
});


// guide routes
Route::group(['prefix' => 'guide', 'middleware' => [Authenticate::class]], function () {
    Route::get('/', function () {
        return redirect('guide/dashboard');
    });

    Route::get('/dashboard', function () {

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
    });

    Route::get('/bookings', function () {
        $user_id = Auth::user()->id;
        $guide = guide::with('user')->where('user_id', $user_id)->first();
        $bookings = Booking::with('guide', 'tourist')->where('guide_id', $guide->id)->latest()->get();
        return view('guide.bookings', compact('bookings'));
    });

    Route::get('/booking/{id}/cancel', [BookingController::class, 'cancel_booking']);
    Route::get('/booking/{id}/accept', [BookingController::class, 'accept_booking']);
    Route::get('/booking/{id}/completed', [BookingController::class, 'completed_booking']);

    Route::get('/reviews', function () {
        $user_id = Auth::user()->id;
        $guide = Guide::with('user')->where('user_id', $user_id)->first();
        $reviews = $guide->reviews;
        return view('components.reviews', compact('reviews'));
    });

    Route::get('/messages/{id?}', function ($id = null) {
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
    });

    Route::post('/update-profile', function (Request $request) {
        $user = Auth::user();

        $request->validate([
            'phone' => 'required | digits:10 | min:10 | max:10 | unique:guides,phone| unique:tourists,phone',
            'address' => 'required | string',
            'national_id' => 'required | image',
        ]);

        $national_id = $request->file('national_id');
        $national_id_name = $national_id->getClientOriginalName();
        $national_id->storeAs('public/guides/id/', $national_id_name);

        $guide = Guide::create(array_merge($request->all(), ['user_id' => $user->id, 'status' => 'pending', 'national_id' => $national_id_name]));
        $guide->languages()->attach($request->languages);
        session()->flash('success', 'Profile updated successfully wait for admin approval');
        toast('Profile updated successfully wait for admin approval', 'success');
        return redirect('guide/dashboard');
    });

    Route::get('/profile', function () {
        $user = Auth::user();
        $guide = Guide::with('languages')->where('user_id', $user->id)->first();
        $languages = Language::all();
        return view('guide.profile')->with(compact('user', 'guide', 'languages'));
    });

    Route::post('/profile', function (Request $request) {
        $user = Auth::user();
        $guide = Guide::where('user_id', $user->id)->first();
        DB::transaction(function () use ($request, $user, $guide) {
            $guide->update($request->all());
            $user = User::find($guide->user_id);
            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $avatarName = $avatar->getClientOriginalName();
                $avatar->storeAs('public/profiles/', $avatarName);
                $user->avatar = $avatarName;
            }
            $user->update($request->only('dob'));
            $guide->languages()->sync($request->languages);
            session()->flash('success', 'Profile updated successfully');
            toast('Profile updated successfully', 'success');
        });
        return redirect('/guide/profile');
        return view('guide.profile')->with(compact('user', 'guide'));
    });

    Route::get('/update-password', function () {
        return view('guide.update_password');
    });

    Route::post('/update-password', function (Request $request) {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'password' => 'required| confirmed | min:6',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            session()->flash('error', 'Old password is incorrect');
            return redirect('guide/update-password');
        }
        $user = User::find($user->id);
        $user->password = Hash::make($request->password);
        $user->save();
        session()->flash('success', 'Password updated successfully');
        toast('Password updated successfully', 'success');
        Auth::logout();
        return redirect('/login');
    });
});


// tourist routes
Route::group(['prefix' => 'tourist', 'middleware' => [Authenticate::class]], function () {
    Route::get('/', function () {
        return redirect('tourist/dashboard');
    });

    Route::get('/dashboard', function () {
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
    });

    Route::get('/bookings', function () {
        $user_id = Auth::user()->id;
        $tourist = Tourist::with('user')->where('user_id', $user_id)->first();
        $bookings = Booking::with('guide', 'tourist', 'transactions')->where('tourist_id', $tourist->id)->latest()->get();
        return view('tourist.bookings', compact('bookings'));
    });
    Route::get('/booking/{id}/cancel', [BookingController::class, 'cancel_booking']);
    Route::get('/booking/{id}/completed', [BookingController::class, 'completed_booking']);
    Route::get('/reviews', function () {
        $user_id = Auth::user()->id;
        $tourist = Tourist::with('user')->where('user_id', $user_id)->first();
        $reviews = GuideReview::with('guide')->where('tourist_id', $tourist->id)->get();
        return view('components.reviews', compact('reviews'));
    });

    Route::get('/messages/{id?}', function ($id = null) {
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
                ->Where('receiver_id', $clients[0]->id);
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
    });

    Route::post('/message', function (Request $request) {
        Message::create($request->all());
        $pusher = new Pusher\Pusher("c4511fa24aeddfc52ef2", "29bbb46834eebe7e133d", "1780639", array('cluster' => 'ap2'));

        // channel-name = chat-tourist-guide
        if (Auth::user()->role == 'tourist' && $request->sender_id == Auth::user()->id)
            $channel_name = 'chat-' . $request->sender_id . '-' . $request->receiver_id;
        else
            $channel_name = 'chat-' . $request->receiver_id . '-' . $request->sender_id;
        $pusher->trigger($channel_name, 'message', [
            'message' =>  $request->message
        ]);
        return redirect()->back();
    });

    Route::post('/update-profile', function (Request $request) {
        $user = Auth::user();

        $request->validate([
            'phone' => 'required | digits:10 | min:10 | max:10 | unique:guides,phone| unique:tourists,phone',
            'nationality' => 'required | string',
        ]);

        Tourist::create($request->all() + ['user_id' => $user->id]);
        session()->flash('success', 'Profile updated successfully');
        toast('Profile updated successfully', 'success');
        return redirect('tourist/dashboard');
    });

    Route::get('/profile', function () {
        $user = Auth::user();
        $tourist = Tourist::where('user_id', $user->id)->first();
        return view('tourist.profile')->with(compact('user', 'tourist'));
    });

    Route::post('/profile', function (Request $request) {
        $user = Auth::user();
        $tourist = Tourist::where('user_id', $user->id)->first();
        DB::transaction(function () use ($request, $user, $tourist) {
            $tourist->update($request->all());
            $user = User::find($tourist->user_id);
            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $avatarName = $avatar->getClientOriginalName();
                $avatar->storeAs('public/profiles/', $avatarName);
                $user->avatar = $avatarName;
            }
            $user->update($request->only('dob'));

            toast('Profile updated successfully', 'success');
        });
        return view('tourist.profile')->with(compact('user', 'tourist'));
    });

    Route::get('/update-password', function () {
        return view('tourist.update_password');
    });

    Route::post('/update-password', function (Request $request) {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'password' => 'required| confirmed | min:6',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            session()->flash('error', 'Old password is incorrect');
            return redirect('tourist/update-password');
        }
        $user = User::find($user->id);
        $user->password = Hash::make($request->password);
        $user->save();
        toast('Password updated successfully', 'success');
        Auth::logout();
        return redirect('/login');
    });

    Route::get('/payment/{id?}', function ($id) {
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
    });
});

Route::get('/payment/stripe', [StripePaymentController::class, 'payment']);
Route::post('/payment/stripe', [StripePaymentController::class, 'payment']);
Route::get('/payment/stripe/success', [StripePaymentController::class, 'success']);
Route::get('/payment/stripe/cancel', [StripePaymentController::class, 'cancel']);
