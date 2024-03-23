<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\SendCredential;
use App\Models\Guide;

class GuideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guides =  $guides = Guide::with('user')->get();
        return view('admin.guides')->with('guides', $guides);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.add_guide');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required | min:3 | regex:/^[a-z A-Z]+$/u',
            'email' => 'required | email | unique:users,email',
            'phone' => 'required | min:10 | max:10 | regex:/^[0-9]+$/u',
            'dob' => 'required | date',
            'address' => 'required | string',
            'avatar' => 'required | image | mimes:jpeg,png,jpg,gif,svg | max:2048',
            'national_id' => 'required | image | mimes:jpeg,png,jpg,gif,svg | max:2048',
        ]);

        $avatar = $request->file('avatar');
        $avatarName = $avatar->getClientOriginalName();
        $avatar->storeAs('public/profiles/', $avatarName);

        $national_id = $request->file('national_id');
        $national_id_name = $national_id->getClientOriginalName();
        $national_id->storeAs('public/guides/id/', $avatarName);

        $password = Str::password(8);

        $user = User::create(array_merge($request->all(), ['role' => 'guide', 'verified' => 1, 'avatar' => $avatarName, 'password' => bcrypt($password)]));

        Guide::create(array_merge($request->all(), ['user_id' => $user->id, 'status' => 'active', 'national_id' => $national_id_name]));

        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $password,
            'url' => url('/login'),
        ];

        Mail::to($user->email)->send(new SendCredential($data));

        session()->flash('success', 'Guide added successfully');
        return redirect('/admin/guide');
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
