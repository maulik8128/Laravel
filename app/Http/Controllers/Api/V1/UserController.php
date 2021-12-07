<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255',
            'username'=>'required|max:255|unique:users',
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed',
            'mobile_number' => 'required|numeric|digits:10',
        ]);
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'mobile_number'=> $request->mobile_number,
        ]);

      $token= $user->createToken('authToken')->accessToken;
      return response(['user'=>$user, 'token'=>$token],200);

    }

        /**
     * This method returns authenticated user details
     */
    public function authenticatedUserDetails(){
        //returns details
        return response()->json(['authenticated-user' => auth()->user()], 200);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'login'    => 'required',
            'password' => 'required|confirmed'
        ]);

        if($validator->fails())
        {
            return response()->json(['status_code'=>400, 'message' => 'The given data was invalid.', 'errors' => $validator->errors()],400);
        }

        $login_type = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL )
                    ? 'email'
                    : 'username';

        $request->merge([
            $login_type => $request->input('login')
        ]);

        $credentials =request([$login_type,'password']);

        if(!Auth::attempt($credentials))
        {
            return response()->json(['status_code' => 500, 'message' => 'Unauthorized'],500);
        }

        $user = User::where($login_type, $request->$login_type)->first();
        $tokenResult = $user->createToken('authToken')->accessToken;

        $user->save();

        return response()->json([
            'status_code' => 200,
            'token' => $tokenResult
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);

        // $user = User::where('email',$request->email)->first();
        // $bt =$request->bearerToken();

        // if(!$bt) return response()->json([
        //     'status_code' => 400,
        //     'message' => 'We could not locate the proper info in order to logout this User'
        // ]);

        // $split_string = explode("|", $bt);
        // $token_id = (int)$split_string[0];

        // $personal_token_object = DB::table('personal_access_tokens')->where('id',$token_id)->first();

        // if($user && $bt && $personal_token_object){

        //     if(($personal_token_object->tokenable_id == $user->id) && ($personal_token_object->id == $token_id))
        //     {

        //         // $user->tokens()->delete();
        //         // $personal_token_object = DB::table('personal_access_tokens')->where("tokenable_id",'=',$user->id)->delete();  //// remove all token in user
        //         $personal_token_object = $user->tokens()->where('id', $token_id)->delete();
        //         // $personal_token_object = DB::table('personal_access_tokens')->delete($token_id);
        //     }
        // }else{
        //     return response()->json([
        //         'status_code' => 400,
        //         'message' => 'We could not locate the proper info in order to logout this User'
        //     ]);
        // }

        // if($personal_token_object){
        //     return response()->json([
        //         'status_code' => 200,
        //         'message' => 'logged out successfully'
        //     ]);
        // }else{
        //     return response()->json([
        //         'status_code' => 400,
        //         'message' =>'We could not locate the proper info in order to logout this User'
        //     ]);
        // }

    }

}
