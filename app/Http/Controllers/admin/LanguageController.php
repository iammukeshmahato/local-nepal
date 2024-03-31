<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::all();
        return view('admin.languages')->with('languages', $languages);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.add_language');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Language::create($request->all());
        toast('Language added successfully!', 'success');
        return redirect('admin/language');
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
        $language = Language::find($id);
        if ($language->guides->count() > 0) {
            toast('Language cannot be deleted as it is associated with some guides!', 'error');
        } else {
            $language->delete();
            toast('Language deleted successfully!', 'success');
        }
        return redirect('admin/language');
    }
}
