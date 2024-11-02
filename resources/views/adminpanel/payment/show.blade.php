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

        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Payment / </span>Details</h4>
        <div class="row">
                <div class="mb-3">
                    <a href="{{route('payment.index')}}" class="btn btn-sm btn-dark">Back to List</a>
                </div>
                
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Payment Information</h5>
                    </div>
                    <div class="card-body">

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Intent</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ $payment->payment_intent_id }}" readonly />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Session</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{$payment->session_id }}" readonly />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Currency</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ $payment->currency }}" readonly />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Payment Method</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ $payment->payment_method }}" readonly />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Amount Paid</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ $payment->amount_paid }}" readonly />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Staus</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ $payment->payment_status }}" readonly />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">T. Date</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ date('d M, Y | h:ia', strtotime($payment->transaction_date)) }}" readonly />
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

           <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h5 class="mb-0">Card Information</h5>
                            </div>
                            <div class="card-body">
        
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="{{ $payment->customer_name }}" readonly />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="{{ $payment->customer_email }}" readonly />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Card No.</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="{{ $payment->last_four_digits ? '******'. $payment->last_four_digits : 'n/a' }}" readonly />
                                    </div>
                                </div>
        
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h5 class="mb-0">Event Information</h5>
                            </div>
                            <div class="card-body">
        
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="event-summary">Event</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="event-summary" placeholder="Enter Event Name"
                                            name="summary" value="{{ old('summary', $payment->event->summary) }}" readonly />
                                    </div>
                                </div>
        
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="event-location">Location</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="event-location"
                                            placeholder="Enter Event Location" name="location"
                                            value="{{ old('location', $payment->event->location) }}" readonly />
                                    </div>
                                </div>
        
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="event-start">Start Time </label>
                                    <div class="col-sm-10">
                                        <input type="datetime-local" class="form-control" id="event-start" name="start"
                                            value="{{ old('start', \Carbon\Carbon::parse($payment->event->start)->format('Y-m-d\TH:i')) }}"
                                            readonly />
                                    </div>
                                </div>
        
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="event-end">End Time </label>
                                    <div class="col-sm-10">
                                        <input type="datetime-local" class="form-control" id="event-end" name="end"
                                            value="{{ old('end', \Carbon\Carbon::parse($payment->event->end)->format('Y-m-d\TH:i')) }}"
                                            readonly />
                                    </div>
                                </div>
        
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="ticket-price">Ticket Price </label>
                                    <div class="col-sm-10">
                                        <input type="text" step="0.01" min="0" class="form-control" id="ticket-price"
                                            name="ticket_price" placeholder="Enter Ticket Price"
                                            value="{{ old('ticket_price', $payment->event->ticket_price) }}" readonly
                                            pattern="^\d+(\.\d{1,2})?$"
                                            title="Please enter a valid price with up to 2 decimal places" />
                                    </div>
                                </div>
        
                            </div>
                        </div>
                    </div>
        
                </div>
           </div>
            

        </div>
    </div>

@endsection
