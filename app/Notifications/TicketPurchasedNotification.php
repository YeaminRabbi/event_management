<?php

namespace App\Notifications;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Barryvdh\DomPDF\Facade\Pdf;

class TicketPurchasedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $ticket;

    /**
     * Create a new notification instance.
     */
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    // Define the notification channels
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    // public function toMail($notifiable)
    // {
    //     // Generate the PDF for the ticket
    //     $pdf = PDF::loadView('mail.ticket', ['ticket' => $this->ticket]);

    //     return (new MailMessage)
    //         ->subject('Ticket Purchase Confirmation')
    //         ->greeting('Hello ' . $this->ticket->purchase_name . '!')
    //         ->line('Thank you for purchasing tickets for the event: ' . $this->ticket->event->summary)
    //         ->line('Ticket Quantity: ' . $this->ticket->ticket_quantity)
    //         ->line('Total Amount: $' . $this->ticket->total_amount)
    //         ->attachData($pdf->output(), 'ticket.pdf', [
    //             'mime' => 'application/pdf',
    //         ])
    //         ->line('Please find your ticket details attached as a PDF.')
    //         ->line('We look forward to seeing you at the event!');
    // }

    public function toMail($notifiable)
    {
        $mailMessage = (new MailMessage)
            ->subject('Ticket Purchase Confirmation')
            ->greeting('Hello ' . $this->ticket->purchase_name . '!')
            ->line('Thank you for purchasing tickets for the event: ' . $this->ticket->event->summary)
            ->line('Ticket Quantity: ' . $this->ticket->ticket_quantity)
            ->line('Total Amount: $' . $this->ticket->total_amount)
            ->line('Please find your ticket details attached as PDFs.');

        // Generate a PDF for each ticket number
        foreach ($this->ticket->ticket_numbers as $index => $ticketNumber) {
            $pdf = Pdf::loadView('mail.ticket', [
                'ticket' => $this->ticket,
                'ticket_number' => $ticketNumber,
            ]);

            // Attach each PDF with a unique name
            $mailMessage->attachData($pdf->output(), "ticket-{$ticketNumber}.pdf", [
                'mime' => 'application/pdf',
            ]);
        }

        return $mailMessage
            ->line('We look forward to seeing you at the event!');
    }
}
