<?php

namespace App\Http\Controllers\guide;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Guide;
use App\Models\Language;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class GuideProfileController extends Controller
{
    public function complete_profile(Request $request)
    {
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
    }

    public function show_profile()
    {
        $user = Auth::user();
        $guide = Guide::with('languages')->where('user_id', $user->id)->first();
        $languages = Language::all();
        return view('guide.profile')->with(compact('user', 'guide', 'languages'));
    }

    public function update_profile(Request $request)
    {
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
    }

    public function change_password_form()
    {
        return view('guide.update_password');
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
            return redirect('guide/update-password');
        }
        $user = User::find($user->id);
        $user->password = Hash::make($request->password);
        $user->save();
        session()->flash('success', 'Password updated successfully');
        toast('Password updated successfully', 'success');
        Auth::logout();
        return redirect('/login');
    }
}
