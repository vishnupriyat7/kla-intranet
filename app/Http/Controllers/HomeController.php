<?php

namespace App\Http\Controllers;

use App\Models\Periodical;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $periodicals = Periodical::all();
        return view('home',compact('periodicals'));
    }
}
