<?php

namespace App\Http\Controllers;

use App\trek;
use Illuminate\Http\Request;

class TrekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details = Trek::all();
        return view('detail', ['details' => $details]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $news = Trek::all();
        return view('new', ['news' => $news]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $trek = new Trek;
        $trek->name = request('name');
        $trek->area = request('area');
        $trek->difficulty = request('difficulty');
        $trek->access = request('access');
        $trek->gear = request('gear');
        $trek->days = request('days');
        $trek->save();
        return redirect()->route('detail.detail', ['id' => $trek->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\trek  $trek
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $details = Trek::find($id);
        return view('/mountain', ['details' => $details]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\trek  $trek
     * @return \Illuminate\Http\Response
     */
    public function edit(trek $trek, $id)
    {
        $trek = Trek::find($id);
        return view ('edit', ['trek' => $trek]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\trek  $trek
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, trek $trek)
    {
        $trek = Trek::find($id);
        $trek->name = request('name');
        $trek->area = request('area');
        $trek->difficulty = request('difficulty');
        $trek->access = request('access');
        $trek->gear = request('gear');
        $trek->days = request('days');
        $trek->save();
        return redirect()->route('detail.detail', ['id' => $trek->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\trek  $trek
     * @return \Illuminate\Http\Response
     */
    public function destroy(trek $trek)
    {
        //
    }
}
