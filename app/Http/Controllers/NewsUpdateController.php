<?php

namespace App\Http\Controllers;

use App\Models\NewsUpdate;
use Illuminate\Http\Request;

class NewsUpdateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $newsupdates = NewsUpdate::all();
        return view('newsupdates.index', compact('newsupdates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('newsupdates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'path' => 'required|file|mimes:pdf|max:100000',
            'date' => 'required|date',
            'status' => 'required|string|max:1',
        ]);

        $filePath = $request->file('path')->store('uploads/news', 'public');
        // dd(request()->file('path')->getSize());
        NewsUpdate::create([
            'title' => $request->title,
            'date' => $request->date,
            'path' => $filePath,
            'status' => $request->status,
        ]);

        return redirect()->route('news-updates.index')->with('success', 'News created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $newsupdate = NewsUpdate::findOrFail($request->id);
        return view('newsupdates.edit', compact('newsupdate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $newsupdate = NewsUpdate::findOrFail($request->id);
        $request->validate([
            'title' => 'required|string|max:255',
            'path' => 'nullable|file|mimes:pdf|max:100000',
            'date' => 'required|date',
            'status' => 'required|string|max:1',
        ]);
        if ($request->hasFile('path')) {
            $oldFile = $newsupdate->path;
            if ($oldFile) {
                unlink(storage_path('app/public/' . $oldFile));
            }
            $filePath = $request->file('path')->store('uploads/news', 'public');
            $newsupdate->update([
                'title' => $request->title,
                'date' => $request->date,
                'path' => $filePath,
                'status' => $request->status,
            ]);
        } else {
            $newsupdate->update([
                'title' => $request->title,
                'date' => $request->date,
                'status' => $request->status,
            ]);
        }
        return redirect()->route('news-updates.index')->with('success', 'News updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $newsupdate = NewsUpdate::findOrFail($request->id);
        $oldFile = $newsupdate->path;
        if ($oldFile) {
            unlink(storage_path('app/public/' . $oldFile));
        }
        $newsupdate->delete();
        return redirect()->route('news-updates.index')->with('success', 'News deleted successfully!');
    }
}
