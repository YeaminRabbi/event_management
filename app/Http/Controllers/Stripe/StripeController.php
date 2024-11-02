<?php

namespace App\Http\Controllers\Stripe;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Notifications\TicketPurchasedNotification;
use Illuminate\Support\Facades\Notification;

class StripeController extends Controller
{

    public function stripe(Request $request, Ticket $ticket)
    {
        $request->validate([
            'balance' => 'required|numeric'
        ]);

        $totalAmount = $request->balance;

        $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));

        $response = $stripe->checkout->sessions->create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Add Balance'
                        ],
                        'unit_amount' => 100 * $totalAmount,
                        // 'tax_behavior' => 'exclusive',
                    ],

                    'quantity' => 1,
                ],
            ],
            //   'automatic_tax' => ['enabled' => true],
            'mode' => 'payment',
            'success_url' => route('stripe.success', ['ticketID' => $ticket->id]) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' =>  route('stripe.cancel', ['ticketID' => $ticket->id]),

        ]);

        if (isset($response->id) && $response->id != '') {

            $respone = [
                'succes_url' => $response->url,
                'status' => 1,
            ];

            return $respone;
        } else {

            $respone = [
                'cancel_url' => $response->cancel_url,
                'status' => 0,
            ];

            return $respone;
        }
    }

    public function success(Request $request, $ticketID)
    {
        $ticket = Ticket::findorfail($ticketID);

        //fetch event information
        $event = Event::findorfail($ticket->event_id);

        if (isset($request->session_id)) {
            $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));
            $response = $stripe->checkout->sessions->retrieve($request->session_id);

            if ($response->status == 'complete') {
                
                // Retrieve the PaymentIntent to get the payment method details
                $paymentIntent = $stripe->paymentIntents->retrieve(
                    $response->payment_intent,
                    ['expand' => ['payment_method']]
                );

                // Get the last 4 digits of the card
                $last4 = $paymentIntent->payment_method->card->last4 ?? null;

                // Save payment information in the Payment model
                $payment = Payment::create([
                    'ticket_id' => $ticket->id,
                    'event_id' => $event->id,
                    'payment_intent_id' => $response->payment_intent,
                    'session_id' => $request->session_id,
                    'amount_paid' => $response->amount_total / 100, // Total amount paid (in smallest currency unit)
                    'currency' => $response->currency,
                    'payment_status' => $response->payment_status, // E.g., "paid"
                    'payment_method' => $response->payment_method_types[0], // E.g., "card"
                    'receipt_url' => $response->receipt_url,
                    'customer_email' => $response->customer_details->email,
                    'customer_name' => $response->customer_details->name,
                    'transaction_date' => now(), // Transaction timestamp
                    'last_four_digits' =>  $last4,
                ]);

                $ticket->update([
                    'payment_status' => 'paid',
                    'stripe_payment_id' => $payment->id
                ]);

                // After successfuly payment is completed
                $information = $event->information;
                $information['ticket_sold'] += $ticket->ticket_quantity; // Update ticket_sold
                $event->update(['information' => $information]); // Save the updated information

                // Send the notification to the provided email
                if (env('SEND_MAIL') == 'true') {
                    Notification::route('mail', $ticket->purchase_email)
                        ->notify(new TicketPurchasedNotification($ticket));
                }
            }

            return redirect()->route('ticket.edit', $ticketID)->with('success', 'Ticket purchased successfully! You will receive a confirmation email shortly.');
        } else {

            $ticket->update([
                'payment_status' => 'canceled'
            ]);

            // After payment canceled update the ticket_sold count
            $information = $event->information;
            $information['ticket_sold'] -= $ticket->ticket_quantity; // Update ticket_sold
            $event->update(['information' => $information]); // Save the updated information

            return redirect()->route('stripe.cancel', $ticket->id);
        }
    }

    public function cancel(Request $request, $ticketID)
    {
        return redirect()->route('ticket.edit', $ticketID)->withErrors('There was an issue processing your payment. Please try again or contact support if the problem persists.');
    }
}
