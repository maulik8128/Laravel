@extends('layouts.app')

@section('title','Edit Permissions')

@section('content')
<div class="col-6">
    <h2>Edit Permissions</h2>
    @form([
            'route'=>route(request()->segment(1).'.update',['permission'=> $permissions->id]),
            'formId' =>'add',
            'submit_name' =>'Update',
            'submit_btn_id'=>'submit',
            'class' => 'isautovalid',
        ])
                @csrf
                @method('PUT')
            @formInputWithValue([
                'lable'=>'Title',
                'input_name'=>'name',
                'input_name_value' =>"$permissions->name",
                'required'=>true,
                'validation'=> 'minlenght="2"'
            ])
            @endformInputWithValue

    @endform
</div>
@endsection

