<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Activity::query();
            // dd($data);
            return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action',function($row){

                $btn= '<a href="' .route('activityLogs.destroy',['activityLog'=>$row['id']]).'" data-delete="'.$row['id'].'" class="delete-activityLogs" title="Click here for delete content" >&nbsp;<i class="fas fa-trash-alt" aria-hidden="true"></i></a>';
                 return $btn;
            })
            ->editColumn('id', function($row){
                $idColumn = '<input type="checkbox" class="bulk_action" name="multi_check[]" value= "'.$row['id'].'">';
                return $idColumn;
            })
            ->editColumn('properties',function($row){
                $btn='';
                $btn.='<span class="badge badge-info" style="margin:0px 2px">'. $row['properties'].'</span>';

                return $btn;
            })
            ->editColumn('created_at',function($row){
                $btn=date("Y-m-d h:i:sa",strtotime($row['created_at']));
                    return $btn;
            })
            ->rawColumns(['action','id','properties','created_at'])
            ->make(true);

        }
        return view('activityLogs.activityLogs');
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
    public function destroy(Request $request)
    {
        abort_unless($request->ajax(),404);
        $Activity = Activity::findOrFail($request->id);
        $Activity->delete();

        return true;
    }


}
