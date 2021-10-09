@extends('layouts.app')
@section('assets')
<link rel="stylesheet" href="{{ asset('assets/plugins/jquery-easyui/easyui.css') }}">
@endsection
@section('title', 'Add Category')
@section('content')

<div class="row">
    <div class="col-4">
        @if (session('status'))
               <div class="alert alert-success" role="alert">
                    {{ session('status') }}
               </div>
        @endif
        <form action="{{ route('category.store') }}" class="isautovalid" id="add_category" method="POST">
            @csrf
            <div class="form-group" >
                <label for="category">Category</label>
                <input type="text" name="title" id="title" class="form-control required" value="{{ old('title', optional($category ?? null)->name) }}" >
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
                {{-- <input type="submit" name="submit" id="submit" class="form-control btn btn-primary"> --}}
                <button type="submit" name="submit_page" id="submit_page" value="Submit" class="btn btn-primary label-info">Submit</button>
            </div>
        </form>
    </div>
</div>
<script src="{{ asset('assets/plugins/jquery-easyui/jquery.easyui.min.js') }}"></script>
<script>

</script>
@endsection

