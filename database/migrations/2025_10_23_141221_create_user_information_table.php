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
        Schema::create('user_informations', function (Blueprint $table) {
            $table->id(); // primary key
            $table->string('service'); // selected service
            $table->date('date'); // preferred date
            $table->time('time'); // preferred time
            $table->string('name'); // full name
            $table->string('email'); // email
            $table->string('phone'); // phone number
            $table->integer('age'); // age
            $table->string('gender'); // gender
            $table->text('symptom')->nullable(); // symptom/concerns
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_informations');
    }
};
