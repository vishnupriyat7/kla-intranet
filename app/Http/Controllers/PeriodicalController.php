<?php

namespace App\Http\Controllers;

use App\Models\Periodical;
use Illuminate\Http\Request;

class PeriodicalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd('Hii');

        $periodicals = Periodical::all();

        return view('periodicals.index', compact('periodicals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('periodicals.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'path' => 'required|file|mimes:pdf|max:51200',
            'img' => 'nullable|string|max:255',
        ]);

        $filePath = $request->file('path')->store('uploads', 'public');
        // dd(request()->file('path')->getSize());
        Periodical::create([
            'name' => $request->name,
            'path' => $filePath,
            'img' => $request->img,
        ]);

        // return redirect()->back()->with('success', 'Periodical created successfully!');
        return redirect()->route('periodicals.index')->with('success', 'Periodical created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Periodical $periodical)
    {
        $periodical = Periodical::findOrFail($request->id);
        return view('periodicals.show', compact('periodical'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Periodical $periodical)
    {
        $periodical = Periodical::findOrFail($request->id);
        return view('periodicals.edit', compact('periodical'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Periodical $periodical)
    {

        $periodical = Periodical::findOrFail($request->id);
        $request->validate([
            'name' => 'required|string|max:255',
            'path' => 'required|file|mimes:pdf|max:51200',
            'img' => 'nullable|string|max:255',
        ]);

        $filePath = $request->file('path')->store('uploads', 'public');
        //Delete existing File from storage
        $oldFile = $periodical->path;
        if ($oldFile) {
            unlink(storage_path('app/public/' . $oldFile));
        }

        $periodical->update([
            'name' => $request->name,
            'path' => $filePath,
            'img' => $request->img,
        ]);


        return redirect()->route('periodicals.index')->with('success', 'Periodical updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Periodical $periodical)
    {
        //
    }
}
