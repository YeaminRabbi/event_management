<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'google_event_id',
        'google_event_url',
        'summary',
        'description',
        'location',
        'start',
        'end',
        'attendees',
        'reminders',
        'status',
        'approve',
        'user_id',
        'ticket_price',
        'rules'
    ];

    protected $casts = [
        'attendees' => 'array', // Cast JSON to array
        'reminders' => 'array', // Cast JSON to array
        'rules' => 'array', // Cast JSON to array
    ];

    public function tickets(){
        return $this->hasMany(Event::class);
    }
}
