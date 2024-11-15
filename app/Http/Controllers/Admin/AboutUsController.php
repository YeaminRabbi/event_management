<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\AboutAdvantage;
use Google\Service\Drive\Resource\About;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $aboutUs = AboutUs::with('advantages')->first();
        return view('adminpanel.about-us.create_edit', compact('aboutUs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable',
            'description' => 'nullable',
            'mission' => 'nullable',
            'vision' => 'nullable',
            'advantages' => 'nullable|array',
            'advantages.*.icon' => 'required_with:advantages.*.title',
            'advantages.*.title' => 'required_with:advantages.*.icon',
        ]);

        $aboutUs = AboutUs::updateOrCreate(
            ['id' => $request->id],
            [
                'title' => $request->title,
                'description' => $request->description,
                'mission' => $request->mission,
                'vision' => $request->vision,
            ]
        );

        if ($request->has('advantages')) {
            $aboutUs->advantages()->delete();
            foreach ($request->advantages as $advantage) {
                $aboutUs->advantages()->create($advantage);
            }
        }

        flash()
            ->option('position', 'bottom-right')
            ->success('About Us saved successfully');

        return redirect()->back();
    }

    public function destroyAdvantage($id)
    {
        $advantage = AboutAdvantage::findOrFail($id);
        $advantage->delete();

        return response()->json(['message' => 'Advantage deleted successfully']);
    }
    /**
     * Display the specified resource.
     */
    public function show(AboutUs $aboutUs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AboutUs $aboutUs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AboutUs $aboutUs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AboutUs $aboutUs)
    {
        //
    }
}
