<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Models\Leader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use function Webmozart\Assert\Tests\StaticAnalysis\false;

class LeadersController extends Controller
{

    function __construct()
    {

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function removeFromPower(Request $request)
    {
        $table = $request->input('table');
        $leader = Leader::where('id', $request->input('leader_id'))->first();
        if($table == 'region'){
            $this->detachLeaderFromRegion($leader, $request->input('post_id'), $request->input('region_id'));
        }elseif($table == 'district'){
            $this->detachLeaderFromDistrict($leader, $request->input('post_id'), $request->input('district_id'));
        }elseif($table == 'council'){
            $this->detachLeaderFromCouncil($leader, $request->input('post_id'), $request->input('council_id'));
        }elseif($table == 'division'){
            $this->detachLeaderFromDivision($leader, $request->input('post_id'), $request->input('division_id'));
        }elseif($table == "ward"){
            $this->detachLeaderFromWard($leader, $request->input('post_id'), $request->input('ward_id'));
        }elseif($table == "branch") {
            $this->detachLeaderFromBranch($leader, $request->input('post_id'), $request->input('branch_id'));
        }elseif ($table == 'trunk'){
            $this->detachLeaderFromBranch($leader, $request->input('post_id'), $request->input('branch_id'));
        }
        $this->deactivateALeader($leader, $request->input('post_id') );
        return redirect()->back()->with(['status' => 'success', 'message' => 'Kiongozi Ametolewa Madarakani']);
    }

    private function detachLeaderFromRegion(Leader $leader, $post_id, $region_id)
    {
        $pivit = $leader->regions()->where('post_id', $post_id)
            ->where('isActive', true)
            ->where('region_id', $region_id)
            ->first()->pivot;
        $pivit->isActive = false;
        $pivit->save();
    }

    private function detachLeaderFromDistrict(Leader $leader, $post_id, $district_id)
    {
        $pivit = $leader->districts()->where('post_id', $post_id)
            ->where('isActive', true)
            ->where('district_id', $district_id)
            ->first()->pivot;
        $pivit->isActive = false;
        $pivit->save();
    }

    private function detachLeaderFromCouncil(Leader $leader, $post_id, $council_id)
    {
        $pivit = $leader->councils()->where('post_id', $post_id)
            ->where('isActive', true)
            ->where('council_id', $council_id)
            ->first()->pivot;
        $pivit->isActive = false;
        $pivit->save();
    }

    private function detachLeaderFromDivision(Leader $leader, $post_id, $division_id)
    {
        $pivit = $leader->divisions()->where('post_id', $post_id)
            ->where('isActive', true)
            ->where('division_id', $division_id)
            ->first()->pivot;
        $pivit->isActive = false;
        $pivit->save();
    }


    private function detachLeaderFromWard(Leader $leader, $post_id, $ward_id)
    {
        $pivit = $leader->wards()->where('post_id', $post_id)
            ->where('isActive', true)
            ->where('ward_id', $ward_id)
            ->first()->pivot;
        $pivit->isActive = false;
        $pivit->save();
    }


    private function detachLeaderFromBranch(Leader $leader, $post_id, $branch_id)
    {
        $pivit = $leader->branches()->where('post_id', $post_id)
            ->where('isActive', true)
            ->where('branch_id', $branch_id)
            ->first()->pivot;
        $pivit->isActive = false;
        $pivit->save();
    }

    private function deactivateALeader(Leader $leader, $post_id)
    {
        $pivoted = $leader->posts()->where('post_id', $post_id)
            ->where('isActive',  true)
            ->first()->pivot;
        $pivoted->isActive = false;
        $pivoted->save();
    }



    public function store($formData)
    {
        // first create user with exact details
        $gen = \Spatie\Permission\Models\Role::where('name', 'general')->first();

        if ( !$gen ){
            $general = \Spatie\Permission\Models\Role::create([
                'name' => 'general',
            ]);
        }

        $firstAndLastName = strtolower($formData->firstName)."".strtolower($formData->lastName);
        $email = $firstAndLastName.".general@kims.com";

        $rules = [
            'email' => 'unique:users,email',
        ];

        $validate = Validator::make( ['email' => $email], $rules );

        if ( $validate->fails() ) {
            return null;
//            return ['status' => 'error', 'message' => 'Email Imejirudia Katika Mfumo.'];
        }


        $user = \App\Models\User::create([
            'name' => $firstAndLastName,
            'email' => $email,
            'password' => Hash::make($firstAndLastName),
        ]);

        if ( !$user ){
            return null;
        }

        $phone = preg_replace("/^0/", "255", $formData->phone);
        $phone = preg_replace("/\s/", "", $phone );
        $leader = Leader::create([
            'firstName' => $formData->firstName,
            'middleName' => $formData->middleName,
            'lastName' => $formData->lastName,
            'phone' => $phone,
            'side' => $formData->side,
            'user_id' => $user->id,
        ]);
        return $leader;
    }


    /**
     * @param $ath, $formData, $leader
     * @return array
     */
    public function attachMany($ath, $formData, $leader){
        $ath->attach($formData->side_id, [
            'isActive' => true,
            'post_id' => $formData->post_id,
            'created_at' => now()
        ]);

        if ( !($ath->get()->contains($formData->side_id)) ){
//            dd(  "again not found" );
            return ['response' => 'failure'];
        }

        $leader->posts()->attach( $formData->post_id, ['isActive' => true] );

        if ( !($leader->posts->contains($formData->post_id)) ) {
//            dd( "error again" );
            $ath->detach( $formData->side_id );
                return ['response' => 'failure'];
        }
        return ['response' => 'success'];
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Leader  $leader
     * @return \Illuminate\Http\Response
     */
    public function show(Leader $leader)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Leader  $leader
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
     * @param  \App\Models\Leader  $leader
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Leader $leader)
    {
        $rules = [
            'firstName' => [
                'required', 'string', 'max:50',
            ],
            'middleName' => [
                'required', 'string', 'max:50',
            ],
            'lastName' => [
                'required', 'string', 'max:50',
            ],

            'phone' => [
                'required', 'string', 'max:15',
            ],
        ];

        $messages = [
            "firstName.required" => "Jina la kwanza lazima lijazwe",
            "firstName.string"  => "Jina la kwanza lazima liwe na maneno pekee",
            "firstName.max" => "Jina la kwanza lisizidi herufi hamsini (50)",

            "middleName.required" => "Jina la kati lazima lijazwe!",
            "middleName.string"  => "Jina la kati lihusishe maneno pekee",
            "middleName.max" => "Jina la kati lisizidi herufi hamsini (50)",

            "lastName.required" => "Jina la mwisho lazima lijazwe!",
            "lastName.string"  => "Jina lazima lihusishe maneno pekee",
            "lastName.max" => "Jina la mwisho lisizidi herufi hamsini (50)",

            "phone.required" => "Ni lazima kujaza namba",
            "phone.max" => "Namba Uliyoingiza siyo sahihi",
        ];

        $validate = Validator::make($request->all() ,$rules, $messages );

        if( $validate->fails() ){
            return ['status' => 'error','name' => 'validation', 'error' => $validate->errors()];
        }

        if( !( preg_match("/^255[0-9]{9}$/", $request->phone ) ) ){
            return ['status' => 'error','name' => 'validation', 'error' => ['phone' => 'Namba ya simu si sahihi yabididi kuandikwa "255628960877"'] ];
        }
        $leader->firstName = $request->firstName;
        $leader->middleName = $request->middleName;
        $leader->lastName = $request->lastName;
        $leader->phone = $request->phone;

        $leader->save();

       return ['status' => 'success', 'leader' => $leader];

    }


    public static function  filterLeaders($leaders_id, $post){
        $onQueue = [];
        $qualified = DB::table('leader_post')
            ->whereIn('leader_id', $leaders_id)
            ->where('post_id', $post->id)
            ->where('isActive', true)
            ->pluck('leader_id');
        $collectedDatas = collect($qualified)->groupBy('post_id');

            foreach ( $collectedDatas as $collected ){
                $data = \App\Models\Leader::whereIn('id', $collected)->get();
                $onQueue[] = $data;
            }

//            foreach (  $onQueue as $key => $qualified){
//                foreach ( $qualified as $leader ){
//                    $data = [$leader];
//                    $all_leaders[] = $data;
//                }
//            }
        return $onQueue;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Leader  $leader
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leader $leader)
    {
        //
    }
}
