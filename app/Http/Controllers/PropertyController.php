<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Agent;
use App\Models\Address;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //property is plural here because we are getting all properties, not just one. (unlike in AgentController)
        $properties = Property::with(['address', 'amenities'])->get();
        $properties = Property::paginate(10);
        return view('properties.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch data for the dropdowns
        $agents = Agent::all();
        $addresses = Address::all();
        
        return view('properties.create', compact('agents', 'addresses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'price'        => 'required|numeric|min:0',
            'type'         => 'required|string',
            'agent_id'     => 'required|exists:agents,id', 
            'street'       => 'required|string|max:255',
            'city'         => 'required|string|max:255',
            'house_number' => 'required|string|max:50',
        ]);

        return \DB::transaction(function () use ($request) {
            // 1. Create the Address first.
            // IMPORTANT: property_id must be nullable in your migration for this to work.
            $address = Address::create([
                'street'       => $request->street,
                'city'         => $request->city,
                'house_number' => $request->house_number,
                'property_id'  => null, 
            ]);

            // 2. Create the Property using the Address ID we just got.
            $property = Property::create([
                'title'      => $request->title,
                'price'      => $request->price,
                'type'       => $request->type,
                'agent_id'   => $request->agent_id,
                'address_id' => $address->id, 
            ]);

            // 3. Update the Address with the Property ID.
            $address->update(['property_id' => $property->id]);

            return redirect()->route('properties.index')->with('success', 'Property Created!');
        });
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
        $agents = Agent::all();
        $address = Address::find($property->address_id);
        return view('properties.edit', compact('property','address', 'agents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 1. Validate both Property and Address fields
        $request->validate([
            'title'        => 'required|string|max:255',
            'price'        => 'required|numeric|min:0',
            'type'         => 'required|string',
            'agent_id'     => 'required|exists:agents,id', 
            'street'       => 'required|string|max:255',
            'city'         => 'required|string|max:255',
            'house_number' => 'required|string|max:50',
        ]);

        // 2. Find the property or fail
        $property = Property::findOrFail($id);

        // 3. Authorization Check
        if (auth()->id() !== $property->agent_id && !auth()->user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        // 4. Use a Transaction to ensure both tables update together
        return \DB::transaction(function () use ($request, $property) {
            
            // Update Property details
            $property->update([
                'title'    => $request->title,
                'price'    => $request->price,
                'type'     => $request->type,
                'agent_id' => $request->agent_id,
            ]);

            // Update Address details (via the relationship)
            if ($property->address) {
                $property->address->update([
                    'street'       => $request->street,
                    'city'         => $request->city,
                    'house_number' => $request->house_number,
                ]);
            }

            return redirect()->route('properties.show', $property->id)
                            ->with('success', 'Property and Address updated successfully!');
        });
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
