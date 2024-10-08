@extends('adminpanel.layout.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="pb-1 mb-4">Integrations</h5>
        <div class="row mb-5">
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img class="card-img card-img-left" src="{{ asset('adminpanel/assets/img/illustrations/google_calendar.png') }}" alt="Google Calendar Image" />
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Google Calendar</h5>
                                <p class="card-text">
                                    Integrating Google Calendar boosts productivity by streamlining event management, allowing users to access all schedules in one place for better time management.
                                </p>
                               
                                <div class="d-flex justify-content-between">

                                    @if (!$integration)
                                        <a href="{{route('google.redirect')}}" class="btn btn-primary">Connect Google Calendar</a>
                                    @else
                                        <form action="{{route('integration.destroy', $integration->id)}}" method="POST" onsubmit="return confirm('Are you sure you want to remove the integration?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Remove Integration</button>
                                        </form> 
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
