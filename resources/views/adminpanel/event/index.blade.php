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

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="table-responsive text-nowrap p-4">
                <table class="table" id="DataTable">
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
                                                <i class="fa fa-thumbs-o-up"></i>
                                            </a>
                                        @elseif($event->approve == 1)
                                            <a href="{{ route('event.approve', ['event' => $event->id, 'value' => 'deny']) }}" class="btn btn-danger btn-sm">
                                                <i class="fa fa-thumbs-o-down"></i>
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
            </div>
        </div>
        <!--/ Basic Bootstrap Table -->
    </div>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#DataTable').DataTable();
        });
    </script>
@endsection
