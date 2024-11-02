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
        <div class="d-flex justify-content-between">
            <div>
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Payment /</span> List</h4>
            </div>
            <div class="my-auto">
                <a href="{{ route('ticket.create') }}">
                    <button class="btn btn-info rounded-pill">Purchase Ticket</button>
                </a>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('payment.index') }}" method="GET">
                    <div class="row">
                        
                        <div class="col-md-3 mb-3">
                            <label for="search" class="form-label">Search </label>
                            <input type="text" name="search" id="search" class="form-control"
                                value="{{ request()->input('search') }}" placeholder="Search payment info">
                        </div>
                   
                        <div class="col-md-3 mb-3">
                            <label for="payment_status" class="form-label">Payment Status</label>
                            <select name="payment_status" id="payment_status" class="form-control">
                                <option value="" selected disabled>--choose option--</option>
                                <option value="paid">paid</option>
                                <option value="pending">pending</option>
                                <option value="cancelled">cancelled</option>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="event_id" class="form-label">Events</label>
                            <select name="event_id" id="event_id" class="form-control">
                                <option value="" selected disabled>--choose option--</option>
                                @if ($events)
                                    @foreach ($events as $event)
                                        <option value="{{$event->id}}">{{$event->summary}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="date_range" class="form-label">Date Range</label>
                            <input type="text" name="date_range" id="date_range" class="form-control"
                                value="{{ request()->input('date_range') }}" placeholder="Select date range">
                        </div>
                        
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a href="{{ route('payment.index') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="table-responsive text-nowrap p-4">
                <div class="d-flex justify-content-between mb-3">
                    <div>
                        Showing {{ $payments->count() }} of {{ $payments->total() }} records
                    </div>
                    {{ $payments->links() }}
                </div>
                <table class="table" id="DataTable-custom">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Ticket Info</th>
                            <th>Payment</th>
                            <th>Event</th>
                            <th>Card Info</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @if ($payments->isNotEmpty())
                            @foreach ($payments as $key => $payment)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <span class="fw-bold">Name: </span> {{ $payment->ticket->purchase_name }} <br>
                                        <span class="fw-bold">Email: </span> {{ $payment->ticket->purchase_email }} <br>
                                        <span class="fw-bold">Phone: </span> {{ $payment->ticket->purchase_phone ?? 'N/A' }} <br>
                                        <span class="fw-bold">Participants: </span> {{ $payment->ticket->ticket_quantity }} <br>
                                    </td>
                                    <td>
                                        <span class="fw-bold">Ticket Price: </span> {{ $payment->ticket->ticket_price }} <br>
                                        <span class="fw-bold">Total Amount: </span> {{ $payment->ticket->total_amount }} <br>

                                        <span class="fw-bold">Status: </span>
                                        <span
                                            class="badge {{ $payment->ticket->payment_status == 'paid' ? 'bg-success' : ($payment->ticket->payment_status == 'canceled' ? 'bg-danger' : 'bg-warning') }}">
                                            {{ ucfirst($payment->ticket->payment_status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="fw-bold text-wrap">Event: </span> {{ \Illuminate\Support\Str::limit($payment->event->summary, 30) }} <br>
                                        <span class="fw-bold">Organizer: </span> {{ $payment->event->organizer->name }} <br>
                                    </td>
                                    <td>
                                        <span class="fw-bold">Name: </span> {{ $payment->customer_name }} <br>
                                        <span class="fw-bold">Email: </span> {{ $payment->customer_email }} <br>
                                        <span class="fw-bold">Method: </span> {{ $payment->payment_method }} <br>
                                        <span class="fw-bold">Currency: </span> {{ $payment->currency }} <br>
                                        <span class="fw-bold">Transaction: </span> {{ date('d M, Y | h:ia', strtotime($payment->transaction_date)) }} <br>
                                        <span class="fw-bold">Card no: </span> {{ $payment->last_four_digits ? '******'. $payment->last_four_digits : 'n/a' }} <br>
                                    </td>
                                    <td>
                                        <a href="{{ route('payment.show', ['payment' => $payment->id]) }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">No payments found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="d-flex justify-content-between mb-3">
                    <div>
                        Showing {{ $payments->count() }} of {{ $payments->total() }} records
                    </div>
                    {{ $payments->links() }}
                </div>
            </div>
        </div>
        <!--/ Basic Bootstrap Table -->
    </div>
@endsection


@section('js')
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script>
    $(function () {
        $('input[name="date_range"]').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });

        $('input[name="date_range"]').on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format(
                'MM/DD/YYYY'));
        });

        $('input[name="date_range"]').on('cancel.daterangepicker', function (ev, picker) {
            $(this).val('');
        });
    });

</script>
@endsection
