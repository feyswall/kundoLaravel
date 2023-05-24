<?php

namespace App\Http\Controllers\Super\Area;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\AreaDescription;
use App\Models\District;
use App\Models\Leader;
use App\Models\Post;
use App\Models\Region;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class DistrictsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $region = Region::with("districts.leaders")->where('name', 'simiyu')->first();
//        dd( $region->wards->count() );
        $wilaya = $region->districts;
        return view("interface.super.maeneo.wilaya.orodhaWilaya")
            ->with('areas', $wilaya)
            ->with('region', $region);
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
        $rules = [
          'wilaya' => 'required|string|max:50|unique:districts,name'
        ];

        $validate = Validator::make($request->all() ,$rules);

        if( $validate->fails() ){
            return redirect()->back()->withErrors($validate->errors());
        }

        $region = Region::where("name", "Simiyu");

        if ( ! ( $region->exists() ) ){
            redirect()->back()->withErrors(['nullModal' =>  'Wilaya is Not Registered in The System']);
        }

        $area = District::create([
            'name' => $request->wilaya,
            'region_id' => $region->first()->id
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
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(Leader $leader)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area $area)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area)
    {
        //
    }


    public function getCouncilsApi($id){
        $district = District::find( $id );
        if ( $district ){
            $leadersCollection = [];
            $firstFilter = [];

            $councils = $district->councils;
            $leadersCollection[] = $district->leaders;
            $leadersCollection[] = $district->region->leaders;

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
            return ['status' => 'success', 'response' => $councils, 'leaders' => $leadersWithPosts, 'district' => $district ];
        }else{
            return ['status' => 'error', 'message' => 'wilaya Haukupatikana.'];
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
