<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Services\ImageService;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::with('image')->orderBy('id', 'ASC')->get();
        return view('adminpanel.banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminpanel.banner.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'sub_title' => 'nullable',
            'file' => 'required|mimes:jpeg,jpg,png,gif|max:10000',
        ]);

        $slug = Str::slug($request->title);

        $banner = Banner::create([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'status' => true,
            'slug' => $slug,
        ]);

        if ($request->hasFile('file') && $banner) {
            $service = new ImageService();
            $service->store($request, $banner);          
        }

        return redirect()->back()->with('success', 'Banner created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function toggleStatus(Banner $banner)
    {
        try {
            $banner->update([
                'status' => !$banner->status
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Banner status updated successfully',
                'status' => $banner->status
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update banner status'
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        $banner->load('image');
        return view('adminpanel.banner.create_edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'title' => 'required',
            'sub_title' => 'nullable',
            'status' => 'required|boolean',
            'file' => 'nullable|mimes:jpeg,jpg,png,gif|max:10000',
        ]);

        $slug = Str::slug($request->title);

        $banner->update([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'status' => $request->status,
            'slug' => $slug,
        ]);

        if ($request->hasFile('file')) {
            $service = new ImageService();
            $service->update($request, $banner);
        }

        return redirect()->route('banner.index')->with('success', 'Banner updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        if ($banner->image) {
            if (file_exists(public_path($banner->image->url))) {
                unlink(public_path($banner->image->url));
            }
            $banner->image->delete();
        }
        $banner->delete();
        return redirect()->back()->with('success', 'Banner deleted successfully');
    }
}
