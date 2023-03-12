<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Rules\PhoneNumber;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

    public function show(){
        $user_data = Auth::user();
        return view('profile.user-profile')->with('user',$user_data);
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $rules = [
            'name' => [
                'required', 'string', 'max:50',
            ],
            'email' => [
                'required', 'string', 'max:50', 'unique:users,email',
            ],
        ];

        $messages = [
            "name.required" => "Jina lazima lijazwe",
            "name.string"  => "Jina lazima liwe na maneno pekee",
            "name.max" => "Jina lisizidi herufi hamsini (50)",

            "email.required" => "Barua pepe lazima ijazwe",
            "email.string"  => "Barua pepe lazima iwe na maneno pekee",
            "email.max" => "Barua pepe isizidi herufi hamsini (50)",
            "email.unique" => "Email tayari imepatikana katika mfumo",
        ];

        $validate = Validator::make($request->all() ,$rules, $messages );

        if( $validate->fails() ){
            return redirect()->back()->withErrors($validate->errors());
        }

        //Breeze Code start here
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        //Breeze code ends here

        $udpate =  $request->user()->save();
        if($udpate){
            return redirect()->back()
            ->with(['status' => 'success', 'message' => 'Taarifa zimebadilishwa!']);
        }else
        return redirect()->back()
            ->with(['status' => 'error', 'message' => 'Taarifa hazijabadilishwa, kuna tatizo!']);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function password(Request $request){
        $rules = [
            'old_password' => [
                'required', 'string', 'max:50',
            ],
            'new_password' => [
                'required', 'string', 'max:50',
            ],
            'confirm_password' => [
                'required', 'string', 'max:50',
            ],
        ];

        $messages = [
            "old_password.required" => "Nywila ya zamani lazima ijazwe",
            "old_password.string"  => "Nywila ya zamani lazima iwe na maneno pekee",
            "old_password.max" => "Nywila ya zamani isizidi herufi hamsini (50)",

            "new_password.required" => "Nywila mpya lazima ijazwe",
            "new_password.string"  => "Nywila mpya lazima iwe na maneno pekee",
            "new_password.max" => "Nywila mpya isizidi herufi hamsini (50)",

            "confirm_password.required" => "Nywila ya marudio lazima ijazwe",
            "confirm_password.string"  => "Nywila ya marudio lazima iwe na maneno pekee",
            "confirm_password.max" => "Nywila ya marudio isizidi herufi hamsini (50)",
        ];

        $validate = Validator::make($request->all() ,$rules, $messages );

        if( $validate->fails() ){
            return redirect()->back()->withErrors($validate->errors());
        }

        if(Hash::check($request->old_password, Auth::user()->password) ){
            if($request->new_password == $request->confirm_password){
               $change =  User::where('id', Auth::user()->id)->update(['password' => Hash::make($request->new_password)]);
                if($change){
                 return redirect()->back()
                 ->with(['status' => 'success', 'message' => 'Nywila imebadilishwa!']);
                }
            } else{
                return redirect()->back()
                ->with(['status' => 'error', 'message' => 'Nywila ya mpya na nywila ya marudio hazifanani!']);
            }
        }
        else{
            return redirect()->back()
                ->with(['status' => 'error', 'message' => 'Nywila ya zamani sio sahihi!']);
        }
    }


    public function phone($id, Request $request)
    {
        $rules = [
            'phone' => ['required', new PhoneNumber() ],
        ];
        $messages = [
            'required' => 'namba ya simu Inahitajika',
        ];
        $validate = Validator::make($request->all(), $rules, $messages);
        if ( $validate->fails() ){
            return \redirect()->back()->withErrors( $validate->errors() );
        }
        $userBuilder = User::where('id', $id);
        if( !($userBuilder->exists()) ){
              return \redirect()->back()->with(['status' => 'error', 'message' => 'Imeshindikana Tafadhari Jaribu Tena']);
        }
        $user = $userBuilder->first();
        if( !($user->leader) ){
            return \redirect()->back()->with(['status' => 'error', 'message' => 'Imeshindikana Tafadhari Jaribu Tena']);
        }
        // change the phone number
        $phone = $request->phone;

        if( preg_match("/^255[0-9]{9}$/", $phone ) ){
            return ['status' => 'error','name' => 'validation', 'error' => ['phone' => 'Namba ya simu si sahihi yabididi kuandikwa "0628960877"'] ];
        }
        $phone = preg_replace("/^0/", "255", $phone);
        $phone = preg_replace("/\s/", "", $phone );

        $isUpdated = $user->leader->update([
            'phone' => $phone
        ]);

        if( $isUpdated ){
            return \redirect()->back()->with(['status' => 'success', 'message' => 'Namba ya simu Imebadirishwa']);
        }else{
            return \redirect()->back()->with(['status' => 'error', 'message' => 'imeshindikana tafadhali jaribu tena']);
        }

    }


}
