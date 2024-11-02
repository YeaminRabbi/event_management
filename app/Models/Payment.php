<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'event_id',
        'payment_intent_id',
        'session_id',
        'amount_paid',
        'currency',
        'payment_status',
        'payment_method',
        'receipt_url',
        'customer_email',
        'customer_name',
        'transaction_date',
    ];


    public function event(){
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function ticket(){
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }
}

