<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\UserVerify;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function registration()
    {
        return view('auth.registration'); //return to view/auth/registration.blade.php
    }

   /* public function postRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required|min:6'
        ]);

        $data = $request->all(); //associative array data  pass to function create below
        $user = $this->create($data);

        return redirect("/login")->withSuccess('You have successfully registered!');
    } */
    public function postRegistration(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required|min:6',
        ]);

        $data = $request->all(); //associative array data  pass to function create below
        $user = $this->create($data); //push data to create function

        //generate randomize string token
        $token = Str::random(64); //64 bit

        //create record for user_verifies table
        UserVerify::create([
            'user_id' => $user->id,
            'token' => $token,
        ]);

        
        Mail::send('email.emailVerificationEmail', ['token' => $token], function($message) use($request){
            $message->to($request->email); //this is where to get. which is send from .env  MAIL_FROM_ADDRESS
            $message->subject("Email Verification Mail"); 
        });

        return redirect("/login")->withSuccess('You have successfully registered, please verify your email!');
    }

    //create row or record in side table =$user->save();     (above)
    private function create(array $data)
    {
        //return row
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']) //make encryption
      ]);
    }


    public function index()
    {
        return view('auth.login');
    }


    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $remember = $request->has('remember') ? true : false; //session_start -> create session 
        // config/session.php set 'expire_on_close' => true, to enable session or value false to disable session
        $credentials = $request->only('email', 'password'); //return associative array catch value  when user submit
        //Auth::attempt mean user try to login to system
        if (Auth::attempt($credentials, $remember)) { //Auth is a class used to validate info tha user input with info in the database
           // return redirect()->intended('dashboard')->withSuccess('You have Successfully loggedin'); //WithSuccess == Session::flash
           return redirect('/dahsboard');
        }
        return redirect("login")->withErrors('You have entered invalid credentials!'); //else
        //return redirect()->Back()->withErrors('You have entered invalid credentials!');
    }

    public function dashboard()
    {
        if(Auth::check()){ //check user has login or not
            $user = Auth::user(); //if true user go to auth/dashboard.blade.php
            return view('auth.dashboard')->with('user',$user);
           
        }
        return redirect("login")->withErrors('You do not have access!'); //false go to login again
    }



    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect('login')->withSuccess('You have successfully loged out!');
    }

    public function verifyAccount($token){
        //compare string token (from database) with url token
        $verifyUser = UserVerify::where('token', $token)->first(); 
        $message = "Sorry, your email cannot be identified!"; 

        if(!is_null($verifyUser)){
            $user = $verifyUser->user; 

            if(!$user->is_email_verified){
                $verifyUser->user->is_email_verified = 1; 
                $verifyUser->user->save(); 
                $message = "Your e-mail is verified. You can now login."; 
            }else{
                $message = "Your e-mail is already verified. You can now login."; 
            }
            return redirect()->route("login")->withSuccess($message); 
        }

        return redirect()->route("login")->withErrors($message); 
    }



}
