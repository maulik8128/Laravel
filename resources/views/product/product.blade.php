@extends('layouts.app')
@section('assets')

<link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('assets/datatable/css/dataTables.bootstrap.min.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('assets/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/toastr/toastr.min.css') }}">
<script src="{{ asset('assets/jquery/jquery-3.6.0.min.js') }}"></script>

<link rel="stylesheet" href="http://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
<script src="http://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
{{-- <script src="/vendor/datatables/buttons.server-side.js"></script> --}}

@endsection
@section('title', 'Product')
@section('content')

<div class="row">
    <div class="col-4" >
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                    {{ session('status') }}
            </div>
        @endif
        <div class="col-3">
            {{--  <a href="{{ route('product.create') }}" class="btn btn-primary" >Add Product </a>  --}}
        </div>
        <div id="form_view">
            <h2>Add Product</h2>
            <form action="{{ route('product.store') }}" method="POST" id="form_add_product" enctype="multipart/form-data">

                @csrf
                @include('product.form')

                <div><input type="submit" value="Create" id="create" class="btn btn-primary"></div>

            </form>
        </div>
    </div>

    <div class="col-8">
        <div class="page">
            <div class="container-fluid">
                    {!! $dataTable->table() !!}

            </div>
         </div>
     </div>

</div>
{!! $dataTable->scripts() !!}
{{-- <script src="{{ asset('assets/bootstrap/js/bootstrap.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/datatable/js/dataTables.dataTables.min.js') }}"></script> --}}
<script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/toastr/toastr.min.js') }}"></script>
{{-- <script src="{{ asset('assets/toastr/toastr.js.map') }}"></script> --}}
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
                $('#form_add_product').on('submit', function(e){
                    e.preventDefault();
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
                            console.log(data);
                            if(data.code == 0){
                                $.each(data.error, function(prefix, val){
                                    $(form).find('span.'+prefix+'_error').text(val[0]);
                                });
                            }else{
                                $(form)[0].reset();
                                $('#products-table').DataTable().ajax.reload(null, false);
                                toastr.success(data.msg);
                            }
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            alert(errorThrown);
                        }
                    });

                });
            };

        $("#products-table").on('click','.edit-product',function(e){
            e.preventDefault();
            var url = e.target;
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
                    console.log(data);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
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

    });
</script>

@endsection
