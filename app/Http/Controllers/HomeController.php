<?php

namespace App\Http\Controllers;

use App\Models\Periodical;
use App\Models\NewsUpdate;
use App\Models\OrderCircular;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Section;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class HomeController extends Controller
{
    public function index()
    {
        //want to show all distinct periodicals with latest periodical by status published(1) on home page in alphabetical order of periodical name
        $periodicals = Periodical::with('periodicalMaster')
            ->where('status', 1)
            ->join('periodical_masters', 'periodicals.periodical_master_id', '=', 'periodical_masters.id')
            ->select('periodicals.*')
            ->orderBy('periodical_masters.name', 'asc')
            ->get();
        $newsupdates = NewsUpdate::where('status', '1')
            ->orderBy('date', 'desc')
            ->limit(5)
            ->get();
        $gos = OrderCircular::where('type', 'G')
            ->where('status', '1') // Fetch records in range
            ->orderBy('date', 'desc')
            ->limit(5)
            ->get();
        $oos = OrderCircular::where('type', 'O')
            ->where('status', '1')
            ->orderBy('date', 'desc')
            ->limit(5)
            ->get();
        $crcls = OrderCircular::where('type', 'C')
            ->where('status', '1')
            ->orderBy('date', 'desc')
            ->limit(5)
            ->get();
        $goCount = OrderCircular::where('type', 'G')
            ->whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)
            ->where('status', '1')
            ->count();
        $ooCount = OrderCircular::where('type', 'O')
            ->whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)
            ->where('status', '1')
            ->count();
        $clrCount = OrderCircular::where('type', 'C')
            ->whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)
            ->where('status', '1')
            ->count();
        return view('home', compact('periodicals', 'newsupdates', 'gos', 'oos', 'crcls', 'goCount', 'ooCount', 'clrCount'));
    }

    public function updatesMore()
    {
        $newsupdates = NewsUpdate::where('status', '1')
            ->orderBy('date', 'desc')
            ->skip(3)
            ->take(PHP_INT_MAX)
            ->get();
        $periodicals = Periodical::with('periodicalMaster')
            ->where('status', 1)
            ->join('periodical_masters', 'periodicals.periodical_master_id', '=', 'periodical_masters.id')
            ->select('periodicals.*')
            ->orderBy('periodical_masters.name', 'asc')
            ->get();
        return view('newsupdates.viewmore', compact('newsupdates', 'periodicals'));
    }

    public function orderCircular(Request $request)
    {
        $startDate = Carbon::now()->subMonths(5)->startOfMonth(); // 5 months ago (1st day)
        $endDate = Carbon::now()->endOfMonth(); // Last day of the current month

        if ($request->type == 'go') {
            $orders = OrderCircular::where('type', 'G')
                ->where('status', '1')
                ->whereBetween('date', [$startDate, $endDate]) // Fetch records in range
                ->orderBy('date', 'desc')
                ->get();
            $orderType = 'Government Order';
        } elseif ($request->type == 'goms') {
            $orders = OrderCircular::where('type', 'G')
                ->where('go_type', 'M')
                ->where('status', '1')
                ->whereBetween('date', [$startDate, $endDate]) // Fetch records in range
                ->orderBy('date', 'desc')
                ->get();
            $orderType = 'GO Manuscript';
        } elseif ($request->type == 'gor') {
            $orders = OrderCircular::where('type', 'G')
                ->where('go_type', 'R')
                ->where('status', '1')
                ->whereBetween('date', [$startDate, $endDate]) // Fetch records in range
                ->orderBy('date', 'desc')
                ->get();
            $orderType = 'GO Routine';
        } elseif ($request->type == 'oo') {
            $orders = OrderCircular::where('type', 'O')
                ->where('status', '1')
                ->whereBetween('date', [$startDate, $endDate]) // Fetch records in range
                ->orderBy('date', 'desc')
                ->get();
            $orderType = 'Office Order';
        } elseif ($request->type == 'cr') {
            $orders = OrderCircular::where('type', 'C')
                ->where('status', '1')
                ->whereBetween('date', [$startDate, $endDate]) // Fetch records in range
                ->orderBy('date', 'desc')
                ->get();
            $orderType = 'Circular';
        }

        $type = $request->type == 'goms' ? 'M' : ($request->type == 'gor' ? 'R' : '');

        $months = collect(range(0, 5))->map(function ($i) {
            return [
                'no' => now()->subMonths(5 - $i)->format('m'),  // Month number (1-12)
                'name' => now()->subMonths(5 - $i)->format('F') . ' ' . now()->subMonths(5 - $i)->format('Y'),   // Full month name (January, February, etc.)
            ];
        });
        // Check if the request is an Ajax call
        if ($request->ajax()) {
            $month = $request->get('month');
            // $orders = $orders->filter(function ($order) use ($month) {
            //     return \Carbon\Carbon::parse($order->date)->format('n') == $month;
            // });
            $go_type = $request->get('go_type');
            // $type = $request->type;
            $orders = OrderCircular::where('status', '1')
                ->whereBetween('date', [$startDate, $endDate])
                ->when($request->type == 'go', function ($q) {
                    return $q->where('type', 'G');
                })
                ->when($request->type == 'goms', function ($q) {
                    return $q->where('type', 'G')->where('go_type', 'M');
                })
                ->when($request->type == 'gor', function ($q) {
                    return $q->where('type', 'G')->where('go_type', 'R');
                })
                ->when($request->type == 'oo', function ($q) {
                    return $q->where('type', 'O');
                })
                ->when($request->type == 'cr', function ($q) {
                    return $q->where('type', 'C');
                })
                ->get();
            $orders = $orders->filter(function ($order) use ($month) {
                return \Carbon\Carbon::parse($order->date)->format('m') == str_pad($month, 2, '0', STR_PAD_LEFT);
            });

            return DataTables::of($orders)
                ->addIndexColumn()
                ->addColumn('title', function ($order) {
                    return $order->title;
                })
                ->addColumn('date', function ($order) {
                    return $order->date;
                })
                ->addColumn('view', function ($order) {
                    return $order->path
                        ? '<a href="' . asset('storage/' . $order->path) . '" target="_blank"><i class="fas fa-eye text-primary"></i></a>'
                        : '<i class="fas fa-ban text-danger" title="Not uploaded"></i>';
                })
                ->rawColumns(['view'])
                ->make(true);
        }

        $periodicals = Periodical::with('periodicalMaster')
            ->where('status', 1)
            ->join('periodical_masters', 'periodicals.periodical_master_id', '=', 'periodical_masters.id')
            ->select('periodicals.*')
            ->orderBy('periodical_masters.name', 'asc')
            ->get();
        // return view('orders-circular.order_circular_recent', compact('orders', 'months', 'orderType', 'periodicals'))->with('orderTypeKey', $request->type);
        // return view('orders-circular.order_circular_recent', compact('orders', 'months', 'orderType', 'periodicals'))->with('orderTypeKey', $request->type);
        return view('orders-circular.order_circular_recent', compact('orders', 'months', 'orderType', 'periodicals', 'type'))
            ->with('orderTypeKey', $request->type);
    }

    public function search(Request $request)
    {
        $results = collect();
        if ($request->has('anysearch')) {
            $search = $request->anysearch;

            // Get all table names from the database, excluding system tables
            $tables = DB::select("SHOW TABLES");
            $excludedTables = [
                'cache',
                'cache_locks',
                'failed_jobs',
                'job_batches',
                'jobs',
                'migrations',
                'password_reset_tokens',
                'sessions',
                'users',
                'periodical_masters',
                'periodicals'
            ];

            foreach ($tables as $table) {
                $tableName = array_values((array) $table)[0];

                // Skip system tables
                if (in_array($tableName, $excludedTables)) {
                    continue;
                }

                // Get all column names from the current table
                $columns = DB::getSchemaBuilder()->getColumnListing($tableName);

                // Build the query for the current table
                $query = DB::table($tableName);
                foreach ($columns as $column) {
                    $query->orWhere($column, 'LIKE', "%{$search}%");
                }

                // Merge the results with the previous ones
                $tableResults = $query->get();
                $results = $results->merge($tableResults);
            }
        }

        // return response()->json($results);

        // $orders = $query->paginate(20);

        $periodicals = Periodical::with('periodicalMaster')
            ->where('status', 1)
            ->join('periodical_masters', 'periodicals.periodical_master_id', '=', 'periodical_masters.id')
            ->select('periodicals.*')
            ->orderBy('periodical_masters.name', 'asc')
            ->get();
        return view('partials.search', compact('results', 'periodicals'));
    }

    public function uploadRequest(Request $request)
    {
        $periodicals = Periodical::with('periodicalMaster')
            ->where('status', 1)
            ->join('periodical_masters', 'periodicals.periodical_master_id', '=', 'periodical_masters.id')
            ->select('periodicals.*')
            ->orderBy('periodical_masters.name', 'asc')
            ->get();
        $sections = Section::get();
        $save_request = '';
        return view('orders-circular.upload_request', compact('periodicals', 'save_request', 'sections'));
    }

    public function storeUploadRequest(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'go_type' => 'nullable',
            'serviceMember' => 'nullable',
            'category' => 'nullable',
            'memb' => 'nullable',
            'no' => 'required',
            'date' => 'required|date',
            'title' => 'required',
            'keywords' => 'nullable',
            'section' => 'required',
            'path' => 'required|file|mimes:pdf|max:1048576',
        ]);
        $year = date('Y', strtotime($request->date));
        $categoryFolder = match ($request->type) {
            'G' => 'GovtOrders',
            'O' => 'OfficeOrders',
            'C' => 'Circulars',
        };
        $filePath = $request->file('path')->store("uploads/orders-circlular/{$year}/{$categoryFolder}", 'public');
        OrderCircular::create([
            'type' => $request->type,
            'go_type' => $request->go_type ?? null,
            'sub_type' => $request->serviceMember ?? null,
            'sub_sub_type' => $request->category ?? null,
            'number' => $request->no,
            'date' => $request->date,
            'title' => $request->title,
            'keywords' => $request->keywords,
            'path' => $filePath,
            'status' => 0,
            'section_id' => $request->section
        ]);
        return redirect()->route('home.upload-request')->with('success', 'Your request has been saved successfully.');
    }
    // Function for advanced search for order, circular, office order and news updates
    public function advancedSearch(Request $request)
    {
        $orderResults = collect();
        $newsResults = collect();

        // Validate if month is selected but year is not
        if ($request->filled('month') && !$request->filled('year')) {
            return redirect()->back()->withErrors(['error' => 'Please select a year when choosing a month.']);
        }

        // Search in order_circulars table
        if ($request->filled('order_type') && $request->order_type !== 'news') {
            $query = DB::table('order_circulars');

            // Filter by Order Type
            if ($request->filled('order_type')) {
                $query->where('type', $request->order_type);
            }

            // Ensure 'date' column exists and is valid
            if ($request->filled('year') || $request->filled('month') || $request->filled('date')) {
                $query->whereNotNull('date');
            }

            // Filter by Year (Extract from 'date' column)
            if ($request->filled('year')) {
                $query->whereYear('date', '=', $request->year);
            }

            // Filter by Month (Extract from 'date' column)
            if ($request->filled('month')) {
                $query->whereMonth('date', '=', $request->month);
            }

            // Filter by Exact Date
            if ($request->filled('date')) {
                $query->whereDate('date', '=', $request->date);
            }

            // Filter by Keyword
            if ($request->filled('keyword')) {
                $query->where(function ($q) use ($request) {
                    $q->where('title', 'LIKE', "%{$request->keyword}%")
                        ->orWhere('keywords', 'LIKE', "%{$request->keyword}%");;
                });
            }

            $orderResults = $query->get();
        }

        // Search in news_updates table (only if order_type is 'news')
        if ($request->filled('order_type') && $request->order_type === 'news') {
            $newsQuery = DB::table('news_updates');

            // Filter by Year
            if ($request->filled('year')) {
                $newsQuery->whereYear('published_date', $request->year);
            }

            // Filter by Date
            if ($request->filled('date')) {
                $newsQuery->whereDate('published_date', $request->date);
            }

            // Filter by Month
            if ($request->filled('month')) {
                $newsQuery->whereMonth('published_date', $request->month);
            }

            // Filter by Keyword
            if ($request->filled('keyword')) {
                $newsQuery->where(function ($q) use ($request) {
                    $q->where('headline', 'LIKE', "%{$request->keyword}%")
                        ->orWhere('summary', 'LIKE', "%{$request->keyword}%")
                        ->orWhere('content', 'LIKE', "%{$request->keyword}%");
                });
            }

            $newsResults = $newsQuery->get();
        }

        // Merge both results
        $results = $orderResults->merge($newsResults);

        // Fetch periodicals (if needed)
        $periodicals = Periodical::with('periodicalMaster')
            ->where('status', 1)
            ->join('periodical_masters', 'periodicals.periodical_master_id', '=', 'periodical_masters.id')
            ->select('periodicals.*')
            ->orderBy('periodical_masters.name', 'asc')
            ->get();

        return view('partials.advanced-search', compact('results', 'periodicals'));
    }
}
