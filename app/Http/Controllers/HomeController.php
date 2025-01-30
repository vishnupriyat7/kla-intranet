<?php

namespace App\Http\Controllers;

use App\Models\Periodical;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        //i want to show all periodicals on home page in alphabetical order of periodical name


        $periodicals = Periodical::with('periodicalMaster')
            ->join('periodical_masters', 'periodicals.periodical_master_id', '=', 'periodical_masters.id')
            ->orderBy('periodical_masters.name', 'asc')
            ->select('periodicals.*')
            ->get();
        return view('home', compact('periodicals'));
    }
}
