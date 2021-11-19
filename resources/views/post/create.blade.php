@extends('layouts.app')

@section('title', 'Add Post')
@section('content')

<div class="row">
    <div class="col-4">
        @if (session('status'))
               <div class="alert alert-success" role="alert">
                    {{ session('status') }}
               </div>
        @endif
        <form action="{{ route('posts.store') }}" class="isautovalid"  method="POST">
            @csrf
            <div class="form-group" >
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', optional($post ?? null)->name) }}" required>
                @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group" >
                <label for="content">Content</label>
                <input type="text" name="content" id="content" class="form-control" value="{{ old('content', optional($post ?? null)->name) }}">
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

