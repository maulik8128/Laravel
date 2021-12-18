<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Activitylog\Models\Activity;

class UserController extends Controller
{



    public function __construct()
    {
        $this->middleware('role:Admin|user', ['only' => ['index']]);
        $this->middleware('role:Admin', ['only' => ['create','store']]);
        $this->middleware('role:Admin', ['only' => ['edit','update']]);
        $this->middleware('role:Admin', ['only' => ['destroy']]);

    }
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

                        $btn = '<a href="' .route('user.edit',['user'=>$row->id]).'" data-edit="'.$row->id.'" class="edit-user" title="Click here for edit content" ><i class="fas fa-edit" aria-hidden="true"></i></a>';
                        $btn.= '<a href="' .route('user.destroy',['user'=>$row->id]).'" data-delete="'.$row->id.'" class="delete-user" title="Click here for delete content" >&nbsp;<i class="fas fa-trash-alt" aria-hidden="true"></i></a>';
                         return $btn;
                    })
                    ->editColumn('id', function($row){

                        return '<input type="checkbox" class="bulk_action" name="multi_check_users[]" value="'.$row->id.'">';
                    })

                    ->addColumn('role',function($row){
                        $btn='';
                        foreach($row->roles()->pluck('name') as $role){
                            $btn.='<span class="badge badge-info" style="margin:0px 2px">'. $role .'</span>';
                        }
                        return $btn;
                    })
                    ->editColumn('status', function($row){

                        return '<a onclick="disable_record('.$row->id.','.$row->status.')"  title="click for '.($row->status?'inactive':'active').'"><i class="fa fa-2x fa-toggle-'.($row->status?'on':'off').'"></i> </a>';
                    })
                    ->rawColumns(['action','id','status','role'])
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
        $roles = Role::get()->pluck('name', 'name');

        return view('user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'name' => ['required','string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'mobile_number' => ['numeric','digits:10'],
            'avatar'=>  ['nullable','image', 'mimes:jpg,jpeg,png','max:6000'], ///kb
        ]);
        $user = User::create($request->all());
        $roles = $request->input('roles') ? $request->input('roles') : [];
        $user->assignRole($roles);

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //hierarchy-records-
        $users = User::select('id')->with('children:id,parent_id')->where('id',$id)->get();
        function recursive_foreach($users) {
            global $userdata;
            foreach($users as $key=>$value){
                $userdata[]= $value->id;
                if($value->children){
                    recursive_foreach($value->children);
                }
            }
            return $userdata;
        }
        $data =recursive_foreach($users);
        // asort($data);
        // foreach($data as $d){
            // echo $d. "<br>";
        // }



        // $user = User::select('users.id','u.id AS children_id')->leftJoin('users AS u', 'users.id' ,'=', 'u.parent_id')
        // ->where('users.id',$id)->get();
        // dd($user);

        // return auth()->user()->can(['user-delete']);

        //  return Activity::all();
        // return now();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $roles = Role::get()->pluck('name', 'name');
        $user = User::where('id',$id)->first();

        return view('user.edit', compact('user', 'roles'));
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

        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'name' => ['required','string', 'max:255'],
            'mobile_number' => ['nullable','numeric','digits:10'],
            'avatar'=>  ['nullable','image', 'mimes:jpg,jpeg,png','max:6000'], ///kb
        ]);

        $user =User::where('id',$id)->first();
        $user->update($request->all());
        $roles = $request->input('roles') ? $request->input('roles') : [];
        $user->syncRoles($roles);
        return redirect()->route('user.index');

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
        $user = User::findOrFail($request->id);
        $user->delete();

        return true;
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
