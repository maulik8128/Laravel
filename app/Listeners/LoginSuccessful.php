<?php

namespace App\Listeners;

use App\Mail\UserLogin;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewUserNotification;

class LoginSuccessful
{
    /**
     * Create the event listener.
     * php artisan make:listener LoginSuccessful --event=Illuminate\Auth\Events\Login
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        Session::flash('login-success', 'Hello ' . $event->user->username . ', welcome back!');
        $admin = User::where('id','=','1')->get();
        $user = User::where('id','=',$event->user->id)->first();
        // dd($user);
        // send notification to Admin
        Notification::send($admin,new NewUserNotification($user));
        // Mail::to($event->user->email)->send(new UserLogin($event->user));

    }
}
