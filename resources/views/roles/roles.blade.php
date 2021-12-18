@extends('layouts.app')
@section('assets')

<link rel="stylesheet" href="{{ asset('assets/datatable-1.11.3/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/datatable-1.11.3/css/responsive.dataTables.min.css') }}">

@endsection
@section('title', 'User')
@section('content')

<div class="main-container">
    <div class="page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2  create-btn header-btn pull-left">

                    <select class="form-control form-control-sm kt-input" id="bulk_action_selection">
                        <option value="">Bulk Actions</option>
                        <option value="delete">Delete</option>
                    </select>
                </div>
                <div class="col-sm-4 create-btn ">
                    <span class="button pull-left" ><a href="javascript:;" id="bulk_action_apply">Apply</a></span>
                    <span class="button pull-left"><a href="{{ route('roles.create') }}">Add</a></span>
                </div>
            </div>
            <div class="table-main">
                <div class="col-lg-7 col-md-12">
                    <div class="table-wrap m-top-20">
                        <table class="table responsive nowrap" cellpadding="0" cellspacing="0" width="100%" id="datatable_ajax">
                            <thead>
                                <tr class="heading">
                                    <th class="table-checkbox"><input type="checkbox" id="select_all_chk_box" class="select_all_chk_box"></th>
                                    <th>Role</th>
                                    <th>Permission</th>
                                    <th>Action</th>

                                </tr>
                                <tr class="filter">
                                    @php $i=0; @endphp
                                    <th class="th_{{ $i++; }}"><input type="hidden" class="form-control form-control-sm form-filter kt-input" data-col-index="1" name="id"></th>
                                    <th class="th_{{ $i++; }}"><input type="text" class="form-control form-control-sm form-filter kt-input" data-col-index="1" name="name"></th>
                                    <th class="th_{{ $i++; }}"><input type="hidden" class="form-control form-control-sm form-filter kt-input" data-col-index="1" name="s"></th>
                                    <th class="th_{{ $i++; }}">
                                        <button class="btn btn-success btn-brand kt-btn btn-sm filter-submit" id="search" type="button">
                                            <span><i class="fas fa-search"></i><span>&nbsp;Search</span></span>
                                        </button>
                                        <button class="btn btn-success btn-sm btn-secondary" id="reset" type="button">
                                            <span><i class="fas fa-undo"></i><span>&nbsp;Reset</span></span>
                                        </button>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/datatable-1.11.3/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/datatable-1.11.3/js/dataTables.responsive.min.js') }}"></script>
<script type="text/javascript">
 toastr.options.preventDuplicates = true;
 $.ajaxSetup({
     headers:{
         'X-CSRF-TOKEN':'{{ csrf_token() }}'
     }
 });
        //Datatable ---
        const tableId ='#datatable_ajax';
        var bSortable = true;
        const table = $(tableId).DataTable({
        "aoColumns": [
        { "bSortable": false,sWidth: '0%' },
        { "bSortable": bSortable,sWidth: '0%' },
        { "bSortable": false,sWidth: '0%' },
        { "bSortable": false,sWidth: '0%' }
        ],
        processing: true,
        serverSide: true,
        responsive: true,
        lengthMenu: [11, 50, 100, 200],
        orderCellsTop: true,
        dom: `<'row'<'col-sm-12'tr>>
        <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
        ajax: "{{ route('roles.index') }}",
        order: [0,'DESC'],
        'columnDefs': [
            { 'responsivePriority': 1, 'targets': 0 },
            { 'responsivePriority': 2,'orderable': false, 'targets': -1 },
        ],
        columns: [
            {data: 'id', name: 'id', orderable: false, searchable: false},
            {data: 'name', name: 'name'},
            {data: 'permission', name: 'permission.name'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    table.on( 'responsive-resize', function ( e, datatable, columns ) {
        var count = columns.reduce( function (a,b) {
            return b === false ? a+1 : a;
        }, 0 );

        $.each(columns, function( index, value ) {
          if (value === false) {
            $('.th_'+index).hide();
          }
          else
          {
            $('.th_'+index).show();
          }
        });
    });
    //search in datatable
    $('input.form-filter, select.form-filter').keydown(function(e)
    {
        if (e.keyCode == 13)
        {
           e.preventDefault();
           search_result();
        }
    });
    $('#search').on('click', function(e) {
        e.preventDefault();
        search_result();
    });
    function search_result()
    {
        var params = {};
        $('.filter').find('.kt-input').each(function(i) {
            params[i] = $(this).val();
        });
        $.each(params, function(i, val) {
            // apply search params to datatable
            $(tableId).DataTable().column(i).search(val ? val : '', false, false);
        });
        $(tableId).DataTable().table().draw();
    }

    //reset datatable
    $('#reset').on('click', function(e) {
        e.preventDefault();
        $('.kt-input').val('');
        $(tableId).DataTable().columns().search( '' ).draw();
    });

    $("#select_all_chk_box").click(function () {
     $(".bulk_action").prop('checked', $(this).prop('checked'));
    });

        // delete record
        table.on('click','.delete-roles', function(e){
        e.preventDefault();
        var url= $(this).attr('href');
        var id = $(this).data('delete');
        var token = $("meta[name='csrf-token']").attr("content");
        swal.fire({
            title: 'Are you sure you want to Delete ?',
            type: 'warning',
            showCancelButton: true,
            cancelButtonText : 'Cancel',
            confirmButtonText: 'Ok',

        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type:'DELETE',
                    url:url,
                    data:{"_token":token,"id":id},
                    success: function(data){
                        $(tableId).DataTable().ajax.reload();
                    },
                    error:function(errorThrown){
                        alert(errorThrown);
                    }
                });
            }
        });
    });

</script>

@endsection
