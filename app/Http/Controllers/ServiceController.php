<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ServiceController extends Controller
{
    public function index() {
        // Fetch Services
        $services = Service::all();
        
        // Fetch Techs (Users with role 'tech')
        // We get ALL of them so you can see who is archived
        $techs = User::where('role', 'tech')->get();

        return view('services.index', compact('services', 'techs'));
    }

    // --- SERVICE METHODS ---
    public function store(Request $request) {
        Service::create($request->validate(['name' => 'required', 'price' => 'required']));
        return back()->with('success', 'Service Added');
    }

    public function toggle(Service $service) {
        $service->update(['is_active' => !$service->is_active]);
        return back();
    }

    // --- TECH METHODS ---
    public function storeTech(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password'), // Default password
            'role' => 'tech',
            'is_active' => true, // Default to Active
        ]);

        return back()->with('success', 'New Tech Added! Default password is "password"');
    }

    // REPLACED: "destroyTech" is gone. Now we use "toggleTech"
    public function toggleTech(User $user) {
        // This toggles between True/False
        $user->update(['is_active' => !$user->is_active]);
        
        $status = $user->is_active ? 'Restored' : 'Archived';
        return back()->with('success', "Tech has been $status.");
    }
}