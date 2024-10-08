<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    function profile()
    {
        return view('adminpanel.profile.profile',[
            'user'=> Auth::user()
        ]);
    }

    function profile_edit()
    {
        return view('adminpanel.profile.edit',[
            'user'=> Auth::user()
        ]);
    }

    function profile_update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
       
            
        if(isset($request->password)){
            $user->password =  Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('profile')->with('success', 'Your Profile has been updated!');
    }
}
