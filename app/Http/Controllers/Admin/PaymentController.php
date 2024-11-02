<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function index(Request $request){

        $payments = Payment::query()
        ->when($request->filled('date_range'), function ($query) use ($request) {
            $dateRange = $request->input('date_range');
            $dates = explode(" - ", $dateRange);

            $startDate = Carbon::createFromFormat('m/d/Y', $dates[0])->startOfDay();
            $endDate = Carbon::createFromFormat('m/d/Y', $dates[1])->endOfDay();

            return $query->whereBetween('created_at', [$startDate, $endDate])->orwhereBetween('transaction_date', [$startDate, $endDate]);
        })
        ->when($request->filled('search'), function ($query) use ($request) {
            $searchKey = $request->input('search');
            return $query->where('customer_email', 'like', '%' . $searchKey . '%')
                        ->orWhere('customer_name', 'like', '%' . $searchKey . '%')
                        ->orWhere('currency', 'like', '%' . $searchKey . '%')
                        ->orWhere('session_id', 'like', '%' . $searchKey . '%')
                        ->orWhere('payment_intent_id', 'like', '%' . $searchKey . '%');
        })
        ->when($request->filled('event_id'), function ($query) use ($request) {
            $eventId = $request->input('event_id');
            return $query->where('event_id', $eventId);
        })
        ->when($request->filled('payment_status'), function ($query) use ($request) {
            $status = $request->input('payment_status');
            return $query->where('payment_status', $status);
        })
        ->latest()
        ->paginate(20);

        $events = Event::latest()->get(['id', 'summary']);

        return view('adminpanel.payment.index', compact('payments', 'events'));
    }

    public function show(Request $request, $id)
    {   
        $payment = Payment::with('event', 'ticket')->findorfail($id);

        return view('adminpanel.payment.show', compact('payment'));
    }
}
