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

        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Event / </span> Create</h4>
        <div class="row">
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Event Information</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('event.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="event-summary">Event Name <span
                                        style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="event-summary"
                                        placeholder="Enter Event Name" name="summary" required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="event-location">Location</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="event-location"
                                        placeholder="Enter Event Location" name="location" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="event-start">Start Time <span
                                        style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <input type="datetime-local" class="form-control" id="event-start" name="start"
                                        required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="event-end">End Time <span
                                        style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <input type="datetime-local" class="form-control" id="event-end" name="end"
                                        required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="ticket-price">Ticket Price <span style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <input type="number" step="0.01" min="0" class="form-control" id="ticket-price" name="ticket_price" placeholder="Enter Ticket Price" required pattern="^\d+(\.\d{1,2})?$" title="Please enter a valid price with up to 2 decimal places" />
                                </div>
                            </div>
                            

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="event-description">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="event-description" placeholder="Enter Event Description" name="description"
                                        rows="3"></textarea>
                                </div>
                            </div>


                            {{-- <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="event-attendees">Attendees (JSON format)</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="event-attendees" placeholder='Enter Attendees JSON e.g. [{"email":"attendee1@example.com"},{"email":"attendee2@example.com"}]' name="attendees" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="event-reminders">Reminders (JSON format)</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="event-reminders" placeholder='Enter Reminders JSON e.g. [{"method":"email","minutes":10}]' name="reminders" rows="3"></textarea>
                            </div>
                        </div> --}}

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="event-status">Status <span
                                    style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="event-status" name="status">
                                        <option value="" disabled selected>--select one--</option>
                                        <option value="confirmed">Confirmed</option>
                                        <option value="cancelled">Cancelled</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="event-image">Image</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="event-image" name="file" />
                                </div>
                            </div>

                            <hr class="my-4">
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="max_ticket_purchase_limit">Max Ticket Purchase Limit <span style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <input type="number" min="1" class="form-control" id="max_ticket_purchase_limit" name="information[max_ticket_purchase_limit]" placeholder="Enter max ticket limit per person" required />
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="max_event_capacity">Max Event Capacity <span style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <input type="number" min="1" class="form-control" id="max_event_capacity" name="information[max_event_capacity]" placeholder="Enter max event capacity" required/>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="min_age_requirement">Minimum Age Requirement</label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" class="form-control" id="min_age_requirement" name="information[min_age_requirement]" placeholder="Enter minimum age requirement" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="ticket_sold">Ticket Sold</label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" value="0" class="form-control" id="ticket_sold" name="information[ticket_sold]" placeholder="Enter max event capacity" required/>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="refund_policy">Refund Policy</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="refund_policy" placeholder="Enter refund policy details" name="information[refund_policy]" rows="3"></textarea>
                                </div>
                            </div>
                            
                           
                            
                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
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