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
    Route::get('/guide/{id}/{status}', [GuideController::class, 'update_status']);
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
});
