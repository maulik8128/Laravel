@extends('layouts.app')
@section('assets')
<link rel="stylesheet" href="{{ asset('assets/datatable-1.11.3/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/datatable-1.11.3/css/responsive.dataTables.min.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('assets/datatable-1.11.3/css/buttons.dataTables.min.css') }}"> --}}



@endsection
@section('title', 'Product')
@section('content')

<div class="row">
    <div class="col-sm-4" >
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                    {{ session('status') }}
            </div>
        @endif
        <div class="col-sm-3">
            {{--  <a href="{{ route('product.create') }}" class="btn btn-primary" >Add Product </a>  --}}
        </div>
        <div id="form_view">
            <h2>Add Product</h2>
            <form action="{{ route('product.store') }}" method="POST" class="isautovalid" id="form_add_product" enctype="multipart/form-data">

                @csrf
                @include('product.form')

                <div><input type="submit" value="Create" id="create" class="btn btn-primary"></div>

            </form>
        </div>
    </div>

    <div class="col-sm-8">
        <div class="page">
            <div class="container-fluid">
                <div id="search_form">
                    <form action="#" method="POST" id="search">
                        @csrf
                        <label for="product_name_search">Product Name</label>
                        <input type="text" name="product_name_search" id="product_name_search">
                        <label for="product_price_search">Product Price</label>
                        <input type="text" name="product_price_search" id="product_price_search">
                        <input type="button" value="Search" id="search" class="btn btn-primary">
                        <input type="button" value="Reset" id="reset" class="btn btn-primary">
                    </form>
                </div>

                    {!! $dataTable->table() !!}

            </div>
         </div>
     </div>

</div>
{!! $dataTable->scripts() !!}
<script src="{{ asset('assets/datatable-1.11.3/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/datatable-1.11.3/js/dataTables.responsive.min.js') }}"></script>
<script type="text/javascript">
 toastr.options.preventDuplicates = true;

 $.ajaxSetup({
     headers:{
         'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr("content")
     }

 });
 const table=$("#products-table");
    $(function(){
            AddEdit();
            function AddEdit(){
                //ADD product
                $('#form_add_product').on('submit', function(e){
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
                                    // $(form).trigger('reset');
                                    $(form)[0].reset();
                                    imagPreviewClear();
                                    $('#products-table').DataTable().ajax.reload(null, false);
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

            table.on('click','.edit-product',function(e){
                e.preventDefault();
                var url = $(this).attr('href');
                var id = $(this).data('edit');
                var token = $("meta[name='csrf-token']").attr("content");
                $.ajax({
                    type:'GET',
                    url:url,
                    data:{"_token":token,"id":id},
                    beforeSend:function(){

                    },
                    success: function(data)
                    {
                        $("#form_view").empty().append(data);
                        AddEdit();
                        captcha();
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                });

            });

            // delete record
            table.on('click','.delete-product', function(e){
                e.preventDefault();
                var url= $(this).attr('href');
                var id = $(this).data('delete');
                var token = $("meta[name='csrf-token']").attr("content");

                $.ajax({
                    type:'DELETE',
                    url:url,
                    data:{"_token":token,"id":id},
                    success: function(data){
                        table.DataTable().ajax.reload();
                    },
                    error:function(errorThrown){
                        alert(errorThrown);
                    }
                });

            });

            //Reset input file
            $('input[type="file"][name="product_photo"]').val('');
            //Image preview
            $('input[type="file"][name="product_photo"]').on('change', function(){
                var img_path = $(this)[0].value;
                var img_holder = $('.img-holder');
                var extension = img_path.substring(img_path.lastIndexOf('.')+1).toLowerCase();

                if(extension == 'jpeg' || extension == 'jpg' || extension == 'png'){
                    if(typeof(FileReader) != 'undefined'){
                        img_holder.empty();
                        var reader = new FileReader();
                        reader.onload = function(e){
                            $('<img/>',{'src':e.target.result,'class':'img-fluid','style':'max-width:100px;margin-bottom:10px;'}).appendTo(img_holder);
                        }
                        img_holder.show();
                        reader.readAsDataURL($(this)[0].files[0]);
                    }else{
                        $(img_holder).html('This browser does not support FileReader');
                    }
                }else{
                    $(img_holder).empty();
                }
            });
            imagPreviewClear()
            function imagPreviewClear(){
                var the= $('input[type="file"][name="product_photo"]');
                    var img_path = the[0].value;
                    var img_holder = $('.img-holder');
                    var extension = img_path.substring(img_path.lastIndexOf('.')+1).toLowerCase();

                    if(extension == 'jpeg' || extension == 'jpg' || extension == 'png'){
                        if(typeof(FileReader) != 'undefined'){
                            img_holder.empty();
                            var reader = new FileReader();
                            reader.onload = function(e){
                                $('<img/>',{'src':e.target.result,'class':'img-fluid','style':'max-width:100px;margin-bottom:10px;'}).appendTo(img_holder);
                            }
                            img_holder.show();
                            reader.readAsDataURL(the[0].files[0]);
                        }else{
                            $(img_holder).html('This browser does not support FileReader');
                        }
                    }else{
                        $(img_holder).empty();
                    }
            }

    });




    $('#search').on('click',function(e){
        table.on('preXhr.dt',function(e,settings,data){

            data.product_name=$('#product_name_search').val();
            data.product_price=$('#product_price_search').val();

        });
        e.preventDefault();
        table.DataTable().ajax.reload();
        return false;
    })

    $('#reset').on('click',function(e){
        e.preventDefault();
        table.on('preXhr.dt',function(e,settings,data){
            data.product_name='';
            data.product_price='';
        });
        table.DataTable().ajax.reload();
        return false;
    })
   // captcha Refresh
   captcha();
   function captcha(){
        $('.btn-refresh').on('click', function(e){
            // e.preventDefault();
            $.ajax({
                type: 'GET',
                url: "{{ route('product.refreshCaptcha') }}",
                success: function(data){
                    $(".captcha span").html(data.captcha);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert(errorThrown);
                }


            });
        });
   };



</script>

@endsection
