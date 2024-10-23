<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;

    // Cast the ticket_numbers to an array
    protected $casts = [
        'ticket_numbers' => 'array',
    ];

    protected $fillable = [
        'purchase_name',
        'purchase_email',
        'purchase_phone',
        'purchase_address',
        'ticket_quantity',
        'ticket_price',
        'payment_status',
        'stripe_payment_id',
        'total_amount',
        'event_id',
        'ticket_numbers'
    ];

    public function event(){
        return $this->belongsTo(Event::class);
    }

    public function ticket_count(){
        return count($this->ticket_numbers);
    }
}
