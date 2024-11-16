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

        $upcommingEvents = Event::with('image')->where('status', 'confirmed')->where('approve', 1)->where('start', '>', now())->get();

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
}
