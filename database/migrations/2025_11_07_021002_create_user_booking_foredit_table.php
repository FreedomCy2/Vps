<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_booking_foredit', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('service');
            $table->date('date');
            $table->time('time');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->integer('age');
            $table->string('gender');
            $table->text('symptom')->nullable();
            $table->string('status')->default('Pending');
            $table->timestamps();
            
            // Add indexes for better query performance
            $table->index('user_id');
            $table->index('status');
            $table->index('date');
            
            // Add foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_booking_foredit');
    }
};
