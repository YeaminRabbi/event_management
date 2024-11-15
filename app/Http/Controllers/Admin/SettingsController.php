<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::latest()->get();
        return view('adminpanel.settings.index', compact('settings'));
    }

    public function create()
    {
        return view('adminpanel.settings.create_edit');
    }

    public function edit(Setting $setting)
    {
        return view('adminpanel.settings.create_edit', compact('setting'));
    }

    public function destroy(Setting $setting)
    {
        if ($setting->payload_type === 'image') {
            if (file_exists(public_path($setting->payload))) {
                unlink(public_path($setting->payload));
            }
        }
        $setting->delete();

        flash()
            ->option('position', 'bottom-right')
            ->warning('Setting deleted successfully');
        return redirect()->back();
    }
}
