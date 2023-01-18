<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Models\Leader;
use Illuminate\Http\Request;

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


    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Models\Leader;
     * @return \Illuminate\Http\Response
     */
    public function store($formData)
    {
        $leader = Leader::create([
            'firstName' => $formData->firstName,
            'middleName' => $formData->middleName,
            'lastName' => $formData->lastName,
            'phone' => $formData->phone
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
            dd(  "again not found" );
            return ['response' => 'failure'];
        }

        $leader->posts()->attach( $formData->post_id, ['isActive' => true] );

        if ( !($leader->posts->contains($formData->post_id)) ) {
            dd( "error again" );
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
        //
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
