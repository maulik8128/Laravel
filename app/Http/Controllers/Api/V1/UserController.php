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
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

      $token= $user->createToken('authToken')->plainTextToken;
      return response(['user'=>$user, 'token'=>$token],200);

    }

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ]);

        if($validator->fails())
        {
            return response()->json(['status_code'=>400, 'message' => 'The given data was invalid.', 'errors' => $validator->errors()],400);
        }

        $credentials =request(['email','password']);

        if(!Auth::attempt($credentials))
        {
            return response()->json(['status_code' => 500, 'message' => 'Unauthorized'],500);
        }

        $user = User::where('email', $request->email)->first();
        $tokenResult = $user->createToken('authToken')->plainTextToken;

        $user->save();

        return response()->json([
            'status_code' => 200,
            'token' => $tokenResult
        ]);
    }

    public function logout(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        $bt =$request->bearerToken();

        if(!$bt) return response()->json([
            'status_code' => 400,
            'message' => 'We could not locate the proper info in order to logout this User'
        ]);

        $split_string = explode("|", $bt);
        $token_id = (int)$split_string[0];

        $personal_token_object = DB::table('personal_access_tokens')->where('id',$token_id)->first();

        if($user && $bt && $personal_token_object){

            if(($personal_token_object->tokenable_id == $user->id) && ($personal_token_object->id == $token_id))
            {

                // $user->tokens()->delete();
                // $personal_token_object = DB::table('personal_access_tokens')->where("tokenable_id",'=',$user->id)->delete();  //// remove all token in user
                $personal_token_object = $user->tokens()->where('id', $token_id)->delete();
                // $personal_token_object = DB::table('personal_access_tokens')->delete($token_id);
            }
        }else{
            return response()->json([
                'status_code' => 400,
                'message' => 'We could not locate the proper info in order to logout this User'
            ]);
        }

        if($personal_token_object){
            return response()->json([
                'status_code' => 200,
                'message' => 'logged out successfully'
            ]);
        }else{
            return response()->json([
                'status_code' => 400,
                'message' =>'We could not locate the proper info in order to logout this User'
            ]);
        }

    }

}
