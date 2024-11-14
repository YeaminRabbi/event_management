<?php

namespace App\Livewire;

use App\Models\Setting;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Settings extends Component
{
    use WithFileUploads;

    public $setting;
    public $group = '';
    public $newGroup = '';
    public $name;
    public $payload_type = 'text';
    public $payload;
    public $existingGroups = [];

    protected $rules = [
        'group' => 'required|string',
        'name' => 'required|string',
        'payload_type' => 'required|in:text,image',
        'payload' => 'required',
    ];

    public function mount()
    {
        $this->existingGroups = Setting::distinct()->pluck('group')->toArray();

        if ($this->setting) {
            $this->group = $this->setting->group;
            $this->name = $this->setting->name;
            $this->payload_type = $this->setting->payload_type;
            $this->payload = $this->setting->payload;
        }
    }

    public function updatedNewGroup($value)
    {
        if (!empty($value)) {
            // Add the new value to group dropdown if it doesn't exist
            if (!in_array($value, $this->existingGroups)) {
                $this->existingGroups[] = $value;
            }
            $this->group = $value;
        }
    }

    public function updatedGroup($value)
    {
        if (!empty($value)) {
            $this->newGroup = $value;
        }
    }

    public function updatedPayloadType()
    {
        // Reset payload when switching types
        $this->reset('payload');
    }

    public function saveSetting()
    {
        $this->validate();

        if ($this->setting) {
            $setting = $this->setting;
        } else {
            $setting = new Setting();
        }

        $setting->group = $this->group;
        $setting->name = $this->name;
        $setting->payload_type = $this->payload_type;

        // if ($this->payload_type === 'image') {
        if ($this->payload_type === 'image' && $this->payload instanceof \Illuminate\Http\UploadedFile) {
            // Delete the previous image if it exists
            if ($setting->payload && Storage::disk('public_uploads')->exists($setting->payload)) {
                Storage::disk('public_uploads')->delete($setting->payload);
            }

            // Generate a unique filename
            $filename = Str::uuid() . '.' . $this->payload->getClientOriginalExtension();

            // Store the new file directly in public/images/settings
            $this->payload->storeAs('images/settings', $filename, 'public_uploads');

            // Save the path relative to the public folder
            $setting->payload = 'images/settings/' . $filename;
        } else {
            // If payload is text, directly assign it
            $setting->payload = $this->payload;
        }

        $setting->save();

        session()->flash('success', 'Setting saved successfully.');

        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.settings');
    }
}
