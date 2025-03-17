<?php

namespace App\Http\Controllers;

use App\Models\Periodical;
use App\Models\NewsUpdate;
use App\Models\OrderCircular;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
        return view('newsupdates.viewmore', compact('newsupdates'));
    }

    public function orderCircular(Request $request)
    {
        $startDate = Carbon::now()->subMonths(5)->startOfMonth(); // 5 months ago (1st day)
        $endDate = Carbon::now()->endOfMonth(); // Last day of the current month
        if ($request->type == 'goms') {
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
        return view('orders-circular.order_circular_recent', compact('orders', 'months', 'orderType', 'periodicals'));
    }

    public function search(Request $request)
    {
        $query = OrderCircular::query();

        if ($request->has('anysearch')) {
            $search = $request->anysearch;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('keywords', 'LIKE', "%{$search}%"); // Add more columns as needed
            });
        }
        $orders = $query->paginate(20); // Paginate results

        return view('partials.search', compact('orders'));
    }
}
