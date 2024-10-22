@extends('adminpanel.layout.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @if (\Session::has('success'))
            <div class="row">
                <div class="col-md-12">
                    <div id="notificationAlert" style="display: block;">
                        <div class="alert alert-warning">
                            <span style="color:black;">
                                {!! \Session::get('success') !!}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif

        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Ticket / </span> Create</h4>
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Ticket Information</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('ticket.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="event_id">Event <span
                                        style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <select id="event_id" name="event_id" class="form-control">
                                        <option value="" selected disabled>--choose event--</option>
                                        @foreach ($events as $item)
                                            <option value="{{ $item->id }}">{{ $item->summary }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="purchase_name">Participant's Name <span
                                        style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="purchase_name" name="purchase_name"
                                        value="{{ old('purchase_name') }}" required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="purchase_email">Email <span
                                        style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="purchase_email" name="purchase_email"
                                        value="{{ old('purchase_email') }}" required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="ticket_quantity">Ticket Quantity <span
                                        style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <input type="number" min="1" class="form-control" id="ticket_quantity"
                                        name="ticket_quantity" value="{{ old('ticket_quantity', 1) }}" required />
                                </div>
                            </div>

                            <!-- Pricing Section -->
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="ticket_price">Ticket Price</label>
                                <div class="col-sm-10">
                                    <input type="number" step="0.01" class="form-control" id="ticket_price"
                                        name="ticket_price" value="{{ old('ticket_price', 0.0) }}" readonly />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="total_amount">Total Amount</label>
                                <div class="col-sm-10">
                                    <input type="number" step="0.01" class="form-control" id="total_amount"
                                        name="total_amount" value="{{ old('total_amount', 0.0) }}" readonly />
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="{{ route('ticket.index') }}" class="btn btn-dark">Back to List</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4" id="eventDetails" style="display:none;">

                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Event Information</h5>
                    </div>
                    <div class="card-body">
                        <div>
                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <label class="col-form-label">Location</label>
                                    <input type="text" class="form-control" id="event_location" readonly />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <label class="col-form-label">Start</label>
                                    <input type="text" class="form-control" id="event_start" readonly />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <label class="col-form-label">End</label>
                                    <input type="text" class="form-control" id="event_end" readonly />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <label class="col-form-label">Description</label>
                                    <textarea class="form-control" id="event_description" readonly></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.getElementById('event_id').addEventListener('change', function() {
            const eventId = this.value;

            if (eventId) {
                axios.get(`/event-details/${eventId}`)
                    .then(function(response) {
                        const data = response.data;

                        document.getElementById('ticket_price').value = data.price;
                        document.getElementById('event_location').value = data.location;
                        document.getElementById('event_description').value = data.description;

                        // Format the start and end dates
                        document.getElementById('event_start').value = formatDate(new Date(data.start));
                        document.getElementById('event_end').value = formatDate(new Date(data.end));

                        document.getElementById('eventDetails').style.display = 'block';

                        // Calculate the total amount based on the current quantity
                        calculateTotal();
                    })
                    .catch(function(error) {
                        console.log(error);
                        alert('There was an error fetching the event details. Please try again.');
                    });
            }
        });

        // Add an event listener for ticket quantity input change
        document.getElementById('ticket_quantity').addEventListener('input', calculateTotal);

        // Function to calculate total amount
        function calculateTotal() {
            const ticketPrice = parseFloat(document.getElementById('ticket_price').value) || 0;
            const ticketQuantity = parseInt(document.getElementById('ticket_quantity').value) || 0;

            const totalAmount = ticketPrice * ticketQuantity;
            document.getElementById('total_amount').value = totalAmount.toFixed(2); // Format to 2 decimal places
        }

        // Function to format date to 'h:ia \o\n d M, Y'
        function formatDate(date) {
            const options = {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true,
                day: '2-digit',
                month: 'short',
                year: 'numeric'
            };

            // Format the date string
            const formattedDate = date.toLocaleString('en-US', options).replace(',', '').replace(' AM', 'am').replace(' PM',
                'pm');

            // Format to 'h:ia \o\n d M, Y'
            return formattedDate.replace(/(\d{1,2}:\d{2} [ap]{1}[m]{1})/, '$1 on') + ' ' + date.toLocaleString('en-US', {
                day: 'numeric',
                month: 'short',
                year: 'numeric'
            }).replace(',', '');
        }
    </script>
@endsection
