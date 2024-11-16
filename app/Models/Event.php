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
        'event_type',
        'user_id',
        'ticket_price',
        'information'
    ];

    protected $casts = [
        'attendees' => 'array', // Cast JSON to array
        'reminders' => 'array', // Cast JSON to array
        'information' => 'array', // Cast JSON to array
    ];

    public function tickets(){
        return $this->hasMany(Event::class);
    }

    public function organizer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'parentable');
    }
}
