<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Confirmation</title>
    <style>
        body {
            font-family: 'Verdana', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .ticket-container {
            width: 80%;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border: 2px solid #e5e5e5;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
        }

        .header {
            background-color: #333;
            padding: 20px;
            color: #f8f8f8;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }

        .header h2 {
            font-size: 24px;
            font-weight: 700;
            color: #f8c03e;
        }

        .ticket-info {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .ticket-info th, .ticket-info td {
            padding: 15px;
            border-bottom: 1px solid #e5e5e5;
            text-align: left;
            font-size: 16px;
        }

        .ticket-info th {
            font-weight: 600;
            background-color: #f8f8f8;
        }

        .ticket-info td {
            background-color: #fff;
        }

        .ticket-info tr:last-child td {
            border-bottom: none;
        }

        .total-amount {
            text-align: right;
            margin-top: 20px;
            font-size: 18px;
            font-weight: 700;
            color: #333;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
            color: #777;
        }

        .footer p {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="ticket-container">
        <!-- Ticket Header -->
        <div class="header">
            <h2>Premium Event Ticket</h2>
        </div>

        <!-- Ticket Body -->
        <h1>Ticket Purchase Confirmation</h1>
        <p style="text-align: center;">Thank you for purchasing a ticket to the event <strong>{{ $ticket->event->summary }}</strong>.</p>

        <!-- Ticket Information Table -->
        <table class="ticket-info">
            <tr>
                <th>Event:</th>
                <td>{{ $ticket->event->summary }}</td>
            </tr>
            <tr>
                <th>Ticket Number:</th>
                <td>{{ $ticket_number }}</td>
            </tr>
            <tr>
                <th>Participant Name:</th>
                <td>{{ $ticket->purchase_name }}</td>
            </tr>
            <tr>
                <th>Participant Email:</th>
                <td>{{ $ticket->purchase_email }}</td>
            </tr>
            <tr>
                <th>Ticket Quantity:</th>
                <td>{{ $ticket->ticket_quantity }}</td>
            </tr>
            <tr>
                <th>Ticket Price:</th>
                <td>{{ $ticket->ticket_price }}</td>
            </tr>
        </table>

        <!-- Total Amount -->
        <div class="total-amount">
            Total Amount: ${{ $ticket->total_amount }}
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Please bring this ticket along with a valid ID to the event.</p>
            <p>We look forward to seeing you there!</p>
        </div>
    </div>
</body>
</html>
