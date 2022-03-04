<?php

namespace App\Http\Controllers;



use App\User;
use App\Profile;
use Illuminate\Http\Request;
//use Auth;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //to proteced my project by perevent user to access any page before login
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $id = Auth::id();
        if ($user->profile == null) {
            $profile = Profile::create([
                'province' => 'user name',
                'user_id' => $id,
                'gender' => 'meal',
                'bio' => 'Hello',
                'facebook' => 'https://www.facebook.com',
            ]);
        }
        return view('users.profile')->with('user', $user);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'province' => 'required',
            'gender' => 'required',
            'bio' => 'required',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->profile->province = $request->province;
        $user->profile->gender = $request->gender;
        $user->profile->bio = $request->bio;
        $user->profile->save();
        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
