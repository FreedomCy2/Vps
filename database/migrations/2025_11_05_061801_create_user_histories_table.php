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
        Schema::create('user_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('service');
            $table->string('doctor')->nullable();
            $table->date('date');
            $table->time('time');
            $table->string('status')->default('Pending'); // Pending, Confirmed, Done, Cancelled
            $table->text('medical_concern')->nullable();
            $table->text('symptoms')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('user_login')->onDelete('cascade');
        });


        Schema::create('user_edits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('history_id');
            $table->string('old_service');
            $table->string('new_service');
            $table->date('new_date');
            $table->time('new_time');
            $table->text('reason')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('user_login')->onDelete('cascade');
            $table->foreign('history_id')->references('id')->on('user_histories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_edits');
        Schema::dropIfExists('user_histories');
    }
};
