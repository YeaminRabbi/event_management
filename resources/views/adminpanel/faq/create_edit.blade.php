@extends('adminpanel.layout.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">FAQ/ </span>
            {{ isset($faq) ? 'Edit' : 'Create' }}
        </h4>

        <div class="row">
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">FAQ Information</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ isset($faq) ? route('faq.update', $faq->id) : route('faq.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (isset($faq))
                                @method('PUT')
                            @endif

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-question">Question <span
                                        style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="basic-default-question"
                                        placeholder="Enter Question" name="question"
                                        value="{{ old('question', $faq->question ?? '') }}" required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-answer">Answer <span
                                        style="color: red;">*</span></label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="basic-default-answer" rows="5"
                                        placeholder="Enter Answer" name="answer" required>{{ old('answer', $faq->answer ?? '') }}</textarea>
                                </div>
                            </div>

                            @if (isset($faq))
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-status">Status <span
                                            style="color: red;">*</span></label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="basic-default-status" name="status" required>
                                            <option value="1" {{ $faq->status == 1 ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="0" {{ $faq->status == 0 ? 'selected' : '' }}>Inactive
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            @endif

                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        {{ isset($faq) ? 'Update' : 'Submit' }}
                                    </button>
                                    <a href="{{ route('faq.index') }}" class="btn btn-dark btn-sm">Back to List</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
