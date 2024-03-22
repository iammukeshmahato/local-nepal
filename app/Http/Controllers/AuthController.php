<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required | email',
            'password' => 'required',
        ]);

        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            $role = auth()->user()->role;
            if ($role == 'tourist') {
                return redirect('/tourist');
            } else if ($role == 'guide') {
                return redirect('/guide');
            } else if ($role == 'admin') {
                return redirect('/admin');
            } else {
                return redirect('/');
            }
        } else {
            session()->flash('loginError', 'Invalid credentials');
            return redirect('/login');
        }
    }

    public function register(Request $request)
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



        return redirect('/verify-email');
    }

    public function verify_email(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {
            $id = base64_decode($request->user_id);

            $user = User::where('id', $id)->where('verified', 0)->first();

            if ($user == null || $user->otp_count == 0) {
                abort(404);
            }

            if ($user->otp == $request->otp) {
                $user->verified = 1;
                $user->save();
                session()->flash('emailVerified', 'Email verified successfully');
                return redirect('/login');
            } else {
                $user->otp_count = $user->otp_count - 1;
                $user->save();
                session()->flash('error', 'Invalid OTP ' . $user->otp_count . " retry left");
                return redirect('/verify-email/' . $request->user_id);
            }
        }

        $user = User::where('id', base64_decode($id))->where('verified', 0)->first();

        if ($user == null) {
            abort(404);
        }

        if ($user->otp_count == 0) {
            session()->flash('error', 'OTP limit exceeded');
        }

        return view('guest.verify_email')->with('user_id', $id);
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }
}
