<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Chart\Title;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Post $post)
    {
        if($request->ajax()){
            $data =  Post::query();
            $data->select('posts.id','posts.title','posts.content','users.username');
            // $data->addSelect(['user' => User::select('username')->whereColumn('user_id','users.id')->latest()->take(1) ]);
            $data->leftJoin('users','posts.user_id','=','users.id');
            $data->withCount('comments');
            return datatables()->of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) use($post){

                        $btn ='<a href="'.route('posts.show',['post' => $row->id]).'" class="show"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                        $btn .='<button onclick=location.href="'.route('posts.edit',['post' => $row->id]).'" class="btn btn-sm margin-bottom "><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                        $btn .='<button onclick="delete('.$row->id.')" class="btn btn-sm margin-bottom "><i class="fa fa-times" ></i></button>';
                        return $btn;
                    })
                    ->editColumn('id', function($row){

                        return '<input type="checkbox" class="bulk_action" name="multi_check_users[]" value="'.$row->id.'">';
                    })
                    ->rawColumns(['action','id'])
                    ->make(true);
        }
        return view('post.posts');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        $validated = $request->validated();
        $validated['user_id']= $request->user()->id;

        $post = Post::create($validated);

        return redirect()->route('posts.show',['post'=>$post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Log::info('Showing the user profile for user: '.$id);
        $post = Post::select('id','title','content')->with('comments:id,content,post_id')->findOrFail($id);
        return view('post.show',['post'=>$post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->authorize($post);
        return view('post.edit',['post'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request,$id)
    {
        $post = Post::findOrFail($id);
        $this->authorize($post);
        $validated = $request->validated();
        $post->fill($validated);
        $post->save();
        return redirect()->route('posts.show',['post'=>$post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize($post);
        //
    }
}
