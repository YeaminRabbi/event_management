@extends('adminpanel.layout.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div id="customFlash" class="custom-flash" style="display: none;">
            <div class="flash-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
            </div>
            <div class="flash-content">
                <div class="flash-title">Success</div>
                <div class="flash-message" id="flashMessage"></div>
            </div>
            <div class="flash-progress">
                <div class="flash-progress-bar" id="flashProgressBar"></div>
            </div>
        </div>
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">About Us/ </span>
            {{ isset($aboutUs) ? 'Edit' : 'Create' }}
        </h4>
        <form action="{{ isset($aboutUs) ? route('about-us.store', $aboutUs->id) : route('about-us.store') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $aboutUs->id ?? '' }}">
            <div class="row">
                <div class="col-md-7">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">About Us Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-title">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="basic-default-title"
                                        placeholder="Enter Title" name="title"
                                        value="{{ old('title', $aboutUs->title ?? '') }}" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-description">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="basic-default-description" rows="3" placeholder="Enter Description"
                                        name="description">{{ old('description', $aboutUs->description ?? '') }}</textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-mission">Mission</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="basic-default-mission" rows="3" placeholder="Enter Mission" name="mission">{{ old('mission', $aboutUs->mission ?? '') }}</textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-vision">Vision</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="basic-default-vision" rows="3" placeholder="Enter Vision" name="vision">{{ old('vision', $aboutUs->vision ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary btn-sm">
                                {{ isset($banner) ? 'Update' : 'Submit' }}
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Advantages</h5>
                        </div>
                        <div class="card-body">
                            <div id="advantages" class="row g-4">
                                @foreach ($aboutUs->advantages ?? [] as $key => $advantage)
                                    <div class="d-flex align-items-center">
                                        <input type="text" class="form-control"
                                            name="advantages[{{ $key }}][icon]" value="{{ $advantage->icon }}"
                                            placeholder="Icon">
                                        <input type="text" class="form-control flex-grow-1 mx-2"
                                            name="advantages[{{ $key }}][title]" value="{{ $advantage->title }}"
                                            placeholder="Title">
                                        <button type="button" class="btn btn-outline-danger btn-sm delete-advantage"
                                            data-advantage-id="{{ $advantage->id }}">Delete</button>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-primary btn-sm mt-3" onclick="addAdvantage()">Add
                                Advantage</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this advantage?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger delete-confirmed">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        let modal;

        function addAdvantage() {
            const advantagesDiv = document.getElementById('advantages');
            const index = advantagesDiv.children.length;
            const div = document.createElement('div');
            div.innerHTML = `
                <div class="d-flex align-items-center">
                    <input type="text" class="form-control" name="advantages[${index}][icon]" placeholder="Icon">
                    <input type="text" class="form-control flex-grow-1 mx-2" name="advantages[${index}][title]" placeholder="Title">
                    <button type="button" class="btn btn-outline-danger btn-sm delete-advantage">Delete</button>
                </div>
            `;
            advantagesDiv.appendChild(div);

            // Add event listener for delete button
            div.querySelector('.delete-advantage').addEventListener('click', () => {
                showDeleteConfirmation(div);
            });
        }

        function showDeleteConfirmation(element) {
            const deleteButton = modal._element.querySelector('.delete-confirmed');
            // Get the advantage ID from the element (e.g., a hidden input or data attribute)
            const advantageId = element.querySelector('.delete-advantage').dataset.advantageId;

            // Set the advantage ID on the delete-confirmed button
            deleteButton.dataset.advantageId = advantageId || '';


            deleteButton.addEventListener('click', (event) => {
                const id = event.target.dataset.advantageId;
                if (id) {
                    axios.delete(`/admin/about-us/advantages/${advantageId}`)
                        .then(data => {
                            element.remove();
                            // flash().success('Advantage deleted successfully');
                            modal.hide();
                            // console.log(data.data.message); 
                            showFlashMessage(data.data.message, 'warning');
                        })
                        .catch(error => {
                            // flash().error('Error deleting advantage');
                            console.error(error);
                            modal.hide();
                            showFlashMessage('Failed to update status', 'error');
                        });
                } else {
                    element.remove();
                    // flash().success('Advantage deleted successfully');
                    modal.hide();
                }
            });

            modal.show();
        }

        function showFlashMessage(message, type = 'success') {
            const flash = document.getElementById('customFlash');
            const messageSpan = document.getElementById('flashMessage');
            const progressBar = document.getElementById('flashProgressBar');
            const duration = 3000; // 3 seconds

            // Set message and style
            messageSpan.textContent = message;
            flash.className = 'custom-flash';
            flash.classList.add(`flash-${type}`);

            // Show the message
            flash.style.display = 'flex';

            // Animate progress bar
            progressBar.style.width = '100%';
            progressBar.style.transition = `width ${duration}ms linear`;
            setTimeout(() => {
                progressBar.style.width = '0%';
            }, 100);

            // Hide after duration
            setTimeout(() => {
                flash.classList.add('flash-hide');
                setTimeout(() => {
                    flash.style.display = 'none';
                    flash.classList.remove('flash-hide');
                    progressBar.style.width = '100%';
                    progressBar.style.transition = 'none';
                }, 300);
            }, duration);
        }

        document.addEventListener('DOMContentLoaded', () => {
            modal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));

            // Add event listener for delete buttons on existing advantage items
            document.querySelectorAll('.delete-advantage').forEach(btn => {
                btn.addEventListener('click', () => {
                    const element = btn.closest('.d-flex');
                    showDeleteConfirmation(element);
                });
            });
        });
    </script>
@endsection
