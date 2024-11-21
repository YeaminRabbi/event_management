<?php

namespace App\Http\Controllers\Frontend;
// namespace App\Models;

use App\Models\AboutUs;
use App\Models\Banner;
use App\Models\Event;
use App\Models\FAQ;
use App\Models\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $banners = Banner::with('image')->where('status', 1)->get();

        $upcommingEvents = Event::with('image')->where('status', 'confirmed')->where('approve', 1)->where('start', '>', now())->orderBy('start', 'asc')->get();

        $aboutUs = AboutUs::with('advantages')->first();

        $eventTypes = ['conference', 'play-ground', 'musical', 'other'];

        $events = [];
        foreach ($eventTypes as $type) {
            $events[$type] = Event::with('image')
                ->where('approve', true)
                ->where('status', 'confirmed')
                ->where('event_type', $type)
                ->orderBy('start', 'asc')
                ->paginate(6);
        }

        $galleries = Event::with('image')
            ->where('approve', true)
            ->where('status', 'confirmed')
            ->orderBy('start', 'asc')
            ->get();

        $faqs = FAQ::where('status', 1)->limit(4)->latest()->get();
        $blogs = Blog::where('status', 1)->limit(4)->latest()->get();


        return view('frontendpanel.home.index', compact('banners', 'upcommingEvents', 'aboutUs', 'events', 'eventTypes', 'galleries', 'faqs', 'blogs'));
    }

    public function paginate(Request $request)
    {
        $type = $request->get('type');
        $page = $request->get('page', 1);

        $events = Event::with('image')
            ->where('approve', true)
            ->where('status', 'confirmed')
            ->where('event_type', $type)
            ->orderBy('start', 'asc')
            ->paginate(6, ['*'], 'page', $page); // Explicitly set the page number

        if ($request->ajax()) {
            return view('frontendpanel.events.partials.event-items', compact('events', 'type'))->render();
        }

        return redirect()->back();
    }

    public function aboutUs()
    {
        $aboutUs = AboutUs::with('advantages')->first();
        $faqs = FAQ::where('status', 1)->latest()->get();
        return view('frontendpanel.about_us.about_us', compact('aboutUs', 'faqs'));
    }

    public function events()
    {
        $eventTypes = ['conference', 'play-ground', 'musical', 'other'];

        $events = Event::with('image')
            ->where('approve', true)
            ->where('status', 'confirmed')
            ->orderBy('start', 'asc')
            ->paginate(6);

        return view('frontendpanel.events.event-list', compact('events', 'eventTypes'));
    }

    public function event_details($event)
    {
        $eventTypes = ['conference', 'play-ground', 'musical', 'other'];
        // return
        $event = Event::with('image')->findOrFail($event);
        return view('frontendpanel.events.event-details', compact('event', 'eventTypes'));
    }

    public function search(Request $request)
    {
        $query = Event::with('image')
            ->where('approve', true)
            ->where('status', 'confirmed');

        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('summary', 'like', '%' . $request->keyword . '%')
                    ->orWhere('location', 'like', '%' . $request->keyword . '%');
            });
        }

        if ($request->filled('event_type')) {
            $query->where('event_type', $request->event_type);
        }

        if ($request->filled('year') && $request->filled('month')) {
            $query->whereYear('start', $request->year)
                ->whereMonth('start', $request->month);
        }

        $events = $query->orderBy('start', 'asc')->paginate(6);
        $eventTypes = ['conference', 'play-ground', 'musical', 'other'];

        return view('frontendpanel.events.event-list', compact('events', 'eventTypes'));
    }
}
