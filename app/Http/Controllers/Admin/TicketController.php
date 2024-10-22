<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\Event;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(){
        return view('adminpanel.ticket.index');
    }

    public function create(){

        $events = Event::latest()->get();
        return view('adminpanel.ticket.purchase' , compact('events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'purchase_name' => 'required|string|max:255',
            'purchase_email' => 'required|email',
            'purchase_phone' => 'nullable|string',
            'purchase_address' => 'nullable|string',
            'ticket_quantity' => 'required|integer|min:1',
            'ticket_price' => 'required|numeric|min:0',
            'event_id' => 'required',
        ]);

        // Create the ticket
        $ticket = Ticket::create([
            'event_id' => $request->event_id,
            'purchase_name' => $request->purchase_name,
            'purchase_email' => $request->purchase_email,
            'purchase_phone' => $request->purchase_phone,
            'purchase_address' => $request->purchase_address,
            'ticket_quantity' => $request->ticket_quantity,
            'ticket_price' => $request->ticket_price,
            'total_amount' => $request->ticket_quantity * $request->ticket_price,
        ]);

        // Add Stripe checkout logic here...

        return redirect()->route('ticket.index')->with('success', 'Ticket purchased successfully!');
    }

}
