<?php

namespace App\Http\Controllers;

use App\Models\Periodical;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $periodicals = Periodical::with('periodicalMaster')->get();
        return view('home',compact('periodicals'));
    }
}
