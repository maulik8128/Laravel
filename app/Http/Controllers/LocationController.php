<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Region;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('location.location');
    }
    public function create(Request $request)
    {
        $data=[];
        if($request->input('name') === 'region' || $request->input('name') === 'city'){
            $data['country'] = Country::all();
        }

        if($request->input('name')){
            return view('location.add_'.$request->input('name'),compact('data'));
        }else{
            return response()->json(['code'=>2, 'msg'=>'Something went Wrong']);
        }

    }

    public function storeCountry(Request $request)
    {
       $validator = Validator::make($request->all(),[
            'country_name' => 'required|string|min:2|max:225',
       ]);
       if($validator->fails()){
            return response()->json(['code'=>0, 'error'=> $validator->errors()->toArray()]);
       }else{
            $country = new Country();
            $country->country_name = $request->input('country_name');
            $query = $country->save();
            if(!$query){
                return response()->json(['code'=>0, 'msg'=>'Something went Wrong']);
            }else{
                return response()->json(['code'=>1, 'msg'=>'New Country has been successfully saved']);
            }
       }
    }
    public function storeRegion(Request $request)
    {
       $validator = Validator::make($request->all(),[
            'region_name' => 'required|string|min:2|max:225',
            'country_id' => 'required|numeric',
       ]);
       if($validator->fails()){
            return response()->json(['code'=>0, 'error'=> $validator->errors()->toArray()]);
       }else{
            $region = new Region();
            $region->region_name = $request->input('region_name');
            $region->country_id = $request->input('country_id');
            $query = $region->save();
            if(!$query){
                return response()->json(['code'=>0, 'msg'=>'Something went Wrong']);
            }else{
                return response()->json(['code'=>1, 'msg'=>'New Region has been successfully saved']);
            }
       }
    }
    public function storeCity(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'city_name' => 'required|string|min:2|max:225',
            'country_id' => 'required|numeric',
            'region_id' => 'required|numeric',
       ]);
       if($validator->fails()){
            return response()->json(['code'=>0, 'error'=> $validator->errors()->toArray()]);
       }else{
            $city = new City();
            $city->city_name = $request->input('city_name');
            $city->region_id = $request->input('region_id');
            $query = $city->save();
            if(!$query){
                return response()->json(['code'=>0, 'msg'=>'Something went Wrong']);
            }else{
                return response()->json(['code'=>1, 'msg'=>'New City has been successfully saved']);
            }
       }
    }

    public function getRegion(Request $request)
    {
        $id=$request->input('id');
        return $data = Country::find($id)->region()->get();
    }
}
