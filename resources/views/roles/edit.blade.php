@extends('layouts.app')

@section('title','Edit Role')

@section('content')
<div class="col-6">
    <h2>Edit Role</h2>
    @form([
            'route'=>route(request()->segment(1).'.update',['role'=> $role->id]),
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
                'input_name_value' =>"$role->name",
                'required'=>true,
                'validation'=> 'minlenght="2"'
            ])
            @endformInputWithValue
            <div class="form-group {{ $errors->has('permissions') ? 'has-error' : '' }}">
                <label for="permission">Permissions*
                    <span class="btn btn-info btn-sm select-all">Select all</span>
                    <span class="btn btn-info btn-sm deselect-all">Deselect all</span>
                </label>
                <select name="permission[]" id="permission" class="form-control select2" multiple="multiple" required>
                    @foreach($permissions as $id => $permissions)
                        <option value="{{ $id }}" {{ (in_array($id, old('permissions', [])) || isset($role) && $role->permissions()->pluck('name', 'id')->contains($id)) ? 'selected' : '' }}
                            >{{ $permissions }}</option>
                    @endforeach
                </select>
                @if($errors->has('permission'))
                    <em class="invalid-feedback">
                        {{ $errors->first('permission') }}
                    </em>
                @endif
                <p class="helper-block">
                </p>
            </div>
    @endform
</div>
@endsection

@section('footerAsset')
<script>
    $('.select-all').click(function () {
        let $select2 = $(this).parent().siblings('.select2')
        $select2.find('option').prop('selected', 'selected')
        $select2.trigger('change')
    })
    $('.deselect-all').click(function () {
        let $select2 = $(this).parent().siblings('.select2')
        $select2.find('option').prop('selected', '')
        $select2.trigger('change')
    })

    $('.select2').select2()
</script>
@endsection
