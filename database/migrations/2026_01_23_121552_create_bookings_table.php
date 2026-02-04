<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            
            // Who is the client?
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // What service did they pick?
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            
            // When is the recording session?
            $table->dateTime('booking_date');
            
            // DEADLINE TRACKING
            $table->date('deadline')->nullable(); 
            
            // ASSIGNED TECH (Nullable because it might not be assigned yet)
            $table->unsignedBigInteger('assigned_tech_id')->nullable();
            $table->foreign('assigned_tech_id')->references('id')->on('users');

            $table->text('client_notes')->nullable();
            $table->string('status')->default('pending'); // pending, done
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};