<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Service;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        // 1. Get the "Stack" of Bookings (Ordered by Deadline)
        $bookings = Booking::with(['client', 'service', 'tech'])
            ->orderBy('deadline', 'asc') 
            ->get();

        // 2. Get Services for the "Settings" panel
        $services = Service::all();

        // 3. Get all users who are "Techs" for the dropdown
        $techs = User::where('role', 'tech')->get(); 

        return view('dashboard', compact('bookings', 'services', 'techs'));
    }

    // Assign a Tech to a project
    public function assignTech(Request $request, Booking $booking)
    {
        $booking->update(['assigned_tech_id' => $request->tech_id]);
        return back()->with('success', 'Tech Assigned!');
    }

    // Add a new Service (e.g., "Vocal Mixing")
    public function storeService(Request $request)
    {
        Service::create($request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]));
        return back()->with('success', 'New Service Added!');
    }

    // Turn a service On/Off
    public function toggleService(Service $service)
    {
        $service->update(['is_active' => !$service->is_active]);
        return back();
    }
}