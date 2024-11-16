<?php

namespace App\Helpers;

use App\Models\Setting;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Frontend
{

    // public static function footerSettings($group, $key){
    //     return Settings::where('group', $group)->where('name', $key)->first()->payload ?? null;
    // }
    public static function Settings($group, $key)
    {
        $setting = Setting::where('group', $group)->where('name', $key)->first();
        if ($setting && $setting->payload) {
            $payload = $setting->payload;
            // Check if payload is an array and return the first value
            if (is_array($payload)) {
                return reset($payload);
            }
            // Return the payload directly if it's not an array
            return $payload;
        }
        return null;
    }


    public static function getEventTypeIcon($type)
    {
        return match ($type) {
            'conference' => 'microphone',
            'play-ground' => 'birthday-cake',
            'musical' => 'music',
            'other' => 'check-square',
            default => 'calendar',
        };
    }
}
