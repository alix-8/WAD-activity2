<?php

/*NOTE: In this file (AgentController), there is no validation for property_id because it is not required to update the agent.
        *agent_id should be put in the PropertyController. Property belongs to Agent, not Agent belongs to Property.
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
        $agents = Agent::with(['property.address', 'property.amenities'])->get();
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
            'name' => 'required|string|max:30',
            'email' => 'required|email|max:50',
            'phone' => 'required|string|max:20',
        ]);

        $agent = Agent::create($request->all());
        return redirect()->route('agents.show', $agent->property_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $agent = Agent::with(['property.address', 'property.amenities'])->findOrFail($id);
        return view('agents.show', compact('agent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $agent = Agent::with(['property.address', 'property.amenities'])->findOrFail($id);
        return view('agents.edit', compact('agent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:30',
            'email' => 'required|email|max:50',
            'phone' => 'required|string|max:20',
        ]);

        $agent = Agent::findOrFail($id);
        $agent->update($request->all());
        return redirect()->route('agents.show', $agent);
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
