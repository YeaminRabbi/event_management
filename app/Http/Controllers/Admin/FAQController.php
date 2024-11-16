<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FAQ;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = FAQ::latest()->get();
        return view('adminpanel.faq.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminpanel.faq.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        FAQ::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'status' => true,
        ]);

        flash()
            ->option('position', 'bottom-right')
            ->success('FAQ created successfully.');

        return redirect()->back();
    }


    public function toggleStatus(FAQ $faq)
    {
        try {
            $faq->update([
                'status' => !$faq->status
            ]);

            $message = $faq->status ? 'FAQ activated successfully' : 'FAQ deactivated successfully';

            return response()->json([
                'success' => true,
                'message' => $message,
                'status' => $faq->status
            ]);
        } 
        catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update status',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(FAQ $fAQ)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FAQ $faq)
    {
        return view('adminpanel.faq.create_edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FAQ $faq)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
            'status' => 'required',
        ]);

        $faq->update([
            'question' => $request->question,
            'answer' => $request->answer,
            'status' => $request->status,
        ]);

        flash()
            ->option('position', 'bottom-right')
            ->success('FAQ updated successfully.');

        return redirect()->route('faq.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FAQ $faq)
    {
        $faq->delete();

        flash()
            ->option('position', 'bottom-right')
            ->warning('FAQ deleted successfully.');

        return redirect()->route('faq.index');
    }
}
