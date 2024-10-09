<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Google_Client;
use Google_Service_Calendar;

class GoogleClientService
{
    public $user;
    public $client;

    public function __construct()
    {
        $this->user = Auth::user();
        $this->client = $this->initializeGoogleClient();
    }

    public function getUser(){
        return $this->user;
    }

    public function getCredentials()
    {
        return $this->user->integration;
    }

    public function initializeGoogleClient()
    {
        // Retrieve the credentials
        $credentials = $this->getCredentials();

        if (!$credentials) {
            throw new \Exception('No integration found for the user.');
        }

        $client = new Google_Client();
        $client->setApplicationName('Event Management'); // Set your application name
        $client->setScopes(\Google_Service_Calendar::CALENDAR);
        $client->setAccessToken($credentials->credentials);

        // Check if the access token is expired
        if ($client->isAccessTokenExpired()) {
            // Refresh the token if possible
            $refreshToken = $credentials->credentials['refresh_token'];
            
            if ($refreshToken) {
                $client->fetchAccessTokenWithRefreshToken($refreshToken);

                // Update the access token in the database if you want
                $credentials->credentials = $client->getAccessToken();
                $credentials->save(); // Save updated credentials

                // return [
                //     'yes token is expired',
                //     'my refresh token' =>$refreshToken,
                //     'updated credentials' => $credentials,
                //     'new accesstoken from google' => $client->getAccessToken()
                // ];
            } else {
                throw new \Exception('Access token is expired and no refresh token available.');
            }
        }

        // return 1;
        return $client;
    }

    public function getCalendarData($calendarId = 'primary', $timeMin = null, $timeMax = null)
    {
        $service = new Google_Service_Calendar($this->client);

        $optParams = [
            'orderBy' => 'startTime',
            'singleEvents' => true,
            'timeMin' => $timeMin ?: date('c'), // Default to now
            'timeMax' => $timeMax,
        ];

        // Get the calendar events
        $events = $service->events->listEvents($calendarId, $optParams);

        return $events->getItems(); // Returns an array of calendar events
    }


}
