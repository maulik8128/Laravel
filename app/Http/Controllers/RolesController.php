<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreRolesRequest;
use App\Http\Requests\UpdateRolesRequest;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{

    // function __construct()
    // {
    //      $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
    //      $this->middleware('permission:role-create', ['only' => ['create','store']]);
    //      $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
    //      $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Role::query();
            // $data->with('permissions');
            return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action',function($row){

                $btn = '<a href="' .route('roles.edit',['role'=>$row->id]).'" data-edit="'.$row->id.'" class="edit-roles" title="Click here for edit content" ><i class="fas fa-edit" aria-hidden="true"></i></a>';
                $btn.= '<a href="' .route('roles.destroy',['role'=>$row->id]).'" data-delete="'.$row->id.'" class="delete-roles" title="Click here for delete content" >&nbsp;<i class="fas fa-trash-alt" aria-hidden="true"></i></a>';
                 return $btn;
            })
            ->editColumn('id', function($row){
                $idColumn = '<input type="checkbox" class="bulk_action" name="multi_check[]" value= "'.$row->id.'">';
                return $idColumn;
            })
            ->addColumn('permission',function($row){
                $btn='';
                // @foreach($role->permissions()->pluck('name') as $permission)
                // <span class="badge badge-info">{{ $permission }}</span>
                // @endforeach
                foreach($row->permissions as $permission){
                    $btn.='<span class="badge badge-info" style="margin:0px 2px">'. $permission->name .'</span>';
                }
                return $btn;
            })
            ->rawColumns(['action','id','permission'])
            ->make(true);

        }
        return view('roles.roles');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::get()->pluck('name', 'name');

        return view('roles.create',compact('permissions'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRolesRequest $request)
    {
        try {
            $role = Role::create($request->except('permission'));
            $permissions = $request->input('permission') ? $request->input('permission') : [];
            $role->syncPermissions($permissions);
            // $role->givePermissionTo($permissions);
            return redirect()->route('roles.index');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors('Name all ready taken');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $role=Role::findOrFail($id);
            $permissions = Permission::get()->pluck('name', 'name');
            return view('roles.edit',compact('role','permissions'));
        } catch (\Throwable $th) {
            return redirect()->back();
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRolesRequest $request, $id)
    {
        $role=Role::findOrFail($id);

        $role->update($request->except('permission'));
        $permissions = $request->input('permission') ? $request->input('permission') : [];
        $role->syncPermissions($permissions);
        return redirect()->route('roles.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        abort_unless($request->ajax(),404);

        $role = Role::findOrFail($request->id);
        $role->delete();
        return true;
    }
}
