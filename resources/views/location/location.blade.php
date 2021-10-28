@extends('layouts.app')
@section('assets')
<link rel="stylesheet" href="{{ asset('assets/datatable-1.11.3/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/datatable-1.11.3/css/responsive.dataTables.min.css') }}">
{{-- <script src="/vendor/datatables/buttons.server-side.js"></script> --}}

@endsection
@section('title', 'Location')
@section('content')

<div class="row">
    <div class="col-4" >
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                    {{ session('status') }}
            </div>
        @endif
        <div class="col-12">
            <a href="{{ route('location.create') }}" class="btn btn-primary add" data-name="country" >Add Country</a>
            <a href="{{ route('location.create') }}" class="btn btn-primary add" data-name="region" >Add Region</a>
            <a href="{{ route('location.create') }}" class="btn btn-primary add" data-name="city" >Add City</a>
        </div>
        <div id="form_view">

            <h2>Add Country</h2>
            @form([
                'route'=>route('location.store.country'),
                'formId' =>'add',
                'submit_name' =>'Create',
                'submit_btn_id'=>'submit',
                // 'class' => '',
            ])
            @formInput([
                'lable'=>'Country',
                'input_name'=>'country_name',
                'item' =>'contry',
                'required'=>true,
            ])
            @endformInput
            @endform

        </div>
    </div>

    <div class="col-8">
        <div class="page">
            <div class="container-fluid">
                    {{--  {!! $dataTable->table() !!}  --}}

            </div>
         </div>
     </div>

</div>
{{--  {!! $dataTable->scripts() !!}  --}}
{{-- <script src="{{ asset('assets/bootstrap/js/bootstrap.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/datatable/js/dataTables.dataTables.min.js') }}"></script> --}}

<script type="text/javascript">
 toastr.options.preventDuplicates = true;

 $.ajaxSetup({
     headers:{
         'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr("content")
     }

 });

    $(function(){
            AddEdit();
            function AddEdit(){
                //ADD product
                $('#add').on('submit', function(e){
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
                                    $(form)[0].reset();

                                    toastr.success(data.msg);
                                }
                            },
                            error: function(XMLHttpRequest, textStatus, errorThrown) {
                                alert(errorThrown);
                            }
                        });

                    }

                });
            };

        $(".add").on('click',function(e){
            e.preventDefault();
            var url = e.target;
            var name= $(this).data('name');
            var token = $("meta[name='csrf-token']").attr("content");
            $.ajax({
                type:'POST',
                url:url,
                data:{"_token":token,"name":name},
                beforeSend:function(){

                },
                success: function(data)
                {

                    $("#form_view").empty().append(data);
                    AddEdit();
                    pullOut();
                    if(data.code == 2){
                        alert(data.msg)
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });

        });
        pullOut();
        function pullOut(){
            $('.getRegion').on('change',function(e){
                var id = $(this).val();
                var token = $("meta[name='csrf-token']").attr("content");
                $.ajax({
                    type:'POST',
                    url:"{{ route('location.getRegion') }}",
                    data:{"_token":token,"id":id},
                    beforeSend:function(){

                    },
                    success: function(data)
                    {
                        $('#add #region_id').html('');
                        var opt = $('<option />');
                        opt.val('');
                        opt.text('Please Select');
                        $('#add #region_id').append(opt);

                        $.each(data,function(key,value)
                        {
                            var opt = $('<option />');
                            opt.val(value.id);
                            opt.text(value.region_name);
                            $('#add #region_id').append(opt);
                        });
                        console.log(opt)
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                });
            });
        }





    });
</script>

@endsection
