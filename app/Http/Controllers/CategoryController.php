<?php

namespace App\Http\Controllers;

use App\DataTables\CategoryDataTable;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoy;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Route;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('category.category');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        $category = collect(Category::get_category());
        // $category = collect(Category::where('parent_id','=',0)->with('children')->get());
        $category  = $category->toJson();
        return view('category.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoy $request)
    {
        $category = new Category();

        $category->title = $request->input('title');

        $category->parent_id = $request->input('parent_id');

        $category->save();

        return redirect()->back()->withStatus("Category Added Successfull");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category =Category::findOrFail($id);

        return view('category.edit',['category'=>$category]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCategoy $request, $id)
    {

        $category = Category::findOrFail($id);

        $category->title = $request->input('title');

        $category->parent_id = $request->input('parent_id');

        $category->save();

        return redirect()->route('category.index')->withStatus("Category updated Successfull");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, Request $request)
    {
       $category1 = Category::findOrFail($request->id)->delete();
       session()->flash('status', 'Category was delete!');
       return true;
    }
    public function getCategory()
    {
        // $category = collect(Category::get_category());
        $category = collect(Category::where('parent_id','=',null)->select('id','title AS text')->with('children:id,title AS text,parent_id')->get());
        // $category = collect(Category::select('categories.id','categories.title','categories.parent_id','cat.title AS Cat')->leftJoin('categories AS cat','cat.id','=','categories.parent_id')->get());

        return $category  = $category;
    }

    public function ajaxview(Request $request)
    {
        // if ($request->ajax()) {
            // $data = Category::query()
            // ->select('categories.id','categories.title','categories.parent_id','cat.title AS parent')
            // ->leftJoin('categories AS cat','cat.id','=','categories.parent_id');
            // return DataTables::of($data)
            //     ->addIndexColumn()
            //     ->addColumn('action', function($row){
            //         $btn = '<a href="' .route('category.edit',['category'=>$row->id]).'" class="btn btn-primary">Edit</a>';
            //         $btn = $btn.'<form action="' .route('category.destroy',['category'=>$row->id]).'" method="DELETE">
            //         <input type="hidden" name="_method" value="DELETE">
            //         <input type="submit" value="Delete">
            //         </form> ';
            //         return $btn;
            //     })
            //     ->rawColumns(['action'])
            //     ->make(true);
        // }
    }


}
