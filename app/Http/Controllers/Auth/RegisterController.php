<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Listeners\SendNewUserNotification;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Notifications\NewUserNotification;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Monolog\Handler\SendGridHandler;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    public function register(Request $request)
    {
        abort_unless($request->ajax(),404);
        $validator =Validator::make($request->all(),[
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'name' => ['required','string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'mobile_number' => ['required','numeric','digits:10'],
            'avatar'=>  ['nullable','image', 'mimes:jpg,jpeg,png','max:6000'], ///kb
        ]);

        if($validator->fails()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{

            $user = new User();
            $user->email= $request->input('email');
            $user->name= $request->input('name');
            $user->username= $request->input('username');
            $user->company_name= $request->input('company_name');
            $user->mobile_number= $request->input('mobile_number');
            $user->password= Hash::make($request->input('password'));
            if($request->hasFile('avatar')){
                $path = $request->file('avatar')->store('avatar');
                $user->avatar= $path;
            }
            $query = $user->save();
            event(new Registered($user));
            if(!$query){
                return response()->json(['code'=>0,'msg'=>'Something went Wrong']);
            }else{
                $admin = User::where('id','=','1')->get();
                $user = User::findOrFail($user->id);
                // send notification to Admin
                Notification::send($admin,new NewUserNotification($user));
                return response()->json(['code'=>1,'msg'=>'New User has been successfully saved']);
            }
        }

    }

    public function checkEmailExist(Request $request)
    {
        abort_unless($request->ajax(),404);
        $user = User::whereEmail($request->email)->first();
        if($user === null){
            return response()->json(['code'=>0]);
        }else{
            return response()->json(['code'=>1, 'msg'=>'The Email has already been taken.']);
        }
    }
    public function checkUsernameExist(Request $request)
    {
        abort_unless($request->ajax(),404);
        $user = User::whereUsername($request->username)->first();
        if($user === null){
            return response()->json(['code'=>0]);
        }else{
            return response()->json(['code'=>1, 'msg'=>'The Username has already been taken.']);
        }
    }
}
