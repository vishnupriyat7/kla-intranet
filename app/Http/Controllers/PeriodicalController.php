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
            'path' => 'required|file|mimes:pdf|max:1048576',
            'date' => 'required|date',

        ]);

        $filePath = $request->file('path')->store('uploads/periodicals/pdf', 'public');

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
        $periodical = Periodical::with('periodicalMaster')->findOrFail($request->id);

        $periodicalMasters = PeriodicalMaster::all();

        return view('periodicals.edit', compact('periodical', 'periodicalMasters'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $periodical = Periodical::findOrFail($request->id);
        // dd($request->all());

        $request->validate([
            'name_eng' => 'required|exists:periodical_masters,id',
            'date' => 'required|date',
            'path' => 'nullable|file|mimes:pdf|max:2000000',

        ]);

        // dd($request->all());


        if ($request->hasFile('path')) {
            //Delete existing File from storage
            // dd($periodical->path);
            // dd(storage_path());

            if ($periodical->path) {
                unlink(storage_path('app/public/' . $periodical->path));
            }

            $filePath = $request->file('path')->store('uploads/periodicals/pdf', 'public');

            $periodical->update([
                'periodical_master_id' => $request->name_eng,
                'date' => $request->date,
                'path' => $filePath,
            ]);

            return redirect()->route('periodicals.index')->with('success', 'Periodical updated successfully!');
        } else {
            $periodical->update([
                'periodical_master_id' => $request->name_eng,
                'date' => $request->date,
            ]);

            return redirect()->route('periodicals.index')->with('success', 'Periodical updated successfully!');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Periodical $periodical)
    {
        //
    }
}
