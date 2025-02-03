<?php

namespace App\Http\Controllers;

use App\Models\GovernmentOrderType;
use Illuminate\Http\Request;

class GovernmentOrderTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $goTypes = GovernmentOrderType::all();
        return view('go-types.index', compact('goTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('go-types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'go_type' => 'required',

        ]);
        //if same name is already present in the database, then it will not be stored

        $goType = GovernmentOrderType::where('go_type', $request->go_type)->first();
        if ($goType) {
            return redirect()->route('go-types.index')->with('error', 'Government Order Type already exists.');
        }
        GovernmentOrderType::create($request->all());

        return redirect()->route('go-types.index')->with('success', 'Government Order Type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(GovernmentOrderType $governmentOrderType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $goType = GovernmentOrderType::find($request->id);
        return view('go-types.edit', compact('goType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $goType = GovernmentOrderType::find($request->id);

        $request->validate([
            'go_type' => 'required',
        ]);

        // $goType = GovernmentOrderType::where('go_type', $request->go_type)->first();
        // if ($goType) {
        //     return redirect()->route('go-types.index')->with('error', 'Government Order Type already exists.');
        // }

        $goType->update([
            'go_type' => $request->go_type,
        ]);

        return redirect()->route('go-types.index')->with('success', 'Government Order Type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GovernmentOrderType $governmentOrderType)
    {
        //
    }
}
