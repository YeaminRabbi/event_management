<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\Services\GoogleClientService;
use App\Services\ImageService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // checking if the user has connected trough google calendar
        // if ($user->integration()->exists()) {
        //     $service = new GoogleClientService();
        //     // return $service->getCredentials();
        //     // return $service->initializeGoogleClient();

        //     return [
        //         // $service->getCredentials(),
        //         // $service->initializeGoogleClient(),
        //         $service->getCalendarData(),
        //     ];
        // }

        // return 'no integration'; 

        $events = Event::latest()->get();

        return view('adminpanel.event.index', compact('events'));
    }

    public function create()
    {
        return view('adminpanel.event.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'summary' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start', // Ensure end date is after or equal to start date
            'description' => 'nullable|string',
            'status' => 'required|string|in:confirmed,tentative,cancelled', // Validate status
            'file' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validate image upload
        ]);


        // Begin a transaction to ensure all or nothing happens
        DB::beginTransaction();
        try {
            // Create new event record
            $event = Event::create([
                // 'google_event_id' => Str::uuid(), // Generate a unique Google event ID (you can modify this as per your requirements)
                'summary' => $request->input('summary'),
                'location' => $request->input('location'),
                'start' => $request->input('start'),
                'end' => $request->input('end'),
                'description' => $request->input('description'),
                'status' => $request->input('status'),
                'active' => 0, // Set active to 1 (or modify according to your requirements)
            ]);


            // using Morph Relation for image with IMAGE Model
            if ($request->hasFile('file') && $event) {
                $service = new ImageService();
                $service->store($request, $event);
            }

            // Commit the transaction
            DB::commit();



              // Prepare event data for Google Calendar
            // $eventStartTime = $request->date . 'T' . $request->time . ':00'; // Assuming time is in HH:MM format
            // $eventEndTime = $request->date . 'T' . date('H:i:s', strtotime($request->time) + 3600); // Add one hour

            // $googleEvent = [
            //     'summary' => $event->name,
            //     'description' => $event->description,
            //     'start' => [
            //         'dateTime' => $eventStartTime,
            //         'timeZone' => 'Asia/Dhaka',
            //     ],
            //     'end' => [
            //         'dateTime' => $eventEndTime,
            //         'timeZone' => 'Asia/Dhaka',
            //     ],
            //     'reminders' => [
            //         'useDefault' => false,
            //         'overrides' => [
            //             ['method' => 'popup', 'minutes' => 10],
            //         ],
            //     ],
            // ];

            // // Sync with Google Calendar
            // try {
            //     $googleCalendarService = new Google_Service_Calendar($this->googleClientService->client);
            //     $googleCalendarEvent = $googleCalendarService->events->insert('primary', $googleEvent);

            //     // Save Google Calendar data to the event
            //     $event->update([
            //         'google_calendar_data' => json_encode($googleCalendarEvent),
            //     ]);
            // } catch (\Exception $e) {
            //     return back()->withErrors(['google_calendar' => 'Failed to sync with Google Calendar: ' . $e->getMessage()]);
            // }


            // Flash success message to session
            return back()->with('success', 'Event created successfully.');
        } catch (\Exception $e) {

            // Rollback transaction if something goes wrong
            DB::rollBack();

            // Log the exception details
            Log::error('SQL failed: ' . $e->getMessage(), [
                'exception' => $e,
            ]);

            return redirect()->back()->withErrors('An error occurred while inserting. Please try again.');
        }
    }

    public function edit(Event $event){
        return view('adminpanel.event.edit', compact('event'));
    }


    public function update(Request $request, Event $event){
        $request->validate([
            'summary' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start', // Ensure end date is after or equal to start date
            'description' => 'nullable|string',
            'status' => 'required|string|in:confirmed,tentative,cancelled', // Validate status
            'file' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validate image upload
        ]);

         // Begin a transaction to ensure all or nothing happens
        DB::beginTransaction();
        try {
            // Create new event record
            $event->update([
                // 'google_event_id' => Str::uuid(), // Generate a unique Google event ID (you can modify this as per your requirements)
                'summary' => $request->input('summary'),
                'location' => $request->input('location'),
                'start' => $request->input('start'),
                'end' => $request->input('end'),
                'description' => $request->input('description'),
                'status' => $request->input('status'),
            ]);


            // using Morph Relation for image with IMAGE Model
            if ($request->hasFile('file') && $event) {
                $service = new ImageService();
                $service->update($request, $event);
            }

            // Commit the transaction
            DB::commit();


            // Flash success message to session
            return back()->with('success', 'Event updated successfully.');


        } catch (\Exception $e) {

            // Rollback transaction if something goes wrong
            DB::rollBack();

            // Log the exception details
            Log::error('SQL failed: ' . $e->getMessage(), [
                'exception' => $e,
            ]);

            return redirect()->back()->withErrors('An error occurred while updating. Please try again.');
        }
    }

    public function destroy(Request $request, Event $event){
        $event->delete();
        return back()->with('warning', 'Event removed successfully');
    }
}
