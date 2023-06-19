<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Models\Leader;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Query\Builder;
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

    public function sendingSms()
    {

    }

    public function assignPowerToPresentLeader($leader_id, $table, $post_id, $side_id, $side_column)
    {
        $leaderHasPostQueryBuilder = DB::table($table)->select('*')
            ->where('leader_id', $leader_id)
            ->where('post_id', $post_id)
            ->where('isActive', true);
        if ($leaderHasPostQueryBuilder->exists()) {
            return ([
                'status' => 'error',
                'message' => 'Kiongozi huyu Tayari Anawadhifa Huu.',
            ]);
        }
        // find out if this post has an active leader here
        $class = "App\Models\Post";
        $post = $class::where('id', $post_id)->first();
        $allowed = $post->numberCount;
        $leaderSideQueryBuilder = DB::table($table)
            ->select('*')
            ->where('post_id', $post->id)
            ->where('isActive', true )
            ->where($side_column, $side_id);
        if ($leaderSideQueryBuilder->exists()){
            if ( $leaderSideQueryBuilder->count() >= $allowed ){
                return ([
                    'status' => 'error',
                    'message' => 'Kiongozi mwenye wadhifa wa '.$post->name.' Hawaruhusiwi kuzidi '.$allowed,
                ]);
            }
        }
        return ['status' => 'success'];
    }

    public function removeFromPower(Request $request)
    {
        $table = $request->input('table');
        $column_id = $request->input('column_id');
        $column_value = $request->input('column_value');
        $leader = Leader::where('id', $request->input('leader_id'))->first();
        $this->detachLeaderFromArea($leader, $request->input('post_id'),$table, $column_id, $column_value);
        $this->deactivateALeaderPosts($leader, $request->input('post_id') );
        return redirect()->back()->with(['status' => 'success', 'message' => 'Kiongozi Ametolewa Madarakani']);
    }

    private function detachLeaderFromArea(Leader $leader, $post_id, $table,$column_id, $column_value)
    {
        $leader->$table()->where('post_id', $post_id)
            ->where('isActive', true)
            ->where($column_id, $column_value)
            ->update(['isActive' => false]);
        $leader->save();
    }

    private function deactivateALeaderPosts(Leader $leader, $post_id)
    {
        $leader->posts()
            ->where('post_id', $post_id)
            ->where('isActive',  true)
            ->update(['isActive' => false]);
        $leader->save();
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
        }
        $user = \App\Models\User::create([
            'name' => $firstAndLastName,
            'email' => $email,
            'password' => Hash::make($firstAndLastName),
        ]);
        if ( !$user ){
            return null;
        }
        // assign a role to a user
        $user->assignRole('general');
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
    public function attachMany($ath, $formData, $leader ){
        $ath->attach($formData->side_id, [
            'isActive' => true,
            'post_id' => $formData->post_id,
            'created_at' => now(),
        ]);
        if ( !($ath->get()->contains($formData->side_id)) ){
            return ['response' => 'failure'];
        }
        $leader->posts()->attach( $formData->post_id, ['isActive' => true] );
        if ( !($leader->posts->contains($formData->post_id)) ) {
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
            return ['status' => 'error','name' => 'validation',
                'error' => $validate->errors(),
                'message' => 'Kuna tatizo kwenye uandishi, tafadhali kagua na ujaribu tena'];
        }
        if( !( preg_match("/^255[0-9]{9}$/", $request->phone ) ) ){
            return ['status' => 'error','name' => 'validation',
                'message' => 'Namba ya simu si sahihi yabidi kuandikwa "255628960877"',
                'error' => ['phone' => 'Namba ya simu si sahihi yabidi kuandikwa "255628960877"'] ];
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


    public function currentLocationLeadersLogic(BelongsToMany $leaders)
    {
        return $leaders->with('posts', function($query){
            $query->where(function ($query){
                $query->where('side', 'chama');
            })
            ->where('area', 'tawi');
        })
        ->where(function ($query){
            $query->where('side', 'chama')
            ->orWhere('side', 'both');
        })
        ->get();
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
