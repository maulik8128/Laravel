@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register.create') }}" class="isautovalid1"  id="form_register">

                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Avatar') }}</label>

                            <div class="col-md-6">
                                <input id="avatar" type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar" value="{{ old('avatar') }}" autofocus accept='image/*'>

                                @error('avatar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <span class="text-danger error-text  avatar_error"></span>
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control required  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" onblur="checkEmailExist(this.value)" />

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <span class="text-danger error-text  email_error"></span>
                                <span class="text-danger error-text  email_validation"></span>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control required  @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus >

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <span class="text-danger error-text  username_error"></span>
                                <span class="text-danger error-text  username_validation"></span>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control required  @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" autocomplete="username" autofocus  onblur="checkUsernameExist(this.value)">

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <span class="text-danger error-text  username_error"></span>
                                <span class="text-danger error-text  username_validation"></span>
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Company Name') }}</label>

                            <div class="col-md-6">
                                <input id="company_name" type="text" class="form-control @error('company_name') is-invalid @enderror" name="company_name" value="{{ old('company_name') }}" autocomplete="company_name" autofocus>

                                @error('company_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Mobile Number') }}</label>

                            <div class="col-md-6">
                                <input id="mobile_number" type="text" class="form-control required  @error('mobile_number') is-invalid @enderror" name="mobile_number" value="{{ old('mobile_number') }}"  autocomplete="mobile_number" autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" minlength="9" maxlength="10">

                                @error('mobile_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <span class="text-danger error-text  mobile_number_error"></span>
                            </div>

                        </div>


                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control required  @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <span class="text-danger error-text  password_error"></span>
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control required" name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
