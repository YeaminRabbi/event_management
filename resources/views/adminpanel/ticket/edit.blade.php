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

        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Ticket / </span> Edit Purchase</h4>
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Ticket Information</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('ticket.update', $ticket->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="event_id">Event <span
                                        style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <select id="event_id" name="event_id" class="form-control" readonly>
                                        <option value="" disabled>--choose event--</option>
                                        @foreach ($events as $item)
                                            <option value="{{ $item->id }}" {{ $item->id == $ticket->event_id ? 'selected' : '' }}>
                                                {{ $item->summary }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="purchase_name">Participant's Name <span
                                        style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="purchase_name" name="purchase_name"
                                        value="{{ old('purchase_name', $ticket->purchase_name) }}" placeholder="Enter Participant's Name" readonly />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="purchase_email">Email <span
                                        style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="purchase_email" name="purchase_email"
                                        value="{{ old('purchase_email', $ticket->purchase_email) }}" placeholder="Enter Participant's Email" readonly />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="purchase_phone">Phone </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="purchase_phone" name="purchase_phone"
                                        value="{{ old('purchase_phone', $ticket->purchase_phone) }}" placeholder="Enter Participant's Phone" readonly />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="ticket_quantity">Ticket Quantity </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="ticket_quantity" name="ticket_quantity"
                                        value="{{ old('ticket_quantity', $ticket->ticket_quantity) }}" readonly />
                                </div>
                            </div>
                           
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="ticket_price">Ticket Price</label>
                                <div class="col-sm-10">
                                    <input type="number" step="0.01" class="form-control" id="ticket_price"
                                        name="ticket_price" value="{{ old('ticket_price', $ticket->ticket_price) }}" readonly />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="total_amount">Total Amount</label>
                                <div class="col-sm-10">
                                    <input type="number" step="0.01" class="form-control" id="total_amount"
                                        name="total_amount" value="{{ old('total_amount', $ticket->total_amount) }}" readonly />
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    @if ($ticket->payment_status != 'paid')
                                        <button type="submit" class="btn btn-primary">Pay Now</button>
                                    @endif
                                    <a href="{{ route('ticket.index') }}" class="btn btn-dark">Back to List</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4" id="eventDetails">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Event Information</h5>
                    </div>
                    <div class="card-body">
                        <div>
                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <label class="col-form-label">Location</label>
                                    <input type="text" class="form-control" id="event_location" value="{{$ticket->event?->location ?? ''}}" readonly />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <label class="col-form-label">Start</label>
                                    <input type="text" class="form-control" id="event_start"  value="{{ \Carbon\Carbon::parse($ticket->event?->start)->format('h:ia \o\n d M, Y') }}"  readonly />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <label class="col-form-label">End</label>
                                    <input type="text" class="form-control" id="event_end" value="{{ \Carbon\Carbon::parse($ticket->event?->end)->format('h:ia \o\n d M, Y') }}"  readonly />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <label class="col-form-label">Event Capacity</label>
                                    <input class="form-control" id="max_event_capacity"  value="{{$ticket->event?->information['max_event_capacity'] ?? ''}}"  readonly />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <label class="col-form-label">Ticket Sold</label>
                                    <input class="form-control" id="ticket_sold" value="{{$ticket->event?->information['ticket_sold'] ?? ''}}"  readonly />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <label class="col-form-label">Payment Status</label>
                                    <input class="form-control" id="payment_status" value="{{$ticket->payment_status ?? ''}}"  readonly />
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
