<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
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
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.show')->with('status', 'profile-updated');
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
                    return redirect()->back();
                    // return response()->json(['success' => "Password changed"]);
                }
            } else{
                return "Error: not match";
                // return response()->json(['error' => "Password do not Match"]);
            }
        }
        else{
            return "Wrong old password";
            // return response()->json(['error' => "Oooops..!Wrong Old Password"]);
        }
    }
}
