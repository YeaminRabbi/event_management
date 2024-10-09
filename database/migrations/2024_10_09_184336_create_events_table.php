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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('google_event_id')->unique()->nullable(); // Unique ID from Google Calendar
            $table->string('google_event_url')->nullable(); 
            $table->foreignId('user_id')
                ->constrained('users')  // Reference the 'users' table
                ->onDelete('cascade');  // Cascade on delete
            $table->string('summary'); // Event title
            $table->text('description')->nullable(); // Event description
            $table->string('location')->nullable(); // Event location
            $table->dateTime('start'); // Event start time
            $table->dateTime('end'); // Event end time
            $table->json('attendees')->nullable(); // JSON column for attendees
            $table->json('reminders')->nullable(); // JSON column for reminders
            $table->string('status'); // Event status
            $table->tinyInteger('approve')->dafault(false); // Event admin approval
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
