<?php

namespace App\Http\Controllers;

use App\Models\PeriodicalMaster;
use Illuminate\Http\Request;

class PeriodicalMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $periodicalMasters = PeriodicalMaster::all();
        return view('periodicalMasters.index', compact('periodicalMasters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('periodicalMasters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'img' => 'required|file|mimes:jpg,jpeg,png|max:51200',
        ]);

        $filePath = $request->file('img')->store('uploads/periodicals', 'public');

        PeriodicalMaster::create([
            'name' => $request->name,
            'img' => $filePath,
        ]);

        return redirect()->route('periodicalMasters.index')->with('success', 'Periodical Master created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PeriodicalMaster $periodicalMaster)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $periodicalMaster = PeriodicalMaster::findOrFail($request->id);
        return view('periodicalMasters.edit', compact('periodicalMaster'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $periodicalMaster = PeriodicalMaster::findOrFail($request->id);
        $request->validate([
            'name' => 'required|string|max:255',
            'img' => 'nullable|file|mimes:jpg,jpeg,png|max:51200',
        ]);


        //check if new file is uploaded

        if ($request->hasFile('img')) {
            //if imge already exists, delete it
            if ($periodicalMaster->img) {
                unlink(storage_path('app/public/' . $periodicalMaster->img));
            }
            $filePath = $request->file('img')->store('uploads/periodicals', 'public');

            $periodicalMaster->update([
                'name' => $request->name,
                'img' => $filePath,
            ]);
        } else {
            $periodicalMaster->update([
                'name' => $request->name,
            ]);
        }

        return redirect()->route('periodical-masters.index')->with('success', 'Periodical Master updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $periodicalMaster = PeriodicalMaster::findOrFail($request->id);
        $periodicalMaster->delete();
        return redirect()->route('periodical-masters.index')->with('success', 'Periodical Master deleted successfully!');
    }
}

