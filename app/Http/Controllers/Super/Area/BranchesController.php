<?php

namespace App\Http\Controllers\Super\Area;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Post;
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
            ->with('ward', $ward);
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
            'tawi' => [
                'required', 'string', 'max:50',
                Rule::unique('branches', 'name')->where(function ($query) use ($ward_id) {
                    return $query->where('ward_id', $ward_id);
                }),
            ]
        ];

        $validate = Validator::make($request->all(), $rules, $messages = [
            'tawi.unique' => 'Tawi Hili Limeshasajiriwa Katika Mfumo.'
        ]);

        if ($validate->fails()) {
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

        if ($area) {
            return redirect()->back()
                ->with(['status' => 'success', 'message' => 'Tawi Limetengenezwa']);
        } else {
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
        if (!$branch) return redirect()->back();
        return view("interface.super.maeneo.tawi.tawiMoja")
            ->with('branch', $branch)
            ->with('trunks', $branch->trunks );
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


    /**
     * @param $id
     * @return array
     */
    public function changedbranchsApi($id)
    {
        $branch = Branch::where('id',  $id )->first();
        if ( $branch ){
            $leadersCollection = [];
            $firstFilter = [];

            $leadersCollection[] = $branch->leaders;
            $leadersCollection[] = $branch->ward->leaders;
            $leadersCollection[] = $branch->division->leaders;
            $leadersCollection[] = $branch->council->leaders;
            $leadersCollection[] = $branch->district->leaders;
            $leadersCollection[] = $branch->region->leaders;

            foreach ( $leadersCollection as $leaders ){
                foreach ( $leaders as $leader ){
                    $firstFilter[] = $leader;
                }
            }
            $leadersWithPosts = [];
            foreach( $firstFilter as $leader ){
                if ( $leader->pivot->isActive == true ){
                    $post = $this->apiPostObj($leader->pivot->post_id);
                    $leadersWithPosts[] = ['leader' => $leader, 'post' => $post];
                }
            }
            $leadersWithPosts = collect($leadersWithPosts)->groupBy('leader.side');
            return ['status' => 'success', 'leaders' => $leadersWithPosts, 'branch' => $branch ];
        }else{
            return ['status' => 'error', 'message' => 'Tawi Haukupatikana.'];
        }
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
