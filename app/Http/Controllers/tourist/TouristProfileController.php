<?php

namespace App\Http\Controllers\tourist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tourist;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TouristProfileController extends Controller
{
    public function complete_profile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'phone' => 'required | digits:10 | min:10 | max:10 | unique:guides,phone| unique:tourists,phone',
            'nationality' => 'required | string',
        ]);

        Tourist::create($request->all() + ['user_id' => $user->id]);
        session()->flash('success', 'Profile updated successfully');
        toast('Profile updated successfully', 'success');
        return redirect('tourist/dashboard');
    }

    public function show_profile()
    {
        $user = Auth::user();
        $tourist = Tourist::where('user_id', $user->id)->first();
        return view('tourist.profile')->with(compact('user', 'tourist'));
    }

    public function update_profile(Request $request)
    {
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
    }

    public function change_password_form()
    {
        return view('tourist.update_password');
    }

    public function update_password(Request $request)
    {
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
    }
}
