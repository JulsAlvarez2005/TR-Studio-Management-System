<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Booking extends Model
{
    protected $guarded = []; 

    // This casting ensures the date works correctly
    protected $casts = [
        'booking_date' => 'datetime',
        'deadline' => 'date',
    ];

    public function service(): BelongsTo {
        return $this->belongsTo(Service::class);
    }

    public function tech(): BelongsTo {
        return $this->belongsTo(User::class, 'assigned_tech_id');
    }

    // Helper: If there is a registered user, show that name. Otherwise, show the typed guest name.
    public function getClientNameAttribute() {
        return $this->guest_name ?? ($this->client ? $this->client->name : 'Unknown');
    }

    // Relationship to User (optional now)
    public function client(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getDeadlineColorAttribute() {
        if (!$this->deadline) return 'bg-gray-200 text-gray-800'; 
        
        // If status is done, make it gray/green
        if ($this->status === 'done') return 'bg-gray-400 text-white';

        $daysLeft = Carbon::now()->diffInDays($this->deadline, false);

        if ($daysLeft < 0) return 'bg-gray-500 text-white'; 
        if ($daysLeft <= 3) return 'bg-red-500 text-white'; 
        if ($daysLeft <= 7) return 'bg-yellow-400 text-black'; 
        
        return 'bg-green-500 text-white'; 
    }
}