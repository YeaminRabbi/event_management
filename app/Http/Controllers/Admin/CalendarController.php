<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;
use App\Services\GoogleClientService;

class CalendarController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // checking if the user has connected trough google calendar
        if ($user->integration()->exists()) {
            $service = new GoogleClientService();
            // return $service->getCredentials();
            // return $service->initializeGoogleClient();

            return [
                // $service->getCredentials(),
                // $service->initializeGoogleClient(),
                $service->getCalendarData(),
            ];
        }

        return 'no integration';
    }
}
