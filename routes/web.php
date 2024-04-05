<?php

use App\Http\Controllers\admin\GuideController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\Authenticate;
use App\Http\Controllers\guest\GuideController as GuestGuideController;
use App\Http\Controllers\admin\TouristController;
use App\Http\Controllers\admin\DestinationController;
use App\Http\Controllers\admin\BookingController;
use App\Http\Controllers\admin\LanguageController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\guest\DestinationController as GuestDestinationController;
use App\Http\Controllers\guest\HomeController;
use App\Http\Controllers\admin\ProfileController as AdminProfileController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\guide\GuideProfileController;
use App\Http\Controllers\guide\GuideDashboardController;
use App\Http\Controllers\tourist\TouristDashboardController;
use App\Http\Controllers\tourist\TouristProfileController;

// guest routes

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

    Route::get('/dashboard', [AdminDashboardController::class, 'index']);
    Route::resource('/guide', GuideController::class);
    Route::get('/guides/pending', [GuideController::class, 'pending']);
    Route::get('/guide/{id}/verify', [GuideController::class, 'verify']);
    Route::get('/guide/{id}/{status}', [GuideController::class, 'update_status']);
    Route::get('/tourist', [TouristController::class, 'index']);
    Route::resource('/destinations', DestinationController::class);
    Route::resource('/language', LanguageController::class);
    Route::get('/reviews', [AdminDashboardController::class, 'reviews']);
    Route::get('/bookings', [BookingController::class, 'index']);
    Route::get('/update-password', [AdminProfileController::class, 'change_password_form']);
    Route::post('/update-password', [AdminProfileController::class, 'update_password']);
});


// guide routes
Route::group(['prefix' => 'guide', 'middleware' => [Authenticate::class]], function () {
    Route::get('/', function () {
        return redirect('guide/dashboard');
    });

    Route::get('/dashboard', [GuideDashboardController::class, 'index']);
    Route::get('/bookings', [GuideDashboardController::class, 'bookings']);
    Route::get('/booking/{id}/cancel', [BookingController::class, 'cancel_booking']);
    Route::get('/booking/{id}/accept', [BookingController::class, 'accept_booking']);
    Route::get('/booking/{id}/completed', [BookingController::class, 'completed_booking']);
    Route::get('/reviews', [GuideDashboardController::class, 'reviews']);
    Route::get('/messages/{id?}', [GuideDashboardController::class, 'message']);
    Route::post('/update-profile', [GuideProfileController::class, 'complete_profile']);
    Route::get('/profile', [GuideProfileController::class, 'show_profile']);
    Route::post('/profile', [GuideProfileController::class, 'update_profile']);
    Route::get('/update-password', [GuideProfileController::class, 'change_password_form']);
    Route::post('/update-password', [GuideProfileController::class, 'update_password']);
});


// tourist routes
Route::group(['prefix' => 'tourist', 'middleware' => [Authenticate::class]], function () {
    Route::get('/', function () {
        return redirect('tourist/dashboard');
    });

    Route::get('/dashboard', [TouristDashboardController::class, 'index']);
    Route::get('/bookings', [TouristDashboardController::class, 'bookings']);
    Route::get('/booking/{id}/cancel', [BookingController::class, 'cancel_booking']);
    Route::get('/booking/{id}/completed', [BookingController::class, 'completed_booking']);
    Route::get('/reviews', [TouristDashboardController::class, 'reviews']);
    Route::get('/messages/{id?}', [TouristDashboardController::class, 'messages']);
    Route::post('/message', [TouristDashboardController::class, 'send_message']);
    Route::post('/update-profile', [TouristProfileController::class, 'complete_profile']);
    Route::get('/profile', [TouristProfileController::class, 'show_profile']);
    Route::post('/profile', [TouristProfileController::class, 'update_profile']);
    Route::get('/update-password', [TouristProfileController::class, 'change_password_form']);
    Route::post('/update-password', [TouristProfileController::class, 'update_password']);
    Route::get('/payment/{id?}', [TouristDashboardController::class, 'payment']);
});

Route::get('/payment/stripe', [StripePaymentController::class, 'payment']);
Route::post('/payment/stripe', [StripePaymentController::class, 'payment']);
Route::get('/payment/stripe/success', [StripePaymentController::class, 'success']);
Route::get('/payment/stripe/cancel', [StripePaymentController::class, 'cancel']);
