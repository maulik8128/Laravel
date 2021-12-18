<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;

class PermissionsController extends Controller
{
    // function __construct()
    // {
    //      $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
    //      $this->middleware('permission:product-create', ['only' => ['create','store']]);
    //      $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
    //      $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    // }
	// public $controller_name = "permissions";
    public $viewfile = "permissions";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Permission::query();
            return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action',function($row){

                $btn = '<a href="' .route('permissions.edit',['permission'=>$row->id]).'" data-edit="'.$row->id.'" class="edit-permissions" title="Click here for edit content" ><i class="fas fa-edit" aria-hidden="true"></i></a>';
                $btn.= '<a href="' .route('permissions.destroy',['permission'=>$row->id]).'" data-delete="'.$row->id.'" class="delete-permissions" title="Click here for delete content" >&nbsp;<i class="fas fa-trash-alt" aria-hidden="true"></i></a>';
                 return $btn;
            })
            ->editColumn('id', function($row){
                $idColumn = '<input type="checkbox" class="bulk_action" name="multi_check[]" value= "'.$row->id.'">';
                return $idColumn;
            })
            ->rawColumns(['action','id'])
            ->make(true);

        }
        return view($this->viewfile.'.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermissionRequest $request)
    {
        Permission::create($request->all());
        return redirect()->route('permissions.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permissions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permissions,$id)
    {
        try {
            $permissions=Permission::findOrFail($id);
            return view('permissions.edit',compact('permissions'));
        } catch (\Throwable $th) {
            return redirect()->back();
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermissionRequest $request,$id)
    {
        $permissions=Permission::findOrFail($id);

        $permissions->update($request->all());

        return redirect()->route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        abort_unless($request->ajax(),404);

        $permission = Permission::findOrFail($request->id);
        $permission->delete();

        return true;
    }
}
