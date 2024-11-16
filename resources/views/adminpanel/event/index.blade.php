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
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Event /</span> List</h4>
            </div>
            <div class="my-auto">
                <a href="{{ route('event.create') }}">
                    <button class="btn btn-info rounded-pill">Add Event</button>
                </a>
            </div>
        </div>


        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('event.index') }}" method="GET">
                    <div class="row">
                        
                        <div class="col-md-4 mb-3">
                            <label for="search" class="form-label">Search </label>
                            <input type="text" name="search" id="search" class="form-control"
                                value="{{ request()->input('search') }}" placeholder="Search event info">
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="approve" class="form-label">Approve</label>
                            <select name="approve" id="approve" class="form-control">
                                <option value="" selected disabled>--choose option--</option>
                                <option value="1">Approved</option>
                                <option value="0">Pending</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="" selected disabled>--choose option--</option>
                                <option value="confirmed">Confirmed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="user_id" class="form-label">Oraganizer</label>
                            <select name="user_id" id="user_id" class="form-control">
                                <option value="" selected disabled>--choose option--</option>
                                @if ($users)
                                    @foreach ($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="date_range" class="form-label">Date Range</label>
                            <input type="text" name="date_range" id="date_range" class="form-control"
                                value="{{ request()->input('date_range') }}" placeholder="Select date range">
                        </div>
                        
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a href="{{ route('event.index') }}" class="btn btn-secondary">Reset</a>
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
                        Showing {{ $events->count() }} of {{ $events->total() }} records
                    </div>
                    {{ $events->links() }}
                </div>
                <table class="table" id="DataTable-custom">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Event</th>
                            <th>Status</th>
                            <th>Time & Date (Start/End)</th>
                            <th>Ticket Information</th>
                            <th>Approval</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @if ($events->isNotEmpty())
                            @foreach ($events as $key => $event)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td class="text-wrap">{{ $event->summary }}</td>
                                    <td>
                                        @switch($event->status)
                                            @case('confirmed')
                                                <span class="badge bg-success">Confirmed</span>
                                                @break
                                            @case('tentative')
                                                <span class="badge bg-warning text-dark">Tentative</span>
                                                @break
                                            @case('cancelled')
                                                <span class="badge bg-danger">Cancelled</span>
                                                @break
                                            @default
                                                <span class="badge bg-secondary">Unknown</span>
                                        @endswitch
                                    </td>
                                    <td>
                                        <span class="bg-label-primary p-2 me-1">{{ \Carbon\Carbon::parse($event->start)->format('h:ia \o\n d M, Y') }}</span> <br> <span>-</span></span> <br>
                                        <span class="bg-label-primary p-2 me-1">{{ \Carbon\Carbon::parse($event->end)->format('h:ia \o\n d M, Y') }}</span>
                                        
                                    </td>

                                    <td>    
                                        <span class="fw-bold">Ticket Price: </span>${{number_format($event->ticket_price , 2)}} <br>
                                        <span class="fw-bold">Ticket Capacity: </span>{{$event->information['max_event_capacity'] ?? ''}} <br>
                                        <span class="fw-bold">Ticket Sold: </span>{{$event->information['ticket_sold'] ?? ''}}<br>
                                        <span class="fw-bold">Purchase Limit: </span>{{$event->information['max_ticket_purchase_limit'] ?? ''}}<br>
                                    </td>

                                    <td>
                                        @if ($event->approve == 0)
                                            <span class="badge bg-label-warning">pending</span>
                                        @elseif($event->approve == 1)
                                            <span class="badge bg-label-success">approved</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($event->approve == 0)
                                            <a href="{{ route('event.approve', ['event' => $event->id, 'value' => 'approve']) }}" class="btn btn-warning btn-sm">
                                                <i class="fa fa-thumbs-o-down"></i>
                                            </a>
                                        @elseif($event->approve == 1)
                                            <a href="{{ route('event.approve', ['event' => $event->id, 'value' => 'deny']) }}" class="btn btn-success btn-sm">
                                                <i class="fa fa-thumbs-o-up"></i>
                                            </a>
                                        @endif
                                       
                                        <a href="{{ route('event.edit', $event->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="#"
                                            onclick="if(!confirm('Are you sure you want to delete this event?')){event.preventDefault();}else{document.getElementById('delete-form-{{ $key }}').submit();}"
                                            class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
                                        </a>

                                        <form id="delete-form-{{ $key }}"
                                            action="{{ route('event.destroy', $event->id) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">No events found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="d-flex justify-content-between mb-3">
                    <div>
                        Showing {{ $events->count() }} of {{ $events->total() }} records
                    </div>
                    {{ $events->links() }}
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
