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
use Google\Service\Calendar as Calendar;
use Google\Service\Calendar\Event as GoogleEvent;
use Carbon\Carbon;
use DateTime;

class EventController extends Controller
{
    public function index()
    {
        $user = Auth::user();
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
            'ticket_price' => 'required'
        ]);


        // Begin a transaction to ensure all or nothing happens
        DB::beginTransaction();
        try {
            // Create new event record
            $event = Event::create([
                'user_id' => Auth::id(),
                'summary' => $request->input('summary'),
                'location' => $request->input('location'),
                'start' => $request->input('start'),
                'end' => $request->input('end'),
                'ticket_price' => $request->input('ticket_price'),
                'description' => $request->input('description'),
                'status' => $request->input('status'),
                'approve' => 0, // Set active to 1 (or modify according to your requirements)
            ]);


            // using Morph Relation for image with IMAGE Model
            if ($request->hasFile('file') && $event) {
                $service = new ImageService();
                $service->store($request, $event);
            }


            // Prepare event data for Google Calendar
            $user = Auth::user();

            if ($user->integration()->exists()) {

                $eventStartTime = \Carbon\Carbon::parse($request->input('start'))->toIso8601String();
                $eventEndTime = \Carbon\Carbon::parse($request->input('end'))->toIso8601String();

                // Create a new Google Calendar event object
                $googleEvent = new GoogleEvent(array(
                    'summary' => $event->summary, // Use summary from the event model
                    'description' => $event->description,
                    'location' => $event->location,
                    'start' => array(
                        'dateTime' => $eventStartTime,
                        'timeZone' => 'Asia/Dhaka',
                    ),
                    'end' => array(
                        'dateTime' => $eventEndTime,
                        'timeZone' => 'Asia/Dhaka',
                    ),
                    'reminders' => array(
                        'useDefault' => false,
                        'overrides' => array(
                            'method' => 'popup',
                            'minutes' => 60,
                        ),
                    ),
                ));

                $googleClientService = new GoogleClientService();

                $client = $googleClientService->client;
                $googleCalendarService = new Calendar($client);

                // Insert the event into Google Calendar
                $googleCalendarEvent = $googleCalendarService->events->insert('primary', $googleEvent);

                if ($googleCalendarEvent) {
                    $event->update([
                        'google_event_id' =>   $googleCalendarEvent->id,
                        'google_event_url' =>   $googleCalendarEvent->htmlLink
                    ]);
                }
            }

            // Commit the transaction
            DB::commit();

            // Flash success message to session
            return back()->with('success', 'Event created successfully.');
        } catch (\Exception $e) {

            // Rollback transaction if something goes wrong
            DB::rollBack();

            // Log the exception details
            Log::error('Event create failed: ' . $e->getMessage(), [
                'exception' => $e,
            ]);

            return redirect()->back()->withErrors('An error occurred while inserting. Please try again.');
        }
    }

    public function edit(Event $event)
    {
        return view('adminpanel.event.edit', compact('event'));
    }


    public function update(Request $request, Event $event)
    {
        $request->validate([
            'summary' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start', // Ensure end date is after or equal to start date
            'description' => 'nullable|string',
            'status' => 'required|string|in:confirmed,tentative,cancelled', // Validate status
            'file' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validate image upload
            'ticket_price' => 'required'
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
                'ticket_price' => $request->input('ticket_price'),
            ]);


            // using Morph Relation for image with IMAGE Model
            if ($request->hasFile('file') && $event) {
                $service = new ImageService();
                $service->update($request, $event);
            }

            // Prepare event data for Google Calendar
            $user = Auth::user();

            if ($user->integration()->exists()) {
                $googleClientService = new GoogleClientService();
                $client = $googleClientService->client;
                $googleCalendarService = new Calendar($client);

                // Retrieve the Google Calendar event
                $googleEvent = $googleCalendarService->events->get('primary', $event->google_event_id);

                if ($googleEvent) {
                     // Convert the start and end times to EventDateTime format
                    $eventStartTime = new \Google\Service\Calendar\EventDateTime();
                    $eventStartTime->setDateTime(\Carbon\Carbon::parse($event->start)->toIso8601String());

                    $eventEndTime = new \Google\Service\Calendar\EventDateTime();
                    $eventEndTime->setDateTime(\Carbon\Carbon::parse($event->end)->toIso8601String());

                    // Update the Google Calendar event details
                    $googleEvent->setStart($eventStartTime);
                    $googleEvent->setEnd($eventEndTime);
                    $googleEvent->setSummary($event->summary);
                    $googleEvent->setLocation($event->location);
                    $googleEvent->setStatus($event->status);

                    // Update the event in Google Calendar
                    $updatedEvent = $googleCalendarService->events->update('primary', $googleEvent->getId(), $googleEvent);
                }
               
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

    public function destroy(Request $request, Event $event)
    {
       
        try {

            $user = Auth::user();

            if ($user->integration()->exists()) {
                $googleClientService = new GoogleClientService();
                $client = $googleClientService->client;
                $googleCalendarService = new Calendar($client);

                // Retrieve the Google Calendar event and delete
                $googleEvent = $googleCalendarService->events->get('primary', $event->google_event_id);

                if($googleEvent && $googleEvent->status != 'cancelled'){
                    $googleCalendarService->events->delete('primary', $event->google_event_id);
                }
            }

            $event->delete();
            return back()->with('warning', 'Event removed successfully');

        } catch (\Exception $e) {

            // Log the exception details
            Log::error('SQL failed: ' . $e->getMessage(), [
                'exception' => $e,
            ]);

            return redirect()->back()->withErrors('An error occurred while removing. Please try again.');
        }
    }

    public function getEventDetails(Event $event){
        return response()->json([
            'price' => $event->ticket_price,
            'location' => $event->location,
            'description' => $event->description,
            'start' => $event->start,
            'end' => $event->end,
        ]);
    }
}
