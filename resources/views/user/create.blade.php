@extends('layouts.app')

@section('title','Create Roles')

@section('content')
<div class="col-6">
    <h2>Add User</h2>
    <form action="{{ route('user.store') }}" class="isautovalid"  method="POST" id="form_add_user" enctype="multipart/form-data">
        @if($errors)
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        @endif
        @csrf
        <div class="form-group">
            <label for="avatar">Avatar</label>
            <input id="avatar" type="file" name="avatar" class="form-control-file" accept='image/*'>
            <span class="text-danger error-text  avatar_error"></span>
            <div class="img-holder"></div>
        </div>
        @error('avatar')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="name">Name<span>*</span></label>
            <input id="name" type="text" name="name" class="form-control required"  value="{{ old('name', optional($user ?? null)->name) }}" >
            <span class="text-danger error-text  name_error"></span>
        </div>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="username">Username<span>*</span></label>
            <input id="username" type="text" name="username" class="form-control required"  value="{{ old('username', optional($user ?? null)->username) }}" >
            <span class="text-danger error-text  username_error"></span>
        </div>
        @error('username')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="email">Email<span>*</span></label>
            <input id="email" type="text" name="email" class="form-control required"  value="{{ old('email', optional($user ?? null)->email) }}" >
            <span class="text-danger error-text  email_error"></span>
        </div>
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="company_name">Company Name<span>*</span></label>
            <input id="company_name" type="text" name="company_name" class="form-control required"  value="{{ old('company_name', optional($user ?? null)->company_name) }}" >
            <span class="text-danger error-text  company_name_error"></span>
        </div>
        @error('company_name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="mobile_number">Mobile Number<span>*</span></label>
            <input id="mobile_number" type="text" class="form-control required  @error('mobile_number') is-invalid @enderror" name="mobile_number" value="{{ old('mobile_number', optional($user ?? null)->mobile_number) }}"  autocomplete="mobile_number" autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" minlength="9" maxlength="10" >
            <span class="text-danger error-text  mobile_number_error"></span>
        </div>
        @error('mobile_number')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="password">Password<span>*</span></label>
            <input id="password" type="password" name="password" class="form-control required">
            <span class="text-danger error-text  password_error"></span>
        </div>
        @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="password">Confirm Password<span>*</span></label>
            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control required">
            <span class="text-danger error-text  password_confirmation_error"></span>
        </div>
        @error('password_confirmation')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="company_name">Company Name<span>*</span></label>
            <input id="company_name" type="text" name="company_name" class="form-control required"  value="{{ old('company_name', optional($user ?? null)->company_name) }}" >
            <span class="text-danger error-text  company_name_error"></span>
        </div>
        @error('company_name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group  {{ $errors->has('roles') ? 'has-error' : '' }}">
            <label for="roles" >Role*</label>
            <span class="btn btn-info btn-sm select-all">select all</span>
            <span class="btn btn-info btn-sm deselect-all">Deselect all</span>
                <select name="roles[]" id="roles" class="form-control select2" multiple="multiple" required>
                    @foreach($roles as $id => $roles)
                        <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || isset($user) && $user->roles()->pluck('name', 'id')->contains($id)) ? 'selected' : '' }}>{{ $roles }}</option>
                    @endforeach
                 </select>

                 @if($errors->has('roles'))
                 <em class="invalid-feedback">
                     {{ $errors->first('roles') }}
                 </em>
             @endif
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Create') }}
                </button>
            </div>
        </div>
    </form>
</div>


<script type="text/javascript">
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':"{{ csrf_token() }}"
        }

    });

    toastr.options.preventDuplicates = true;


   $(function(){

       //ADD user
       $('#form_register').on('submit', function(e){
           e.preventDefault();
           if($(this).valid()){
               var form = this;
               $.ajax({
                   method:$(form).attr('method'),
                   dataType:"json",
                   url:$(form).attr('action'),
                   data:new FormData(form),
                   processData:false,
                   dataType:'json',
                   contentType:false,
                   beforeSend:function(){
                           $(form).find('span.error-text').text('');
                   },
                   success: function(data)
                   {

                       if(data.code == 0){
                           $.each(data.error, function(prefix, val){
                               $(form).find('span.'+prefix+'_error').text(val[0]);
                           });
                       }else{
                           console.log(data);
                           $(form)[0].reset();
                           toastr.success(data.msg);
                           location.href ="{{ route('login') }}";
                       }
                   },
                   error: function(XMLHttpRequest, textStatus, errorThrown) {
                       alert(errorThrown);
                   }
               });

           }

       });

       }); ////end code

       $('#email').on('keyup', function(){
           $('.email_validation').html("");
       });

       ///Email validation

       function checkEmailExist(email){
           if(email != ''){
               $.ajax({
                   type:"POST",
                   url:"{{ route('register.checkEmailExist') }}",
                   data:{"email":email},
                   success: function(data){
                       if(data.code == 1){
                           $('.email_validation').html(data.msg);
                           $(':input[type="submit"]').prop('disabled',true);
                       }else{
                           $('.email_validation').html("");
                           $(':input[type="submit"]').prop("disabled",false);
                       }
                   },
                   error: function(errorThrow){
                       alert(errorThrow)
                   }
               });
           }
       }

       $('#username').on('keyup', function(){
           $('.username_validation').html("");
       });

       ///Username validation

       function checkUsernameExist(username){
           if(username != ''){
               $.ajax({
                   type:"POST",
                   url:"{{ route('register.checkUsernameExist') }}",
                   data:{"username":username},
                   success: function(data){
                       if(data.code == 1){
                           $('.username_validation').html(data.msg);
                           $(':input[type="submit"]').prop('disabled',true);
                       }else{
                           $('.username_validation').html("");
                           $(':input[type="submit"]').prop('disabled',false);
                       }
                   },
                   error: function(errorThrow){
                       alert(errorThrow)
                   }
               });
           }
       }


   </script>
   @endsection
   @section('footerAsset')
   <script>
       $('.select-all').click(function () {
           let $select2 = $('.select2')
           $select2.find('option').prop('selected', 'selected')
           $select2.trigger('change')
       })
       $('.deselect-all').click(function () {
           let $select2 = $('.select2')
           $select2.find('option').prop('selected', '')
           $select2.trigger('change')
       })
       $('.select2').select2()
   </script>
   @endsection
