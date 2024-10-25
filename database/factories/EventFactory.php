<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition()
    {
        return [
            'google_event_id' => null,
            'google_event_url' => null,
            'user_id' => User::first()->id, // Assuming user_id 1 exists, you can randomize it as needed
            'summary' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'location' => $this->faker->address(),
            'start' => $this->faker->dateTimeBetween('-1 years', '+1 years'),
            'end' => $this->faker->dateTimeBetween('+1 days', '+1 years'),
            'attendees' => null,
            'reminders' => null,
            'information' => [
                'ticket_sold' => rand(0, 10),
                'refund_policy' => $this->faker->sentence(),
                'max_event_capacity' => rand(100, 1000),
                'min_age_requirement' => rand(18, 30),
                'max_ticket_purchase_limit' => rand(1, 5),
            ],
            'status' => 'confirmed',
            'approve' => 1,
            'ticket_price' => $this->faker->randomFloat(2, 100, 1000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
