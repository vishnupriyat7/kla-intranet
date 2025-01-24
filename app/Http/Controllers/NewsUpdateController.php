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
            'path' => 'required|file|mimes:pdf|max:10000',
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

        return redirect()->route('newsupdates.index')->with('success', 'News created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(NewsUpdate $newsUpdate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NewsUpdate $newsUpdate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NewsUpdate $newsUpdate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NewsUpdate $newsUpdate)
    {
        //
    }
}
