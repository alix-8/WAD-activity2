<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Agent;
use App\Models\Address;
use App\Models\Amenity;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
        $stats = [
            'total_properties' => Property::count(),
            'total_agents'     => Agent::count(),
            'total_amenities'  => Amenity::count(),
            'total_value'      => Property::sum('price'),
        ];

        $recent_properties = Property::with(['agent', 'address'])
                                ->latest()
                                ->take(5)
                                ->get();

        return view('dashboard', compact('stats', 'recent_properties'));
    } 
}