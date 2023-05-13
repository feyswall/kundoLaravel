<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Models\Charity;
use Illuminate\Http\Request;

class CharitiesController extends Controller
{
    public function index()
    {
        $charities = Charity::all();
        return view('interface.super.charities.allCharities')
            ->with('charities', $charities);
    }

    public function show($id)
    {
        $charity = Charity::where('id', $id)->first();
        dd( $charity );
    }

    public function store(Request $request)
    {
        dd( $request->all() );
    }
}
