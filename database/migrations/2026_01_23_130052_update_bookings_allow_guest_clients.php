<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Allow bookings without a registered user account
            $table->unsignedBigInteger('user_id')->nullable()->change();

            // Add a simple column for the typed name
            $table->string('guest_name')->nullable()->after('user_id');
        });
    }

    public function down(): void
    {
        // Reverse changes
        Schema::table('bookings', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
            $table->dropColumn('guest_name');
        });
    }
};