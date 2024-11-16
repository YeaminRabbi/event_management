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

        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Event / </span> Edit</h4>
        <div class="row">
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Edit Event Information</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('event.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="event-summary">Event Name <span style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="event-summary" placeholder="Enter Event Name"
                                        name="summary" value="{{ old('summary', $event->summary) }}" required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="event-type">Event Type <span style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="event-type" name="event_type" required>
                                        <option value="" disabled selected>--select one--</option>
                                        <option value="Conference" {{ old('event_type', $event->event_type) == 'Conference' ? 'selected' : '' }}>Conference</option>
                                        <option value="Play Ground" {{ old('event_type', $event->event_type) == 'Play Ground' ? 'selected' : '' }}>Play Ground</option>
                                        <option value="Musical" {{ old('event_type', $event->event_type) == 'Musical' ? 'selected' : '' }}>Musical</option>
                                        <option value="Other" {{ old('event_type', $event->event_type) == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="event-location">Location</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="event-location" placeholder="Enter Event Location"
                                        name="location" value="{{ old('location', $event->location) }}" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="event-start">Start Time <span style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <input type="datetime-local" class="form-control" id="event-start" name="start"
                                        value="{{ old('start', \Carbon\Carbon::parse($event->start)->format('Y-m-d\TH:i')) }}" required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="event-end">End Time <span style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <input type="datetime-local" class="form-control" id="event-end" name="end"
                                        value="{{ old('end', \Carbon\Carbon::parse($event->end)->format('Y-m-d\TH:i')) }}" required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="ticket-price">Ticket Price <span style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <input type="number" step="0.01" min="0" class="form-control" id="ticket-price" name="ticket_price"
                                        placeholder="Enter Ticket Price" value="{{ old('ticket_price', $event->ticket_price) }}" required
                                        pattern="^\d+(\.\d{1,2})?$" title="Please enter a valid price with up to 2 decimal places" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="event-description">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="event-description" placeholder="Enter Event Description" name="description"
                                        rows="3">{{ old('description', $event->description) }}</textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="event-status">Status <span style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="event-status" name="status">
                                        <option value="confirmed" {{ old('status', $event->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="cancelled" {{ old('status', $event->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="event-image">Image <span style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="event-image" name="file" required>
                                    @if ($event->image)
                                        <img src="{{ asset($event->image->url) }}" alt="Event Image" width="200px" class="mt-2">
                                    @endif
                                </div>
                            </div>

                            <hr class="my-4">
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="max_ticket_purchase_limit">Max Ticket Purchase Limit <span style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <input type="number" min="1" class="form-control" id="max_ticket_purchase_limit" name="information[max_ticket_purchase_limit]"
                                        placeholder="Enter max ticket limit per person" value="{{ old('information.max_ticket_purchase_limit', $event->information['max_ticket_purchase_limit'] ?? '') }}"  required/>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="max_event_capacity">Max Event Capacity <span style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <input type="number" min="1" class="form-control" id="max_event_capacity" name="information[max_event_capacity]"
                                        placeholder="Enter max event capacity" value="{{ old('information.max_event_capacity', $event->information['max_event_capacity'] ?? '') }}" required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="min_age_requirement">Minimum Age Requirement</label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" class="form-control" id="min_age_requirement" name="information[min_age_requirement]"
                                        placeholder="Enter minimum age requirement" value="{{ old('information.min_age_requirement', $event->information['min_age_requirement'] ?? '') }}" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="ticket_sold">Ticket Sold</label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" value="{{ old('information.ticket_sold', $event->information['ticket_sold'] ?? '') }}" class="form-control" id="ticket_sold" name="information[ticket_sold]" placeholder="Enter max event capacity" required/>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="refund_policy">Refund Policy</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="refund_policy" placeholder="Enter refund policy details"
                                        name="information[refund_policy]" rows="3">{{ old('information.refund_policy', $event->information['refund_policy'] ?? '') }}</textarea>
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                    <a href="{{ route('event.index') }}" class="btn btn-dark btn-sm">Back to List</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
<script>
    $('#notificationAlert').delay(3000).fadeOut('slow');
</script>
@endsection
