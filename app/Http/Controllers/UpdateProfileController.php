<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class UpdateProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function editProfile(User $user)
    {
        //return object user
        $user = Auth::user(); //check user as already login or not
        // return view('auth.editProfile', compact('user')); //same as below
        return view('auth.editProfile')->with('user',$user);
    } 

    public function updateProfile(User $user)
    {
        if (Auth::user()->email == request('email')) {
            $this->validate(request(), [
                'name' => 'required',
                //  'email' => 'required|email|unique:users',
            ]);
            $user->name = request('name');
            // $user->email = request('email');
            $user->save();
            return back()->withSuccess('Username change successfully.');
        } else {
            $this->validate(request(), [
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users',
                //'password' => 'required|min:6|confirmed'
            ]);

            $user->name = request('name');
            $user->email = request('email');
            //$user->password = bcrypt(request('password'));

            $user->save();
            return back()->withSuccess('Email change successfully.');
        }
    }
}

