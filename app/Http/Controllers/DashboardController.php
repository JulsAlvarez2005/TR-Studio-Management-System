<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // 1. Basic Counts
        $projectsMonth = Booking::whereMonth('created_at', $currentMonth)->count();
        $projectsYear = Booking::whereYear('created_at', $currentYear)->count();
        
        // 2. Get all bookings for the current year with their services
        // We fetch this once to calculate both Total Income and Monthly Income
        $bookingsThisYear = Booking::whereYear('created_at', $currentYear)
            ->with('service')
            ->get();

        // 3. Calculate Total Income (Year)
        $totalIncome = $bookingsThisYear->sum(function($booking) {
            return $booking->service ? $booking->service->price : 0;
        });

        // 4. Calculate Monthly Income for the Chart
        // Initialize an array with 12 zeros (Index 0 = Jan, 11 = Dec)
        $monthlyIncome = array_fill(0, 12, 0);

        foreach ($bookingsThisYear as $booking) {
            if ($booking->service) {
                // Carbon month is 1-12, but array is 0-11. We subtract 1.
                $monthIndex = $booking->created_at->month - 1;
                $monthlyIncome[$monthIndex] += $booking->service->price;
            }
        }

        // 5. Deadlines
        $deadlines = Booking::whereNotNull('deadline')
            ->where('status', '!=', 'done')
            ->whereDate('deadline', '>=', Carbon::now()->startOfMonth())
            ->orderBy('deadline', 'asc') // Added sorting so soonest deadlines appear first
            ->get();

        // Pass everything to the view
        return view('dashboard', compact(
            'projectsMonth', 
            'projectsYear', 
            'totalIncome', 
            'deadlines',
            'monthlyIncome' // <--- Pass the new array here
        ));
    }
}