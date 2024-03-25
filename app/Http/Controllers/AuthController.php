<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required | email',
            'password' => 'required',
        ]);

        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {


            $user = auth()->user();
            if (!$user->verified)
                return redirect('/verify-email' . '/' . base64_encode($user->id));

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
        $user = User::create(array_merge($request->all(), ['avatar' => $avatarName, 'password' => bcrypt($request->password), 'otp' => $otp, 'otp_resend_time' => date(now())]));
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

        return redirect('/verify-email' . '/' . base64_encode($user->id));
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
                $user->email_verified_at = date(now());
                $user->save();
                session()->flash('emailVerified', 'Email verified successfully');

                Auth::login($user);

                $url = "/$user->role/";
                return redirect($url);
            } else {
                $otp_time = Carbon::parse($user->otp_resend_time);
                $user->otp_count = $user->otp_count - 1;
                $user->otp_resend_time = $otp_time;
                $user->save();
                session()->flash('error', 'Invalid OTP ' . $user->otp_count . " retry left");

                $diff = abs(Carbon::parse($user->otp_resend_time)->diffInMinutes(now()));
                if ($diff < 2) {
                    $user_id = $id;
                    $wait = $diff;
                    $data = compact('user_id', 'wait');
                    return redirect('/verify-email/' . $request->user_id)->with($data);
                }
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

        $diff = abs(Carbon::parse($user->otp_resend_time)->diffInMinutes(now()));
        if ($diff < 2) {
            $user_id = $id;
            $wait = $diff;
            $data = compact('user_id', 'wait');
            return view('guest.verify_email')->with($data);
        }

        return view('guest.verify_email')->with('user_id', $id);
    }

    public function resend_otp(Request $request, $id)
    {
        $user = User::find(base64_decode($id));
        $diff = abs(Carbon::parse($user->otp_resend_time)->diffInMinutes(now()));
        if ($diff > 0) {
            $otp = rand(100000, 999999);
            $user->otp = $otp;
            $user->otp_count = 3;
            $user->otp_resend_time = date(now());
            $user->save();
            $data = [
                'otp' => $otp,
            ];

            Mail::to($user->email)->send(new SendEmail($data));
        } else {
            session()->flash('error', "OTP can't be sent now. Please try after few minutes");
        }
        return redirect('/verify-email' . '/' . $id);
    }

    public function forget_password(Request $request)
    {
        return view('guest.forget_password');
    }

    public function forget_password_verify(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();
        if ($user == null) {
            session()->flash('error', 'Sorry, we can\'t find a user with that email address.');
            return back();
        }

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            session()->flash('success', 'We have emailed your password reset link!');
        } else {
            session()->flash('error', 'Sorry, we can\'t send reset password link to this email address.');
        }

        return back();
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => 'Rest password link sent to your email address.'])
            : back()->withErrors(['email' => 'Sorry, we can\'t send reset password link to this email address.']);
    }

    public function reset_password_form($token)
    {
        return view('guest.reset-password', ['token' => $token]);
    }

    public function reset_password(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
            'token' => 'required',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->save();
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            session()->flash('success', 'Password reset successfully');
        } else {
            session()->flash('error', 'Invalid token or email');
        }
        return redirect('/login');
        return $status == Password::PASSWORD_RESET
            ?
            redirect('/login')->with('success', 'Password reset successfully')
            : back()->withErrors(['loginError' => 'Invalid token or email']);
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }
}
