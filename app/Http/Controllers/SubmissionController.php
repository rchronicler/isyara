<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Submission;
use App\Http\Requests\StoreSubmissionRequest;
use App\Http\Requests\UpdateSubmissionRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $submissions = Submission::where('submitter', auth()->id())->get();
        return view('dashboard.submissions', compact('submissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.submissions.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubmissionRequest $request)
    {
        $validated = $request->validated();

        $videoPath = $validated['video']->store('videos', 'public');
        $videoUrl = Storage::url($videoPath);

        Submission::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'video_url' => $videoUrl,
            'category_id' => $validated['category'],
            'submitter' => auth()->id(),
        ]);

        return redirect()->route('submissions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Submission $submission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Submission $submission)
    {
        $categories = Category::all();
        return view('dashboard.submissions.edit', compact('submission', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubmissionRequest $request, Submission $submission)
    {
        $validated = $request->validated();

        $videoUrl = $submission->video_url;
        // Check if video is updated
        if ($request->hasFile('video')) {
            // Remove the /storage/ part of the URL to get the file path
            $filePath = str_replace('/storage/', '', $submission->video_url);
            // Delete the video file from storage
            Storage::disk('public')->delete($filePath);

            // Store new video
            $videoPath = $validated['video']->store('videos', 'public');
            $videoUrl = Storage::url($videoPath);
        }

        $submission->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'video_url' => $videoUrl,
            'category_id' => $validated['category'],
        ]);

        return redirect()->route('submissions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Submission $submission)
    {
        // Delete data if successful delete video
        if ($submission::destroy($submission->entry_id)) {
            // Remove the /storage/ part of the URL to get the file path
            $filePath = str_replace('/storage/', '', $submission->video_url);

            // Delete the video file from storage
            Storage::disk('public')->delete($filePath);
        }
        return redirect()->route('submissions.index');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $submissions = Submission::where('title', 'like', "%$search%")->get();
        return view('detail', compact('submissions'));
    }

    public function getDictionary(Request $request)
    {
        $query = $request->input('q');

        // If there's a search query, filter submissions
        if ($query) {
            $submissions = Submission::with(['category', 'user'])
                ->where('title', 'like', "%{$query}%")
                ->orWhereHas('category', function ($q) use ($query) {
                    $q->where('category_name', 'like', "%{$query}%");
                })
                ->get();
        } else {
            // If no query, fetch all submissions
            $submissions = Submission::with(['category', 'user'])->get();
        }

        return view('dictionary.dictionary', compact('submissions'));
    }
}
