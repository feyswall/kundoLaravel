<?php

namespace App\Http\Controllers\Super\Area;

use App\Http\Controllers\Controller;
use App\Models\Council;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Region;
use \Illuminate\Validation\Rule;

class CouncilsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(District $district)
    {
        $halmashauri = $district->councils;
        $majimbo = $district->states;
        return view("interface.super.maeneo.halmashauri.orodhaHalmashauri")
            ->with('areas', $halmashauri)
            ->with('states', $majimbo )
            ->with('district', $district );
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
        $district_id = $request->wilaya_id;
        $rules = [
            'halmashauri' => [
                'required', 'string', 'max:50',
                Rule::unique('councils', 'name')->where(function ($query) use ($district_id) {
                    return $query->where('district_id', $district_id);
                }),
            ]
        ];

        $messages = [
            "halmashauri.required" => "Ni lazima kujaza jina la Halmashauri",
            "halmashauri.string"  => "Jina lazima lihusishe maneno pekee",
            "halmashauri.max" => "Jina Lihusishe herufi zisizozidi hamsini (50)",
            "halmashauri.unique" => "Jina limeshasajiriwa"
        ];

        $validate = Validator::make($request->all() ,$rules, $messages );

        if( $validate->fails() ){
            return redirect()->back()->withErrors($validate->errors());
        }

//        $region = Region::where("name", "Simiyu");
//
//        if ( ! ( $region->exists() ) ){
//            redirect()->back()->withErrors(['nullModal' =>  'Wilaya is Not Registered in The System']);
//        }

        $area = Council::create([
            'name' => $request->halmashauri,
            'district_id' => $request->wilaya_id
        ]);

        if ( $area ){
            return redirect()->back()
                ->with(['status' => 'success', 'message' => 'Wilaya Imetengenezwa']);
        }else{
            return redirect()->back()
                ->with(['status' => 'error', 'message' => 'Tumeshindwa Kutengeneza Tafadhali Jaribu Tena.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Council  $council
     * @return \Illuminate\Http\Response
     */
    public function show(Council $council)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Council  $council
     * @return \Illuminate\Http\Response
     */
    public function edit(Council $council)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Council  $council
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Council $council)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Council  $council
     * @return \Illuminate\Http\Response
     */
    public function destroy(Council $council)
    {
        //
    }


    
        /**
     * return
     */
    public function getDivisionsApi($id){
        $council = Council::find( $id );
        if ( $council ){
            $leadersCollection = [];
            $firstFilter = [];

            $divisons = $council->divisions;
            $leadersCollection[] = $council->leaders;
            $leadersCollection[] = $council->district->leaders;
            $leadersCollection[] = $council->region->leaders;

            $leadersWithPosts = [];
            foreach ( $leadersCollection as $leaders ){
                foreach ($leaders as $leader ){
                    $firstFilter[] = $leader;
                }
            }
            foreach( $firstFilter as $leader ){
                if ( $leader->pivot->isActive == true ){
                    $post = $this->apiPostObj($leader->pivot->post_id);
                    $leadersWithPosts[] = ['leader' => $leader, 'post' => $post];
                }
            }
            $leadersWithPosts = collect($leadersWithPosts)->groupBy('leader.side');
            return ['status' => 'success', 'response' => $divisons, 'leaders' => $leadersWithPosts, 'council' => $council ];
        }else{
            return ['status' => 'error', 'message' => 'Halmashauri Haukupatikana.'];
        }
//        return ['status' => 'success'];
    }

    /**
     * @param $id
     * @return mixed
     */
    public function apiPostObj($id) {
        $post = Post::find( $id );
        return $post;
    }

}
