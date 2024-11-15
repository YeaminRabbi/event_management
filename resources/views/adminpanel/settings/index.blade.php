@extends('adminpanel.layout.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- @if (\Session::has('success'))
            <div class="row">
                <div class="col-md-12">
                    <div id="notificationAlert" style="display: block;">
                        <div class="alert alert-success">
                            <span style="color:black;">
                                {!! \Session::get('success') !!}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (\Session::has('warning'))
            <div class="row">
                <div class="col-md-12">
                    <div id="notificationAlert" style="display: block;">
                        <div class="alert alert-warning">
                            <span style="color:black;">
                                {!! \Session::get('warning') !!}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endif --}}

        <div class="d-flex justify-content-between">
            <div>
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Settings /</span> list</h4>
            </div>
            <div class="my-auto">
                <a href="{{ route('settings.create') }}">
                    <button class="btn btn-info rounded-pill">Add new Settings</button>
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
                            <th>Group</th>
                            <th>Name</th>
                            <th>Payload</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @if ($settings->isNotEmpty())
                            @foreach ($settings as $key => $data)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $data->group ?? '' }}</td>
                                    <td>{{ $data->name ?? '' }}</td>
                                    <td>
                                        @if ($data->payload_type === 'text')
                                            {{ $data->payload }}
                                        @else
                                            <img src="{{ asset($data->payload) }}" alt="Image" width="50">
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('settings.edit', $data->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $data->id }}">
                                            Delete
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="deleteModal{{ $data->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $data->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel{{ $data->id }}">Confirm Delete</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this setting?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <form action="{{ route('settings.destroy', $data->id) }}" method="POST" style="display: inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
        <!--/ Basic Bootstrap Table -->



    </div>
@endsection


@section('js')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#DataTable').DataTable();
        });
    </script>
    {{-- <script>
        setTimeout(function() {
            $('#notificationAlert').fadeOut('fast');
        }, 3000);
    </script> --}}
@endsection
