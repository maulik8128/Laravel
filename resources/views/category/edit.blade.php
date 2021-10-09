@extends('layouts.app')
@section('assets')
<link rel="stylesheet" href="{{ asset('assets/plugins/jquery-easyui/easyui.css') }}">
@endsection
@section('title', 'Edit Category')
@section('content')

<div class="row">
    <div class="col-4">
        @if (session('status'))
               <div class="alert alert-success" role="alert">
                    {{ session('status') }}
               </div>
        @endif
        <form action="{{ route('category.update',['category'=>$category->id]) }}"  class="isautovalid" id="edit_category" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group" >
                <label for="category">Category</label>
                <input type="text" name="title" id="title" class="form-control required" value="{{ old('title', optional($category ?? null)->title) }}">
                @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group" >
                <label for="parent_id">Parent Category</label>
                {{-- <input name="parent_id" id="parent_id" class="form-control" value="{{ old('parent_id', optional($category ?? null)->parent_id) }}"> --}}
                <input name="parent_id" id="parent_id" class="easyui-combotree"
                 data-options="url:'{{ route('Category.getCategory') }}',method:'get', multiple:false,cascadeCheck:false"
                  style="width:100%" value="{{ old('parent_id', optional($category ?? null)->parent_id) }}">

            </div>
            <div class="form-group" >
                <button type="submit" name="submit_page" id="submit_page" value="Submit" class="btn btn-primary label-info">Submit</button>
            </div>
        </form>
    </div>
</div>
<script src="{{ asset('assets/plugins/jquery-easyui/jquery.easyui.min.js') }}"></script>
<script>

</script>
@endsection

