<?php

namespace App\Http\Controllers\Admin;

use App\Notifications\TicketPurchasedNotification;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Stripe\StripeController;
use App\Models\Ticket;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::latest()->get();
        return view('adminpanel.ticket.index', compact('tickets'));
    }

    public function create()
    {
        $events = Event::where('approve', 1)->latest()->get();
        return view('adminpanel.ticket.purchase', compact('events'));
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

        // get the event information
        $event = Event::findorfail($request->event_id);

        if (!self::checkAvailability($event, $request->ticket_quantity)) {
            return back()->withErrors('Capacity has reached for ticket purchase!');
        }

        // Begin a transaction to ensure all or nothing happens
        DB::beginTransaction();

        try {

            // Generate unique ticket numbers (UUIDs) based on ticket_quantity
            $ticketNumbers = [];
            for ($i = 0; $i < $request->ticket_quantity; $i++) {
                $ticketNumbers[] = (string) Str::uuid(); // Generate a unique UUID for each ticket
            }

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
                'ticket_numbers' => $ticketNumbers,
            ]);


            // do this after successfuly payment is completed
            $information = $event->information;
            $information['ticket_sold'] += $request->ticket_quantity; // Update ticket_sold
            $event->update(['information' => $information]); // Save the updated information

            // Send the notification to the provided email
            if (env('SEND_MAIL') == 'true') {
                Notification::route('mail', $ticket->purchase_email)
                    ->notify(new TicketPurchasedNotification($ticket));
            }


            // Add Stripe checkout logic here...
            $stripeRequest = new Request(array_merge($request->all(), [
                'balance' => $ticket->total_amount
            ]));

            // Call the Stripe payment process
            $stripeController = new StripeController();
            $stripeResponse =  $stripeController->stripe($stripeRequest, $ticket);

            // Check if the Stripe URL was returned successfully
            if ($stripeResponse && $stripeResponse['status'] == 1) {
                DB::commit();
                return redirect()->to($stripeResponse['succes_url']); // Redirect to the Stripe checkout session
            } else {
                throw new \Exception('Payment failed, transaction aborted.');
            }

        } catch (\Exception $e) {

            // Rollback transaction if something goes wrong
            DB::rollBack();

            // Log the exception details
            Log::error('System failed: ' . $e->getMessage(), [
                'exception' => $e,
            ]);

            return redirect()->back()->withErrors('An error occurred while updating. Please try again.');
        }
    }


    public function checkAvailability(Event $event, $purchase_ticket_qty = 1)
    {

        if (((int)$event->information['max_event_capacity'] - (int)$event->information['ticket_sold'] - (int)$purchase_ticket_qty) < 0) {
            return false;
        }

        return true;
    }
}
