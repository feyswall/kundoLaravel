<?php

namespace App\Http\Controllers\Super\Area;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class BranchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Ward $ward)
    {
        $matawi = $ward->branches;
        return view("interface.super.maeneo.tawi.orodhaMatawi")
            ->with('areas', $matawi)
            ->with('ward', $ward );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $ward_id = $request->ward_id;

        $rules = [
            'tawi' => ['required', 'string', 'max:50',
                Rule::unique('branches', 'name')->where(function ($query) use($ward_id ) {
                    return $query->where('ward_id', $ward_id);
                }),
                ]
        ];

        $validate = Validator::make($request->all() ,$rules, $messages = [
            'tawi.unique' => 'Tawi Hili Limeshasajiriwa Katika Mfumo.'
        ]);

        if( $validate->fails() ){
            return redirect()->back()->withErrors($validate->errors());
        }

//        $region = Region::where("name", "Simiyu");
//
//        if ( ! ( $region->exists() ) ){
//            redirect()->back()->withErrors(['nullModal' =>  'Wilaya is Not Registered in The System']);
//        }

        $area = Branch::create([
            'name' => $request->tawi,
            'ward_id' => $request->ward_id,
        ]);

        if ( $area ){
            return redirect()->back()
                ->with(['status' => 'success', 'message' => 'Kata Imetengenezwa']);
        }else{
            return redirect()->back()
                ->with(['status' => 'error', 'message' => 'Tumeshindwa Kutengeneza Tafadhali Jaribu Tena.']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        if ( !$branch ) return redirect()->back();
        return view("interface.super.maeneo.tawi.tawiMoja")
            ->with('branch', $branch);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branch $branch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        //
    }
}
