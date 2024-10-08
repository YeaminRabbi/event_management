<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Notifications\Contact as ContactNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminMailService
{
    
    public $adminEmails;

    public function __construct()
    {
        $this->adminEmails = User::whereHas('roles', function($query) {
            $query->where('name', 'admin');
        })->pluck('email');
    }

    public function adminEmails()
    {
        return $this->adminEmails;
    }

    public function sendContactInfo($contact)
    {
        //example
        // Notification::route('mail', $this->adminEmails)->notify(new ContactNotification($contact));
    }
    
}