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

        <div class="d-flex justify-content-between">
            <div>
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Ticket /</span> List</h4>
            </div>
            <div class="my-auto">
                <a href="{{ route('ticket.create') }}">
                    <button class="btn btn-info rounded-pill">Purchase Ticket</button>
                </a>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('ticket.index') }}" method="GET">
                    <div class="row">

                        <div class="col-md-3 mb-3">
                            <label for="search" class="form-label">Search </label>
                            <input type="text" name="search" id="search" class="form-control"
                                value="{{ request()->input('search') }}" placeholder="Search ticket info">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="event_id" class="form-label">Events</label>
                            <select name="event_id" id="event_id" class="form-control">
                                <option value="" selected disabled>--choose option--</option>
                                @if ($events)
                                    @foreach ($events as $event)
                                        <option value="{{ $event->id }}">{{ $event->summary }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="date_range" class="form-label">Date Range</label>
                            <input type="text" name="date_range" id="date_range" class="form-control"
                                value="{{ request()->input('date_range') }}" placeholder="Select date range">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="status" class="form-label">Payment Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="" selected disabled>--choose option--</option>
                                <option value="paid">paid</option>
                                <option value="pending">pending</option>
                                <option value="cancelled">cancelled</option>
                            </select>
                        </div>


                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a href="{{ route('ticket.index') }}" class="btn btn-secondary">Reset</a>
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
                        Showing {{ $tickets->count() }} of {{ $tickets->total() }} records
                    </div>
                    {{ $tickets->links() }}
                </div>
                <table class="table" id="DataTable-custom">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Event</th>
                            <th>Ticket Info</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @if ($tickets->isNotEmpty())
                            @foreach ($tickets as $key => $ticket)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $ticket->event->summary }}</td>
                                    <td>
                                        <span class="fw-bold">Name: </span> {{ $ticket->purchase_name }} <br>
                                        <span class="fw-bold">Email: </span> {{ $ticket->purchase_email }} <br>
                                        <span class="fw-bold">Phone: </span> {{ $ticket->purchase_phone }} <br>
                                    </td>
                                    <td>
                                        <span class="fw-bold">Participants: </span> {{ $ticket->ticket_quantity }} <br>
                                        <span class="fw-bold">Ticket Price: </span> {{ $ticket->ticket_price }} <br>
                                        <span class="fw-bold">Total Amount: </span> {{ $ticket->total_amount }} <br>
                                        <span class="fw-bold">Payment Status: </span>
                                        <span
                                            class="badge {{ $ticket->payment_status == 'paid' ? 'bg-success' : ($ticket->payment_status == 'canceled' ? 'bg-danger' : 'bg-warning') }}">
                                            {{ ucfirst($ticket->payment_status) }}
                                        </span>

                                        <br>

                                    </td>


                                    <td>
                                        <a href="{{ route('ticket.edit', $ticket->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="#"
                                            onclick="if(!confirm('Are you sure you want to delete this ticket?')){event.preventDefault();}else{document.getElementById('delete-form-{{ $key }}').submit();}"
                                            class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
                                        </a>

                                        <form id="delete-form-{{ $key }}"
                                            action="{{ route('ticket.destroy', $ticket->id) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">No purchased tickets found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="d-flex justify-content-between mb-3">
                    <div>
                        Showing {{ $tickets->count() }} of {{ $tickets->total() }} records
                    </div>
                    {{ $tickets->links() }}
                </div>
            </div>
        </div>
        <!--/ Basic Bootstrap Table -->
    </div>
@endsection

@section('js')
    <!-- Include jQuery -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <!-- Include Moment.js -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <!-- Include Date Range Picker -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


    {{-- this is the select2 cdn code, need to be furnish for the select tag coz it is breaking the basic design --}}
    {{-- need to reconstruct --}}


    {{-- <!-- Include Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Include Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Select2 for the event select tag
            $('#event_id').select2({
                placeholder: '--choose option--',
                allowClear: true,
                width: '100%' // Ensure it takes the full width and aligns with other form elements.
            });

            // Initialize date range picker
            $('input[name="date_range"]').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            });

            $('input[name="date_range"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format(
                    'MM/DD/YYYY'));
            });

            $('input[name="date_range"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });
        });
    </script> --}}
@endsection
