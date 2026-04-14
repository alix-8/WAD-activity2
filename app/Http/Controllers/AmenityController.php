<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Amenity;
use App\Models\Property;

class AmenityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $amenities = Amenity::all();
        $properties = Property::all();
        return view('amenities.index', compact('amenities', 'properties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $properties = Property::all();
        $amenities = Amenity::all();
        return view('amenities.create', compact('amenities', 'properties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
        ]);

        $amenity = Amenity::create($request->all());
        return redirect()->route('amenities.index', $amenity->id)->with('success', 'Amenity created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $amenity = Amenity::findOrFail($id);
        // $properties = Property::all();
        // return view('amenities.show', compact('amenity', 'properties'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $amenity = Amenity::findOrFail($id);
        // $properties = Property::all();
        // return view('amenities.edit', compact('amenity', 'properties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $request->validate([
        //     'name' => 'required|string|max:50',
        // ]);

        // $amenity = Amenity::findOrFail($id);
        // if(!auth()->user()->is_admin) {
        //     abort(403, 'Only Admins can update amenities.');
        // }
        // $amenity->update($request->all());
        // return redirect()->route('amenities.show', $amenity->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $amenity = Amenity::findOrFail($id);
        if(!auth()->user()->is_admin) {
            abort(403, 'Only Admins can delete amenities.');
        }
        $amenity->delete();
        return redirect()->route('amenities.index')->with('success', 'Amenity deleted successfully.');
    }
}
