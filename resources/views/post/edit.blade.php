@extends('layouts.app')
@section('title', 'Edit Post')
@section('content')

<div class="row">
    <div class="col-4">
        @if (session('status'))
               <div class="alert alert-success" role="alert">
                    {{ session('status') }}
               </div>
        @endif
        <form action="{{ route('posts.update',['post'=>$post->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group" >
                <label for="post">Post</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', optional($post ?? null)->title) }}">
                @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group" >
                <label for="content">Content</label>
                <input type="text" name="content" id="content" class="form-control" value="{{ old('content', optional($post ?? null)->content) }}">
                @error('content')
                        <div class="alert alert-danger">{{ $message }}</div>
                @enderror

            </div>
            <div class="form-group" >
                <input type="submit" name="submit" id="submit" class="form-control btn btn-primary">
            </div>
        </form>
    </div>
</div>

@endsection
