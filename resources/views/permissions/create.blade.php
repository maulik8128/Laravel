@extends('layouts.app')

@section('title','Create Permissions')

@section('content')
<div class="col-6">
    <h2>Add Permissions</h2>
    @form([
            'route'=>route(request()->segment(1).'.store'),
            'formId' =>'add',
            'submit_name' =>'Create',
            'submit_btn_id'=>'submit',
            'class' => 'isautovalid',
        ])
            @formInput([
                'lable'=>'Title',
                'input_name'=>'name',
                'item' =>'permissions',
                'required'=>true,
                'validation'=> 'minlenght="2"'
            ])
            @endformInput
    @endform
</div>
@endsection




