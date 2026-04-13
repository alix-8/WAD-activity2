<?php

/*NOTE: In this file (AgentController), there is no validation for properties_id because it is not required to update the agent.
        *agent_id should be put in the PropertiesController. Properties belongs to Agent, not Agent belongs to Properties.
        */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agent;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agents = Agent::with(['properties.address', 'properties.amenities'])->get();
        return view('agents.index', compact('agents'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('agents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'license_no' => 'required|unique:agents,license_no', 
                'phone_no' => 'required',
            ]);

            $agent = Agent::create($request->all());
            return redirect()->route('agents.index')->with('success', 'Agent added successfully!');
        }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $agent = Agent::with(['properties.address', 'properties.amenities'])->findOrFail($id);
        return view('agents.show', compact('agent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $agents = Agent::all();
        $agent = Agent::with(['properties.address', 'properties.amenities'])->findOrFail($id);
        return view('agents.edit', compact('agent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:30',
            'license_no' => 'required|string|max:6',
            'phone_no' => 'required|string|max:20',
        ]);

        $agent = Agent::findOrFail($id);
        $agent->update($request->all());
        return redirect()->route('agents.show', $agent->id)->with('success', 'Agent updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $agent = Agent::findOrFail($id);
        $agent->delete();
        return redirect()->route('agents.index')->with('success', 'Agent deleted successfully');
    }
}
