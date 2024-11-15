@extends('adminpanel.layout.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Banner/ </span>
            {{ isset($banner) ? 'Edit' : 'Create' }}
        </h4>

        <div class="row">
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Banner Information</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ isset($banner) ? route('banner.update', $banner->slug) : route('banner.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (isset($banner))
                                @method('PUT')
                            @endif

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-title">Title <span
                                        style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="basic-default-title"
                                        placeholder="Enter Title" name="title"
                                        value="{{ old('title', $banner->title ?? '') }}" required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-sub-title">Sub Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="basic-default-sub-title"
                                        placeholder="Enter Sub Title" name="sub_title"
                                        value="{{ old('sub_title', $banner->sub_title ?? '') }}" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-image">Image <span
                                        style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="basic-default-image" name="file"
                                        {{ isset($banner) ? '' : 'required' }}>
                                </div>
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10 mt-2">
                                    <img id="preview-image"
                                        src="{{ isset($banner) && $banner->image->url ? asset($banner->image->url) : '' }}"
                                        alt="preview image"
                                        style="max-height: 200px; display: {{ isset($banner) && $banner->image ? 'block' : 'none' }}">
                                </div>
                            </div>

                            @if (isset($banner))
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-status">Status <span
                                            style="color: red;">*</span></label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="basic-default-status" name="status" required>
                                            <option value="1" {{ $banner->status == 1 ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="0" {{ $banner->status == 0 ? 'selected' : '' }}>Inactive
                                            </option>
                                        </select>
                                        {{-- <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="status" {{ $banner->status == true ? 'checked' : '' }}>
                                        </div> --}}
                                    </div>

                                </div>
                            @endif

                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        {{ isset($banner) ? 'Update' : 'Submit' }}
                                    </button>
                                    <a href="{{ route('banner.index') }}" class="btn btn-dark btn-sm">Back to List</a>
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
        // $('#notificationAlert').delay(3000).fadeOut('slow');

        // Image Preview
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview-image').attr('src', e.target.result);
                    $('#preview-image').css('display', 'block');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#basic-default-image').change(function() {
            readURL(this);
        });
    </script>
@endsection
