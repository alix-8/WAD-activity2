<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //property is plural here because we are getting all properties, not just one. (unlike in AgentController)
        $properties = Property::with(['address', 'amenities'])->get();
        return view('properties.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('properties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'agent_id' => 'required|exists:agents,id',
        ]);
        //Here, we are validating the agent_id because it is required to create a property. A property must belong to an agent. (unlike in AgentController)

        $property = Property::create($request->all());

        if ($request->has('amenities')) {
            $property->amenities()->sync($request->amenities); //to sync the amenities with the property : )
        }
        return redirect()->route('properties.show', $property->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $property = Property::with(['address', 'amenities'])->findOrFail($id);
        return view('properties.show', compact('property'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $property = Property::findOrFail($id);

        if (auth()->id() !== $property->agent_id && !auth()->user()->is_admin) {
            abort(403, 'Unauthorized access to edit this property.');
        }
        return view('properties.edit', compact('property'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'agent_id' => 'required|exists:agents,id',
        ]);

        $property = Property::findOrFail($id);
        if (auth()->id() !== $property->agent_id && !auth()->user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }
        $property->update($request->all());
        return redirect()->route('properties.show', $property->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $property = Property::findOrFail($id);

        // Check if the logged-in user is the owner OR an admin
        if (auth()->id() !== $property->agent_id && !auth()->user()->is_admin) {
            abort(403, 'You do not have permission to delete this property.');
        }

        $property->delete();
        return redirect()->route('properties.index')->with('success', 'Property deleted succesfully.');
    }
}
