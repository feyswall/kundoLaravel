<?php

namespace App\Http\Controllers\Super;

use App\Models\Sial;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sials = Sial::all();
        return view('interface.super.ziara.orodhaZiara')
        ->with('sials', $sials);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('interface.super.ziara.ingizaZiara');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sial  $sial
     * @return \Illuminate\Http\Response
     */
    public function show(Sial $sial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sial  $sial
     * @return \Illuminate\Http\Response
     */
    public function edit(Sial $sial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sial  $sial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sial $sial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sial  $sial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sial $sial)
    {
        //
    }
}
