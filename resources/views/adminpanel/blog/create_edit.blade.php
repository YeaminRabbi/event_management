@extends('adminpanel.layout.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Blog/ </span>
            {{ isset($blog) ? 'Edit' : 'Create' }}
        </h4>

        <div class="row">
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Blog Information</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ isset($blog) ? route('blog.update', $blog->slug) : route('blog.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (isset($blog))
                                @method('PUT')
                            @endif

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-title">Title <span
                                        style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="basic-default-title"
                                        placeholder="Enter Title" name="title"
                                        value="{{ old('title', $blog->title ?? '') }}" required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-category">Category <span
                                        style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="basic-default-category"
                                        placeholder="Enter Category" name="category"
                                        value="{{ old('category', $blog->category ?? '') }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-image">Image <span
                                        style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="basic-default-image" name="file"
                                        {{ isset($blog) ? '' : 'required' }}>
                                </div>
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10 mt-2">
                                    <img id="preview-image"
                                        src="{{ isset($blog) && $blog->image->url ? asset($blog->image->url) : '' }}"
                                        alt="preview image"
                                        style="max-height: 200px; display: {{ isset($blog) && $blog->image ? 'block' : 'none' }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="editor">Description <span
                                        style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <div id="toolbar-container"></div>
                                    <div id="editor" class="form-control">{!! $blog->description ?? '' !!}</div>
                                    <textarea id="editor-content" name="description" class="d-none" required tabindex="-1" placeholder="Enter Description">{!! $blog->description ?? '' !!}</textarea>
                                    <div id="description-error" class="invalid-feedback" style="display: none;">
                                        This field is required.
                                    </div>
                                </div>
                            </div>

                            @if (isset($blog))
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-status">Status <span
                                            style="color: red;">*</span></label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="basic-default-status" name="status" required>
                                            <option value="1" {{ $blog->status == 1 ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="0" {{ $blog->status == 0 ? 'selected' : '' }}>Inactive
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            @endif

                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        {{ isset($blog) ? 'Update' : 'Submit' }}
                                    </button>
                                    <a href="{{ route('blog.index') }}" class="btn btn-dark btn-sm">Back to List</a>
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
