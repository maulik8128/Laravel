<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback(Request $request)
    {

       try {
        $state = $request->get('state');
        $request->session()->put('state',$state);

        if(\Auth::check()==false){
        session()->regenerate();
        }
        $user = Socialite::driver('google')->user();
        $userExisted = User::where('google_id',$user->id)->first();
        if($userExisted){
            Auth::login($userExisted);
            return redirect()->route('home');
        }else{

            $newUser = new User();
            $newUser->name=$user->name;
            $newUser->email=$user->email;
            $newUser->google_id=$user->id;
            $newUser->email_verified_at= now();
            $newUser->password=Hash::make($user->id);
            $newUser->save();

            Auth::login($newUser);
            return redirect()->route('home');
        }

       } catch (\Exception $e) {
           echo 'Message: ' .$e->getMessage();
       }

    }
}
