<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Videos List';

        if ($request->ajax()) {
            $data = Video::with('category');

            return DataTables::of($data)
                ->addColumn('video_display', function ($row) {
                    return '<video width="320" height="240" controls>
                                <source src="' . asset('storage/app/public/' . $row->video) . '" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>';
                })
                ->addColumn('image_display', function ($row) {
                    return '<img src="' . asset('storage/app/public/' . $row->image) . '" class="img-fluid" width="100">';
                })
                ->addColumn('category_name', function ($row) {
                    return $row->category->name;
                })
                ->addColumn('action', function ($row) {
                    $buttons = '<div class="d-flex align-items-center list-action">';
                    $buttons .= '<a href="' . route('videos.show', ['video' => $row->id]) . '" class="badge bg-info mr-2" data-toggle="tooltip" data-placement="top" title="View"><i class="ri-eye-line mr-0"></i></a>';
                    $buttons .= '<a href="' . route('videos.edit', ['video' => $row->id]) . '" class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="Edit"><i class="ri-pencil-line mr-0"></i></a>';
                    $buttons .= '<button class="badge badge-warning mr-2 delete-user border-0" data-id="' . $row->id . '" data-model="videos" data-toggle="modal" data-target="#deleteVideoModal"><i class="ri-delete-bin-line mr-0"></i></button>';
                    $buttons .= '</div>';
                    return $buttons;
                })
                ->rawColumns(['image_display','video_display', 'action'])
                ->make(true);
        }

        return view('videos.index', compact('title'));
    }

    public function create()
    {
        $title = "Create Video";
        $categories = Category::all();
        return view('videos.create', compact('title', 'categories'));
    }

    public function store(Request $request)
    {
        try {
            // Debug incoming request
            Log::info('Video store request received', [
                'title' => $request->input('title'),
                'category_id' => $request->input('category_id'),
                'type' => $request->input('type'),
                'has_video' => $request->hasFile('video'),
                'has_image' => $request->hasFile('image'),
                'video_size' => $request->hasFile('video') ? $request->file('video')->getSize() : 0,
            ]);

            $request->validate([
                'title' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'video' => 'required|file|mimes:mp4,mov,avi,wmv,quicktime|max:209715200', // max 200MB
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:209715200', // max 200MB
                'type' => 'required',
            ]);

            $data = $request->all();

        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('videos', 'public');
            $data['video'] = $videoPath;
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'images/video_thumbnail/' . $imageName;
            Storage::disk('public')->put($imagePath, file_get_contents($image));
            $data['image'] = $imagePath;
        }

        $video = Video::create($data);

        // Return JSON for API requests
        if ($request->expectsJson() || $request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Video created successfully.',
                'video' => $video
            ]);
        }

        return redirect()->route('videos.index')->with('success', 'Video created successfully.');
        
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Video validation error', ['errors' => $e->errors()]);
            
            if ($request->expectsJson() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            Log::error('Video creation error', ['error' => $e->getMessage()]);
            
            if ($request->expectsJson() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'The video failed to upload: ' . $e->getMessage()
                ], 500);
            }
            throw $e;
        }
    }

    public function show(Video $video)
    {
        $title = 'Videos Detials';
        return view('videos.show', compact('video' , 'title'));
    }

    public function edit(Video $video)
    {
        $title = "Edit Video";
        $categories = Category::all();
        return view('videos.edit', compact('video', 'title', 'categories'));
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'video' => 'nullable|file|mimes:mp4,mov,avi,wmv,quicktime|max:209715200', // max 200MB
            'type' => 'required',
             'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:209715200', // max 200MB
        ]);

        $data = $request->all();

        if ($request->hasFile('video')) {
            // Delete the old video file if it exists
            if ($video->video && Storage::disk('public')->exists($video->video)) {
                Storage::disk('public')->delete($video->video);
            }

            if ($request->hasFile('image')) {
                // Delete the old image file if it exists
                if ($video->image && Storage::disk('public')->exists($video->image)) {
                    Storage::disk('public')->delete($video->image);
                }

                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = 'images/video_thumbnail/' . $imageName;
                Storage::disk('public')->put($imagePath, file_get_contents($image));
                $data['image'] = $imagePath;
            }


            $videoPath = $request->file('video')->store('videos', 'public');
            $data['video'] = $videoPath;
        }

        $video->update($data);

        return response()->json([
                'status' => 'success',
                'message' => 'Video updated successfully.',
                
            ]);
    }

    public function destroy(Request $request)
    {
        $video = Video::find($request->id);

        if ($video) {
            if ($video->video && Storage::disk('public')->exists($video->video)) {
                Storage::disk('public')->delete($video->video);
            }

            if ($video->image && Storage::disk('public')->exists($video->image)) {
                Storage::disk('public')->delete($video->image);
            }

            $video->delete();

            return response()->json(['status' => 'success', 'message' => 'Video deleted successfully.']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Video not found.'], 404);
        }
    }

    // API method to get all videos
    public function getAllVideos()
    {
        $videos = Video::with('category')->get();

        return response()->json([
            'status' => 'success',
            'videos' => $videos,
            'message' => 'Videos fetched successfully'
        ]);
    }
}

