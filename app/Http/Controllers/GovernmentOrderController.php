<?php

namespace App\Http\Controllers;


use App\Models\OrderCircular;
use Illuminate\Http\Request;

class GovernmentOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $governmentOrders = OrderCircular::all()
            ->orderBy('created_at', 'desc')
            ->paginate(25);
        return view('govt-orders.index', compact('governmentOrders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('govt-orders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([

            'type' => 'required',
            'go_type' => 'required',
            'go_no' => 'required',
            'go_date' => 'required|date',
            'go_title' => 'required',
            'go_keyword' => 'required',
            'go_path' => 'required|file|mimes:pdf|max:1048576',
        ]);


        $filePath = $request->file('go_path')->store('uploads/orders-circular/', 'public');

        // dd($filePath);

        OrderCircular::create([

            'type' => $request->type,
            'go_type' => $request->go_type,
            'number' => $request->go_no,
            'date' => $request->go_date,
            'title' => $request->go_title,
            'keyword' => $request->go_keyword,
            'path' => $filePath,

        ]);
        return redirect()->route('govt-orders.index')->with('success', 'Government Order created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
    }
}
