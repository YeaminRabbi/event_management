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
        @endif
        <!-- Notification div -->
        <div class="row">
            <div class="col-md-12">
                <div id="notificationAlert" style="display: none;">
                    <div class="alert alert-warning">
                        <span style="color:black;" id="notificationMessage"></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <div>
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Banner /</span> list</h4>
            </div>
            <div class="my-auto">
                <a href="{{ route('banner.create') }}">
                    <button class="btn btn-info rounded-pill">Add Banner</button>
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
                            <th>Image</th>
                            <th>Title</th>
                            <th>Sub Title</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @if ($banners->isNotEmpty())
                            @foreach ($banners as $key => $data)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <img src="{{ asset($data->image->url) }}" alt="Banner Image" width="100px">
                                    </td>
                                    <td>{{ $data->title ?? '' }}</td>
                                    <td>{{ $data->sub_title ?? '' }}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input banner-status-toggle" type="checkbox"
                                                id="flexSwitchCheckDefault{{ $data->id }}"
                                                data-banner-id="{{ $data->slug }}" {{ $data->status ? 'checked' : '' }}>
                                        </div>
                                    </td>

                                    <td>
                                        <a href="{{ route('banner.edit', $data->slug) }}"
                                            class="btn btn-primary btn-sm">Edit</a>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $data->slug }}">
                                            Delete
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="deleteModal{{ $data->slug }}" tabindex="-1"
                                            aria-labelledby="deleteModalLabel{{ $data->slug }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel{{ $data->slug }}">
                                                            Confirm Delete</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this banner?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <form action="{{ route('banner.destroy', $data->slug) }}"
                                                            method="POST" style="display: inline-block">
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggles = document.querySelectorAll('.banner-status-toggle');
            const csrfToken = document.querySelector('input[name="_token"]').value;

            toggles.forEach(toggle => {
                toggle.addEventListener('change', function() {
                    const bannerId = this.dataset.bannerId;
                    const isChecked = this.checked;

                    // Updated URL to include 'admin' prefix
                    fetch(`/admin/banners/${bannerId}/toggle-status`, {
                            method: 'PUT',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                status: isChecked
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                // Optional: Show success message using toastr or other notification library
                                // console.log('Status updated successfully');
                                // i want 
                            } else {
                                this.checked = !isChecked;
                                console.error('Failed to update status');
                            }
                        })
                        .catch(error => {
                            this.checked = !isChecked;
                            console.error('Error:', error);
                        });
                });
            });
        });
    </script>
@endsection
