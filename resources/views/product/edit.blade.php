{{-- @extends('layouts.app') --}}

{{-- @section('title','Edit Product') --}}

{{-- @section('content') --}}

    <h2>Edit Product</h2>
    <form action="{{ route('product.update',['product'=>$product->id]) }}" class="isautovalid"  method="POST" id="form_add_product" enctype="multipart/form-data">

        @csrf
        @method('PUT')
        @include('product.form')

        <div><input type="submit" value="Update" id="update" class="btn btn-primary"></div>

    </form>

{{-- @endsection --}}
