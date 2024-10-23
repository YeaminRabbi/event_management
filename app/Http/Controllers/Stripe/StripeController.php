<?php

namespace App\Http\Controllers\Stripe;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

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
            'cancel_url' =>  route('stripe.cancel'),

        ]);

        if(isset($response->id) && $response->id != ''){

            $respone = [
                'succes_url' => $response->url,
                'status' => 1,
            ];

            return $respone;
        }
        else{

            $respone = [
                'cancel_url' => $response->cancel_url,
                'status' => 0,
            ];

            return $respone;
        }

    }

    public function success(Request $request, $ticketID)
    {
        if(isset($request->session_id)){

            $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));
            $response = $stripe->checkout->sessions->retrieve($request->session_id);

            if($response->status == 'complete'){

                $ticket = Ticket::findorfail($ticketID);
    
                $ticket->update([
                    'payment_status' => 'paid'
                ]);
               
            }

            return redirect()->route('ticket.create')->with('success', 'Ticket purchased successfully! You will receive a confirmation email shortly.');

        }else{
            return redirect()->route('stripe.cancel');
        }
    }

    public function cancel(Request $request)
    {
        return redirect()->route('ticket.create')->withErrors('There was an issue processing your payment. Please try again or contact support if the problem persists.');
    }


}
