<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('guest.login');
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
        // dd($request->all());

        $request->validate([
            'name' => 'required | min:3 | regex:/^[a-z A-Z]+$/u',
            'email' => 'required | email | unique:users,email',
            'dob' => 'required | date',
            'avatar' => 'required | image | mimes:jpeg,png,jpg,gif,svg | max:2048',
            'password' => 'required|min:6',
            'role' => 'required | in:tourist,guide',
        ]);

        $avatar = $request->file('avatar');
        $avatarName = $avatar->getClientOriginalName();
        $avatar->storeAs('public/profiles/', $avatarName);

        $otp = rand(100000, 999999);
        User::create(array_merge($request->all(), ['avatar' => $avatarName, 'password' => bcrypt($request->password), 'otp' => $otp]));
        // Mail::to($user->email)->send(new WelcomeEmail($user));

        $emailContent = ["email" => $request->email, 'otp' => $otp];

        // try {
        //     Mail::send("guest.verify_email", ["email" => $request->email, 'otp' => $otp], function ($msg) use ($request) {
        //         $msg->to($request->email)->subject("Verify your email");
        //     });
        //     session()->flash('emailSent', "Email is sent to " . $request->email);

        //     return response()->json(array('msg' => "OTP Sent Successfylly"), 200);
        // } catch (Exception $e) {
        //     session()->flash('emailError', $e);
        //     return response()->json(array('error' => "Can't send OTP"), 404);
        // }

        $data = [
            'otp' => $otp,
        ];

        Mail::to($request->email)->send(new SendEmail($data));


        return redirect('/login');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
}
