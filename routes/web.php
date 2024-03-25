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

Route::get('/login', function () {
    if (Auth::check()) {
        return redirect(Auth::user()->role . "/dashboard"); // Or another route name
    }
    return view('guest.login');
});

Route::get('/register', function () {
    return view('guest.register');
});

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/verify-email/{id}', [AuthController::class, 'verify_email'])->name('verify_email');
Route::post('/verify-email', [AuthController::class, 'verify_email'])->name('verify_email');
Route::get('/resend-otp/{id}', [AuthController::class, 'resend_otp'])->name('verify_email');
Route::get('/reset-password', [AuthController::class, 'forget_password'])->middleware('guest');
Route::post('/reset-password', [AuthController::class, 'forget_password_verify'])->middleware('guest');
Route::get('/reset-password-form/{email}/{token}', function (string $email, string $token) {
    return view('guest.reset-password', ['token' => $token, 'email' => $email]);
})->middleware('guest');
Route::post('/reset-password/new', [AuthController::class, 'reset_password'])->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('guest.index');
});

Route::resource('/guides', GuestGuideController::class);


// admin routes
Route::group(['prefix' => 'admin', 'middleware' => [Authenticate::class, AdminAuth::class]], function () {
    Route::get('/', function () {
        return redirect('admin/dashboard');
    });

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });

    Route::resource('/guide', GuideController::class);
    Route::get('/guides/pending', [GuideController::class, 'pending']);
    Route::get('/guide/{id}/verify', [GuideController::class, 'verify']);
    Route::get('/guide/{id}/{status}', [GuideController::class, 'update_status']);

    Route::get('/tourist', [TouristController::class, 'index']);

    Route::resource('/destination', DestinationController::class);

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
        session()->flash('success', 'Password updated successfully');
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
            return view('guide.dashboard')->with(compact('user', 'profile_completed'));
        } else {
            $profile_completed = true;
            return view('guide.dashboard')->with(compact('guide', 'profile_completed'));
        }
        return view('guide.dashboard');
    });

    Route::post('/update-profile', function (Request $request) {
        $user = Auth::user();

        $national_id = $request->file('national_id');
        $national_id_name = $national_id->getClientOriginalName();
        $national_id->storeAs('public/guides/id/', $national_id_name);

        Guide::create(array_merge($request->all(), ['user_id' => $user->id, 'status' => 'pending', 'national_id' => $national_id_name]));
        session()->flash('success', 'Profile updated successfully wait for admin approval');
        return redirect('guide/dashboard');
    });

    Route::get('/profile', function () {
        $user = Auth::user();
        $guide = Guide::where('user_id', $user->id)->first();
        return view('guide.profile')->with(compact('user', 'guide'));
    });

    Route::post('/profile', function (Request $request) {
        $user = Auth::user();
        $guide = Guide::where('user_id', $user->id)->first();
        // dd($request->all(), $user, $guide);
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

            session()->flash('success', 'Profile updated successfully');
        });
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
            return view('tourist.dashboard')->with(compact('tourist', 'profile_completed'));
        }
        return view('tourist.dashboard');
    });

    Route::post('/update-profile', function (Request $request) {
        $user = Auth::user();

        Tourist::create($request->all() + ['user_id' => $user->id]);
        session()->flash('success', 'Profile updated successfully');
        return redirect('tourist/dashboard');
    });

    Route::get('/profile', function () {
        $user = Auth::user();
        $tourist = Tourist::where('user_id', $user->id)->first();
        // dd($user, $tourist);
        return view('tourist.profile')->with(compact('user', 'tourist'));
    });

    Route::post('/profile', function (Request $request) {
        $user = Auth::user();
        $tourist = Tourist::where('user_id', $user->id)->first();
        // dd($request->all(), $user, $tourist);
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

            session()->flash('success', 'Profile updated successfully');
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
        session()->flash('success', 'Password updated successfully');
        Auth::logout();
        return redirect('/login');
    });
});
