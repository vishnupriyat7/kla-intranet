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
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('periodicals.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'path' => 'required|file|mimes:pdf,doc,docx',
            'img' => 'nullable|string|max:255',
        ]);

        $filePath = $request->file('path')->store('uploads', 'public');

        Periodical::create([
            'name' => $request->name,
            'path' => $filePath,
            'img' => $request->img,
        ]);

        return redirect()->back()->with('success', 'Periodical created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Periodical $periodical)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Periodical $periodical)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Periodical $periodical)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Periodical $periodical)
    {
        //
    }
}
