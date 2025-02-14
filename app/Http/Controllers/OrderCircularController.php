<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderCircular;
use Yajra\DataTables\Facades\DataTables;

class OrderCircularController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $orders = OrderCircular::all()->sortByDesc('created_at');
            return DataTables::of($orders)
                ->addIndexColumn()
                ->addColumn('type', function ($data) {
                    if ($data->type == 'G') {
                        return 'Government Order';
                    } elseif ($data->type == 'O') {
                        return 'Office Order';
                    } elseif ($data->type == 'C') {
                        return 'Circular';
                    }
                    // return $data->type;
                })
                ->addColumn('go_type', function ($data) {
                    if ($data->go_type == 'M') {
                        return 'സർക്കാർ ഉത്തരവുകൾ കയ്യെഴുത്തു (Govt.Order Manuscript)';
                    } elseif ($data->go_type == 'S') {
                        return 'സർക്കാർ ഉത്തരവുകൾ സാധാരണ (Govt.Order Special)';
                    } elseif ($data->go_type == 'R') {
                        return 'സർക്കാർ ഉത്തരവുകൾ സാധാ (Govt.Order Routine)';
                    } elseif ($data->go_type == 'P') {
                        return 'സർക്കാർ ഉത്തരവുകൾ അച്ചടി (Govt. Order Print)';
                    }

                    // return $data->go_type;
                })
                ->addColumn('number', function ($data) {
                    return $data->number;
                })
                ->addColumn('date', function ($data) {
                    return $data->date;
                })
                ->addColumn('title', function ($data) {
                    return $data->title;
                })
                ->addColumn('keywords', function ($data) {
                    return $data->keywords;
                })
                ->addColumn('path', function ($data) {
                    return $data->path;
                })
                ->addColumn('file', function ($data) {
                    if ($data->path) {
                        return '<a href="#" class="btn btn-outline-info btn-sm text-black" data-bs-toggle="modal" data-bs-target="#pdfModal' . $data->id . '">
                                    <i class="ri-eye-fill"></i> PDF
                                </a>
                                <div class="modal fade" id="pdfModal' . $data->id . '" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">PDF Preview</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <iframe src="' . asset('storage/' . $data->path) . '" width="100%" height="500px" style="border: none;"></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                    } else {
                        return '<span>No file available</span>';
                    }
                })
                ->addColumn('action', function ($data) {
                    $button = '<a href="' . route('orders-circular.edit', $data->id) . '" class="btn btn-warning btn-sm"><i class="ri-edit-2-fill"></i></a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn
                    btn-danger btn-sm"><i class="ri-delete-bin-6-fill"></i></button>';
                    return $button;
                })
                ->rawColumns(['file', 'action'])
                ->make(true);
        }

        // $orders = OrderCircular::all();

        return view('orders-circular.index');
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
