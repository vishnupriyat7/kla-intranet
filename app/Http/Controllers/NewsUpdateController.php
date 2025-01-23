<?php

namespace App\Http\Controllers;

use App\Models\NewsUpdate;
use Illuminate\Http\Request;

class NewsUpdateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = NewsUpdate::all();
        return view('newsupdates.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(NewsUpdate $newsUpdate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NewsUpdate $newsUpdate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NewsUpdate $newsUpdate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NewsUpdate $newsUpdate)
    {
        //
    }
}
