<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EventTicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Create 5 random events
        $events = Event::factory()->count(5)->create();

        // Loop through each created event
        foreach ($events as $event) {
            // Generate 10 random tickets for each event
            for ($i = 0; $i < 10; $i++) {
                $ticketQuantity = rand(1, 5); // Random ticket quantity between 1 and 5

                Ticket::create([
                    'event_id' => $event->id,
                    'purchase_name' => $faker->name,
                    'purchase_email' => $faker->safeEmail,
                    'purchase_phone' => $faker->phoneNumber,
                    'ticket_quantity' => $ticketQuantity,
                    'ticket_price' => $event->ticket_price, // Use event ticket price
                    'total_amount' => $ticketQuantity * $event->ticket_price, // Calculate total amount
                    'payment_status' => 'paid', // You can make this random if needed
                    'ticket_numbers' => json_encode([uniqid(), uniqid()]), // Random ticket numbers
                ]);
            }
        }
    }
}

