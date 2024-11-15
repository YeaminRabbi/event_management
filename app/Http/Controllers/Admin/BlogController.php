<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\ImageService;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('adminpanel.blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminpanel.blog.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
        ]);

        $slug = Str::slug($request->title);

        $blog = Blog::create([
            'title' => $request->title,
            'category' => $request->category,
            'slug' => $slug,
            'description' => $request->description,
            'status' => true,
        ]);

        if ($request->hasFile('file') && $blog) {
            $service = new ImageService();
            $service->store($request, $blog);
        }

        flash()
            ->option('position', 'bottom-right')
            ->success('Blog created successfully');

        return redirect()->back();
    }

    public function toggleStatus(Blog $blog)
    {
        try {
            $blog->update([
                'status' => !$blog->status
            ]);
            $message = $blog->status ? 'Blog activated successfully' : 'Blog deactivated successfully';

            return response()->json([
                'success' => true,
                'message' => $message,
                'status' => $blog->status
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update blog status'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $blog->load('image');
        return view('adminpanel.blog.create_edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
        ]);

        $slug = Str::slug($request->title);

        $blog->update([
            'title' => $request->title,
            'category' => $request->category,
            'slug' => $slug,
            'description' => $request->description,
        ]);

        if ($request->hasFile('file') && $blog) {
            $service = new ImageService();
            $service->update($request, $blog);
        }

        flash()
            ->option('position', 'bottom-right')
            ->success('Blog updated successfully');

        return redirect()->route('blog.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        if ($blog->image) {
            if (file_exists(public_path($blog->image->url))) {
                unlink(public_path($blog->image->url));
            }
            $blog->image->delete();
        }
        $blog->delete();

        flash()
            ->option('position', 'bottom-right')
            ->warning('Blog deleted successfully');

        return redirect()->back();
    }
}
