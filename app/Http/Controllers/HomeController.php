<?php

namespace App\Http\Controllers;

use App\Models\Periodical;
use App\Models\NewsUpdate;
use App\Models\OrderCircular;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Section;
use Illuminate\Support\Facades\DB;

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

        $months = collect(range(0, 5))->map(function ($i) {
            return [
                'no' => now()->subMonths(5 - $i)->format('n'),  // Month number (1-12)
                'name' => now()->subMonths(5 - $i)->format('F') . ' ' . now()->subMonths(5 - $i)->format('Y'),   // Full month name (January, February, etc.)
            ];
        });
        $periodicals = Periodical::with('periodicalMaster')
            ->where('status', 1)
            ->join('periodical_masters', 'periodicals.periodical_master_id', '=', 'periodical_masters.id')
            ->select('periodicals.*')
            ->orderBy('periodical_masters.name', 'asc')
            ->get();
        return view('orders-circular.order_circular_recent', compact('orders', 'months', 'orderType', 'periodicals'))->with('orderTypeKey', $request->type);
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
            'section' => 'required|exists:sections,id',
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

    public function checkStatus(Request $request)
    {
        $request->validate([
            'section_status' => 'required',
        ]);
        $order_status = OrderCircular::where('section_id', $request->section_status)
            ->where('status', 0)
            ->orderBy('date', 'desc')
            ->get();
        dd($order_status);
    }
}

