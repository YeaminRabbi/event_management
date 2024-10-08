<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Google_Client;
use App\Models\User;
use App\Models\Integration;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class GoogleCalendarController extends Controller
{
    public function redirectToGoogle()
    {
        $client = $this->getGoogleClient();
        $authUrl = $client->createAuthUrl(); // Generates the URL to redirect user to Google consent screen

        return redirect()->away($authUrl);
    }

    public function handleGoogleCallback(Request $request)
    {

        $client = $this->getGoogleClient();

        // Exchange the auth code for access token
        $client->fetchAccessTokenWithAuthCode($request->input('code'));

        $token = $client->getAccessToken();

        // Add 'calendar' => 'primary' to the token array
        $token['calendar'] = 'primary';

        // Save tokens and calendar ID to the authenticated user
        $integration = Integration::firstOrCreate(
            [
                'user_id' => Auth::id(),           // Check for existing user_id and platform
                'platform' => 'google-calendar'
            ],
            [
                'credentials' => $token,           // If not found, create with these attributes
                'status' => 1
            ]
        );

        if (!$integration) {
            abort(500, 'Something went wrong');
        }

        return redirect()->route('integration.index'); // Redirect back to user dashboard
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
