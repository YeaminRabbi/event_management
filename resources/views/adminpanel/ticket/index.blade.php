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

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="table-responsive text-nowrap p-4">
                <table class="table" id="DataTable">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Event</th>
                            <th>Participant Info</th>
                            <th>Ticket Info</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @if ($tickets->isNotEmpty())
                            @foreach ($tickets as $key => $ticket)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $ticket->event->summary }}</td>
                                    <td>{{ $ticket->ticket_count() }}</td>
                                    <td>
                                        <span class="fw-bold">Name: </span> {{$ticket->purchase_name}} <br>
                                        <span class="fw-bold">Email: </span> {{$ticket->purchase_email}} <br>
                                        <span class="fw-bold">Phone: </span> {{$ticket->purchase_phone}} <br>
                                    </td>
                                    <td>
                                        <span class="fw-bold">Ticket Sold: </span> {{$ticket->ticket_quantity}} <br>
                                        <span class="fw-bold">Ticket Price: </span> {{$ticket->ticket_price}} <br>
                                        <span class="fw-bold">Total Amount: </span> {{$ticket->total_amount}} <br>
                                        <span class="fw-bold">Payment Status: </span> 
                                        <span class="badge {{ $ticket->payment_status == 'paid' ? 'bg-success' : 'bg-danger' }}">
                                            {{ ucfirst($ticket->payment_status) }}
                                        </span>
                                        <br>

                                    </td>
                                    

                                    {{-- <td>
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
                                    </td> --}}
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">No purchased tickets found.</td>
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
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css"> --}}
@endsection

@section('js')
    {{-- <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#DataTable').DataTable();
        });
    </script> --}}
@endsection
