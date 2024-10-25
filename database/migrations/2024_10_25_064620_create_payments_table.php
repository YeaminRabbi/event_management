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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->constrained()->onDelete('cascade');
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->string('payment_intent_id')->nullable(); // Stripe payment intent ID
            $table->string('session_id')->nullable(); // Stripe session ID
            $table->decimal('amount_paid', 8, 2); // Amount paid in cents (smallest currency unit)
            $table->string('currency', 10)->default('usd'); // Payment currency
            $table->string('payment_status'); // Payment status (paid, failed, etc.)
            $table->string('payment_method')->nullable(); // Card, etc.
            $table->string('receipt_url')->nullable(); // Stripe receipt URL
            $table->string('customer_email')->nullable(); // Email of the customer
            $table->string('customer_name')->nullable(); // Name of the customer
            $table->timestamp('transaction_date')->nullable(); // Date of the transaction
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
