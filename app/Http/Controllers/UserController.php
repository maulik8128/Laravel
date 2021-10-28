<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data =  User::query();
            return datatables()->of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                        $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

                            return $btn;
                    })
                    ->editColumn('id', function($row){

                        return '<input type="checkbox" class="bulk_action" name="multi_check_users[]" value="'.$row->id.'">';
                    })
                    ->editColumn('status', function($row){

                        return '<a onclick="disable_record('.$row->id.','.$row->status.')"  title="click for '.($row->status?'inactive':'active').'"><i class="fa fa-2x fa-toggle-'.($row->status?'on':'off').'"></i> </a>';
                    })
                    ->rawColumns(['action','id','status'])
                    ->make(true);
        }
        return view('user.user');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function ajaxDisableAll(Request $request)
    {
        abort_unless($request->ajax(),404);
        $user = User::findOrFail($request->id);
        $status = ($request->status != 1 )?1:0;
        $user->status = $status;
        $user->save();
    }
}
