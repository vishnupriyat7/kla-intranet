<?php

namespace App\Http\Controllers;

use App\Models\Periodical;

use App\Models\PeriodicalMaster;
use Illuminate\Http\Request;

class PeriodicalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd('Hii');

        $periodicals = Periodical::with('periodicalMaster')->get();

        return view('periodicals.index', compact('periodicals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()

    {
        $periodicalMasters = PeriodicalMaster::all();
        return view('periodicals.create', compact('periodicalMasters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_eng' => 'required|exists:periodical_masters,id',
            'path' => 'required|file|mimes:pdf|max:51200',
            'date' => 'required|date',

        ]);

        $filePath = $request->file('path')->store('uploads', 'public');

        Periodical::create([
            'periodical_master_id' => $request->name_eng,
            'date' => $request->date,
            'path' => $filePath,

        ]);

        return redirect()->route('periodicals.index')->with('success', 'Periodical created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Periodical $periodical)
    {
        $periodical = Periodical::with('periodicalMaster')->findOrFail($request->id);
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
            'name_eng' => 'required|string|max:255',
            'name_mal' => 'required|string|max:255',
            'date' => 'required|date',
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
            'name_eng' => $request->name_eng,
            'name_mal' => $request->name_mal,
            'date' => $request->date,
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
