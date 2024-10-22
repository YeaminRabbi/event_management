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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();

            // Event information
            $table->foreignId('event_id')
                ->constrained('events')  // Reference the 'events' table
                ->onDelete('cascade');  // Cascade on delete

            // User purchase information
            $table->string('purchase_name');
            $table->string('purchase_email');
            $table->string('purchase_phone')->nullable();
            $table->string('purchase_address')->nullable();

            // Ticket-related information
            $table->integer('ticket_quantity')->default(1); // Number of tickets purchased
            $table->decimal('ticket_price', 10, 2); // Price per ticket

            // Payment-related information
            $table->string('payment_status')->default('pending'); // e.g., 'pending', 'completed', 'failed'
            $table->string('stripe_payment_id')->nullable(); // To store the Stripe payment ID
            $table->decimal('total_amount', 10, 2); // Total amount paid

            // Soft delete and timestamps
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
