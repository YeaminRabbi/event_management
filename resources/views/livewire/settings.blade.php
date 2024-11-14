<div>
    @if (session()->has('success'))
        <div class="row">
            <div class="col-md-12">
                <div id="notificationAlert" style="display: block;">
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        </div>
    @endif
    <form wire:submit.prevent="saveSetting">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="group">Group <span style="color: red;">*</span></label>
                            <select wire:model.live="group" id="group" class="form-control" required>
                                <option value="">Select Group</option>
                                @foreach ($existingGroups as $existingGroup)
                                    <option value="{{ $existingGroup }}"
                                        @if ($existingGroup === $newGroup) selected @endif>
                                        {{ $existingGroup }}
                                    </option>
                                @endforeach
                                @if (!empty($newGroup) && !in_array($newGroup, $existingGroups))
                                    <option value="{{ $newGroup }}">{{ $newGroup }}</option>
                                @endif
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="newGroup">New Group</label>
                            <input wire:model.live="newGroup" type="text" id="newGroup" class="form-control"
                                placeholder="Enter new group name">
                        </div>

                        <div class="form-group mt-3">
                            <label for="name">Name <span style="color: red;">*</span></label>
                            <input wire:model="name" type="text" id="name" class="form-control"
                                placeholder="Enter name" required>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="btn btn-{{ isset($setting) ? 'success' : 'primary' }} mt-4">
                        {{ isset($setting) ? 'Update' : 'Create' }}
                    </button>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group mt-3">
                            <label for="payload_type">Payload Type <span style="color: red;">*</span></label>
                            <select wire:model.live="payload_type" id="payload_type" class="form-control" required>
                                <option value="text">Text</option>
                                <option value="image">Image</option>
                            </select>
                            @error('payload_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            @if ($payload_type === 'text')
                                <div>
                                    <label for="text_payload">Text <span style="color: red;">*</span></label>
                                    <textarea wire:model="payload" type="text" id="text_payload" class="form-control" placeholder="Enter text" required></textarea>
                                </div>
                            @endif

                            @if ($payload_type === 'image')
                                <div>
                                    <label for="image_payload">Image <span style="color: red;">*</span></label>
                                    <input wire:model="payload" type="file" id="image_payload" class="form-control"
                                        accept="image/*" required>
                                    @if ($payload && method_exists($payload, 'temporaryUrl'))
                                        <img src="{{ $payload->temporaryUrl() }}" alt="Preview"
                                            class="img-thumbnail mt-3" style="max-width: 200px">
                                    @endif
                                </div>
                            @endif
                            @error('payload')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @if (isset($setting) && $setting->payload_type === 'image')
                                <div class="mt-3">
                                    <label for="image_payload">Current Image</label>
                                    <img src="{{ asset($setting->payload) }}" alt="Current Image"
                                        class="img-thumbnail mt-3" style="max-width: 200px">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(function() {
                    const notificationAlert = document.getElementById('notificationAlert');
                    if (notificationAlert) {
                        notificationAlert.style.display = 'none';
                    }
                }, 3000);
            });
        </script>
    @endpush
</div>
