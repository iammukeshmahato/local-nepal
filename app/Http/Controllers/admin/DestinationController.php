<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $destinations = Destination::all();
        return view('admin.destinations.destinations', compact('destinations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.destinations.add_destination');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'location' => 'required',
            'description' => 'required',
            'cover_image' => 'required|image',
            'type' => 'required',
        ]);

        $slug = Str::slug($request->title);

        $coverImage = $request->file('cover_image')->getClientOriginalName();
        $request->file('cover_image')->move(public_path('storage/destinations/'), $coverImage);

        $destination = Destination::create(array_merge($request->all(), [
            'cover_image' => $coverImage,
            'slug' => $slug,
        ]));

        return redirect('/admin/destinations')->with('success', 'Destination added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Destination::find($id);
        return view('admin.destinations.show_destination', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Destination::find($id);
        return view('admin.destinations.edit_destination', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'location' => 'required',
            'description' => 'required',
            'type' => 'required',
        ]);


        if ($request->hasFile('cover_image')) {
            $coverImage = $request->file('cover_image')->getClientOriginalName();
            $request->file('cover_image')->move(public_path('storage/destinations/'), $coverImage);
        }

        $destination = Destination::find($id);
        $destination->update(array_merge($request->all(), [
            'cover_image' => $coverImage ?? $destination->cover_image,
        ]));

        return redirect('/admin/destination')->with('success', 'Destination updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $destination = Destination::find($id);
        $destination->delete();

        return redirect('/admin/destination')->with('success', 'Destination deleted successfully');
    }
}
