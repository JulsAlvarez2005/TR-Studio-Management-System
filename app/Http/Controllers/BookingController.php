<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index() {
        $bookings = Booking::with(['service', 'tech'])
            ->where('status', '!=', 'done')
            ->orderBy('deadline', 'asc')
            ->get();
            
        // ONLY show ACTIVE techs in the dropdown
        $techs = User::where('role', 'tech')->where('is_active', true)->get();

        return view('bookings.index', compact('bookings', 'techs'));
    }

    public function create() {
        $services = Service::where('is_active', true)->get();
        return view('bookings.create', compact('services'));
    }

    public function store(Request $request) {
        // 1. Validate data
        $data = $request->validate([
            'guest_name' => 'required|string',
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date',
            'deadline' => 'nullable|date',
            'client_notes' => 'nullable|string'
        ]);

        // 2. Set default status
        $data['status'] = 'pending';

        // 3. Create
        Booking::create($data);

        return redirect()->route('bookings.index')->with('success', 'Project Created!');
    }

    public function assignTech(Request $request, Booking $booking) {
        $booking->update(['assigned_tech_id' => $request->tech_id]);
        return back()->with('success', 'Tech Assigned');
    }

    // NEW: Mark project as Done
    public function markAsDone(Booking $booking) {
        $booking->update(['status' => 'done']);
        return back()->with('success', 'Project completed and archived!');
    }

    // ... inside BookingController class ...

    public function history() {
        // 1. Get all DONE bookings, sorted by newest first
        $bookings = Booking::where('status', 'done')
            ->with(['service', 'tech'])
            ->orderBy('booking_date', 'desc')
            ->get();

        // 2. Group them by "Month Year" (e.g. "January 2024")
        $historyGroups = $bookings->groupBy(function($date) {
            return \Carbon\Carbon::parse($date->booking_date)->format('F Y');
        });

        return view('bookings.history', compact('historyGroups'));
    }
}