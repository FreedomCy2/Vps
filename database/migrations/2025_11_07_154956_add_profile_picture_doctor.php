<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * This migration adds profile_picture and other profile fields to the doctors table
     * WITHOUT specifying column order (more flexible)
     * Run this migration with: php artisan migrate
     */
    public function up(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            // Add profile picture column if it doesn't exist
            if (!Schema::hasColumn('doctors', 'profile_picture')) {
                $table->string('profile_picture')->nullable();
            }
            
            // Add other profile fields if they don't exist
            if (!Schema::hasColumn('doctors', 'phone')) {
                $table->string('phone', 20)->nullable();
            }
            
            if (!Schema::hasColumn('doctors', 'specialization')) {
                $table->string('specialization')->nullable();
            }
            
            if (!Schema::hasColumn('doctors', 'start_time')) {
                $table->time('start_time')->default('09:00');
            }
            
            if (!Schema::hasColumn('doctors', 'end_time')) {
                $table->time('end_time')->default('17:00');
            }
            
            if (!Schema::hasColumn('doctors', 'appointment_duration')) {
                $table->integer('appointment_duration')->default(30);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            // Only drop columns if they exist
            $columnsToDrop = [];
            
            if (Schema::hasColumn('doctors', 'profile_picture')) {
                $columnsToDrop[] = 'profile_picture';
            }
            if (Schema::hasColumn('doctors', 'phone')) {
                $columnsToDrop[] = 'phone';
            }
            if (Schema::hasColumn('doctors', 'specialization')) {
                $columnsToDrop[] = 'specialization';
            }
            if (Schema::hasColumn('doctors', 'start_time')) {
                $columnsToDrop[] = 'start_time';
            }
            if (Schema::hasColumn('doctors', 'end_time')) {
                $columnsToDrop[] = 'end_time';
            }
            if (Schema::hasColumn('doctors', 'appointment_duration')) {
                $columnsToDrop[] = 'appointment_duration';
            }
            
            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }
};
