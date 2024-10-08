<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Google_Client;

class GoogleClientService
{
    
    public $client;

    public function __construct()
    {
      
    }

    public function refreshGoogleTokenIfNeeded($user)
    {
        if (Carbon::now()->gte($user->token_expiry)) {
            $client = $this->getGoogleClient();
            $client->refreshToken($user->google_refresh_token);

            $newToken = $client->getAccessToken();

            $user->google_access_token = $newToken['access_token'];
            $user->token_expiry = Carbon::now()->addSeconds($newToken['expires_in']);
            $user->save();
        }
    }

    private function getGoogleClient()
    {
        $client = new Google_Client();
        $client->setAuthConfig(storage_path('app/google/credentials.json')); // Path to your credentials.json
        $client->setRedirectUri(route('google.callback'));
        $client->addScope(\Google_Service_Calendar::CALENDAR);
        $client->setAccessType('offline'); // Important for refresh token
        $client->setPrompt('consent'); // Ask for consent each time
        return $client;
    }
    
}