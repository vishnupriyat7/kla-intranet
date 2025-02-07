<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderCircular;

class OrderCircularController extends Controller
{
    public function index()
    {
        $orders = OrderCircular::all();

        return view('orders-circular.index', compact('orders'));
    }
    public function create()
    {
        return view('orders-circular.create');
    }
    public function store(Request $request)
    {

        $request->validate([
            'type' => 'required',
            'go_type' => 'nullable',
            'go_no' => 'required',
            'go_date' => 'required|date',
            'go_title' => 'required',
            'go_keyword' => 'required',
            'go_path' => 'required|file|mimes:pdf|max:1048576',
        ]);
        // Extract Year from provided date
        $year = date('Y', strtotime($request->go_date));
        // dd($year);

        //determine the category folder based on the type
        $categoryFolder = match ($request->type) {
            'G' => 'GovtOrders',
            'O' => 'OfficeOrders',
            'C' => 'Circulars',

        };

        $filePath = $request->file('go_path')->store("uploads/orders-circlular/{$year}/{$categoryFolder}", 'public');

        // $filePath = $request->file('go_path')->store('uploads/orders-circular/', 'public');

        OrderCircular::create([
            'type' => $request->type,
            'go_type' => $request->go_type??null,
            'number' => $request->go_no,
            'date' => $request->go_date,
            'title' => $request->go_title,
            'keywords' => $request->go_keyword,
            'path' => $filePath,
            'status' => 1,
        ]);
        return redirect()->route('orders-circular.index')->with('success', 'Order / Circular added successfully');
    }
}
