@extends('layouts.app')

@section('title', 'Posts Show')
@section('content')

<div class="row">
    <div class="col-6">
        @if (session('status'))
               <div class="alert alert-success" role="alert">
                    {{ session('status') }}
               </div>
        @endif
        <div class="col-3">
        </div>
        <div class="page">
            @if($post)
            <div class="container-fluid">
                <h3>{{ $post->title }}</h3>

                <p>{{ $post->content }}</p>

            </div>
            <div class="col-6">
                <form action="{{ route('posts.comment.store',['post'=>$post->id]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="content">Comments</label>
                        <input type="text" class="form-control" name="content">
                    </div>
                    @error('content')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div><input type="submit" value="Add Comment" class="btn btn-primary"></div>
                </form>

            </div>
            @foreach ($post->comments as $comment )

            <div class="col-6">
                <p>{{ $comment->content }}</p>
            </div>

            @endforeach
            @endif
        </div>
        </div>

    </div>
</div>


@endsection
