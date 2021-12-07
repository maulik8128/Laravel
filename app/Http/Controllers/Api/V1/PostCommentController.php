<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Resources\Post as PostResource;
use App\Http\Resources\PostCollection;
use App\Http\Requests\StorePost;

class PostCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PostCollection::collection([
         Post::with('comments')->paginate(5)
        ]);
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

        return response()->json(['message'=> 'Post added successfully', 'post'=>$post]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request ,$id)
    {
        return PostResource::collection([
            Post::with('comments')->findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $id)
    {
        $post = Post::findOrFail($id);

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
        $validated = $request->validated();
        $post->fill($validated);
        $post->save();
        return response()->json(['message'=> 'Post updated successfully', 'post'=>$post]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $post = Post::findOrFail($id)->delete();
        return response()->json(['message'=> 'Post Deleted successfully'],200);
    }
}
