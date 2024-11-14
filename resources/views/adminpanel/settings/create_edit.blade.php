@extends('adminpanel.layout.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between">
            <div>
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Settings /</span>
                    {{ isset($setting) ? 'Edit' : 'Create' }}</h4>
            </div>
            <div class="my-auto">
                <a href="{{ route('settings.index') }}">
                    <button class="btn btn-info rounded-pill">Back to List</button>
                </a>
            </div>
        </div>

        @if (isset($setting))
            @livewire('settings', ['setting' => $setting]) <!-- Include the Livewire component -->
        @else
            @livewire('settings') <!-- Include the Livewire component -->
        @endif
    </div>
@endsection

@section('js')
    <script>
        setTimeout(function() {
            $('#notificationAlert').fadeOut('fast');
        }, 3000);
    </script>
@endsection
