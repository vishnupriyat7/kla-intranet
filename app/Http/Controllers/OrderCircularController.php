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
            'no' => 'required',
            'date' => 'required|date',
            'title' => 'required',
            'keywords' => 'required',
            'path' => 'required|file|mimes:pdf|max:1048576',
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

        $filePath = $request->file('path')->store("uploads/orders-circlular/{$year}/{$categoryFolder}", 'public');

        // $filePath = $request->file('go_path')->store('uploads/orders-circular/', 'public');

        OrderCircular::create([
            'type' => $request->type,
            'go_type' => $request->type ?? null,
            'number' => $request->no,
            'date' => $request->date,
            'title' => $request->title,
            'keywords' => $request->keywords,
            'path' => $filePath,
            'status' => 1,
        ]);
        return redirect()->route('orders-circular.index')->with('success', 'Order / Circular added successfully');
    }

    public function edit(Request $request)
    {
        // dd($request->id);
        $order = OrderCircular::find($request->id);
        // dd($order);
        return view('orders-circular.edit', compact('order'));
    }
    public function update(Request $request)
    {

        $request->validate([
            'type' => 'required',
            'go_type' => 'nullable',
            'no' => 'required',
            'date' => 'required|date',
            'title' => 'required',
            'keywords' => 'required',
            'path' => 'nullable|file|mimes:pdf|max:1048576',
        ]);
        $order = OrderCircular::find($request->id);

        $order->type = $request->type;
        $order->go_type = $request->go_type;
        $order->number = $request->no;
        $order->date = $request->date;
        $order->title = $request->title;
        $order->keywords = $request->keywords;
        if ($request->hasFile('path')) {

            if ($order->path) {
                unlink(storage_path('app/public/' . $order->path));
            }

            $filePath = $request->file('path')->store('uploads/orders-circular/', 'public');
            $order->path = $filePath;
        }
        $order->save();
        return redirect()->route('orders-circular.index')->with('success', 'Order / Circular updated successfully');
    }
    public function delete(Request $request)
    {
        $order = OrderCircular::findOrFail($request->id);
        if ($order->path) {
            unlink(storage_path('app/public/' . $order->path));
        }
        $order->delete();
        return redirect()->route('orders-circular.index')->with('success', 'Order / Circular deleted successfully');
    }
}
