<?php

namespace App\Http\Controllers;

use App\Models\Periodical;
use App\Models\NewsUpdate;

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

        $newsupdates = NewsUpdate::where('status', '1')->orderBy('date', 'desc')->get();

        return view('home', compact('periodicals', 'newsupdates'));
    }
}
