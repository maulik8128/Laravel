@extends('layouts.app')
@section('assets')

<link rel="stylesheet" href="{{ asset('assets/datatable-1.11.3/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/datatable-1.11.3/css/responsive.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">

{{-- <link rel="stylesheet" href="{{ asset('assets/datatable-1.11.3/css/buttons.dataTables.min.css') }}"> --}}

@endsection
@section('title', 'Q')
@section('content')

<div class="main-container">
    <div class="page">
        <div class="container-fluid">
            {{-- <div class="create-btn pull-left header-btn">
                <select class="form-control form-control-sm kt-input" id="bulk_action_selection">
                    <option value="">Bulk Actions</option>
                    <option value="delete">Delete</option>
                </select>
                <span class="button" ><a href="javascript:;" id="bulk_action_apply">Apply</a></span>
                <span class="button"><a href="#">Add</a></span>
            </div> --}}
            <div class="table-main">
                <div class="col-lg-12 col-md-12">
                    <div class="table-wrap m-top-20">
                        <table class="table responsive nowrap" cellpadding="0" cellspacing="0" width="100%" id="datatable_ajax">
                            <thead>
                                <tr class="heading">
                                    <th class="table-checkbox"><input type="checkbox" id="select_all_chk_box" class="select_all_chk_box"></th>
                                    <th>Questions</th>
                                    <th>Category</th>
                                    <th>Ans</th>
                                    <th>Action</th>
                                </tr>
                                <tr class="filter">
                                    @php $i=0; @endphp
                                    <th class="th_{{ $i++; }}"><input type="hidden" class="form-control form-control-sm form-filter kt-input" data-col-index="1" name="id"></th>
                                    <th class="th_{{ $i++; }}"><input type="text" class="form-control form-control-sm form-filter kt-input" data-col-index="1" name="name"></th>

                                    <th class="th_{{ $i++; }}">
                                        <select class="form-control form-control-sm form-filter kt-input" id="status" name="status">
                                        <option value="">select</option>
                                        <option value="Aptitude">Aptitude</option>
                                        <option value="Basic Programming">Basic Programming</option>
                                        <option value="Data Science">Data Science</option>
                                        <option value="Data Structure">Data Structure</option>
                                        <option value="English">English</option>
                                        <option value="General Knowledge">General Knowledge</option>
                                        <option value="Programming">Programming</option>
                                        <option value="Reasoning">Reasoning</option>
                                        <option value="Sales & marketing">Sales & marketing</option>

                                    </select></th>
                                    <th class="th_{{ $i++; }}"><input type="hidden" class="form-control form-control-sm form-filter kt-input" data-col-index="1" name="email"></th>
                                    <th class="th_{{ $i++; }}">
                                        <button class="btn btn-success btn-brand kt-btn btn-sm filter-submit" id="search" type="button">
                                            <span><i class="fas fa-search"></i></span>
                                        </button>
                                        <button class="btn btn-success btn-sm btn-secondary" id="reset" type="button">
                                            <span><i class="fas fa-undo"></i></span>
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
<script src="https://cdn.datatables.net/plug-ins/1.11.3/pagination/input.js"></script>
{{-- <script src="{{ asset('assets/datatable-1.11.3/js/dataTables.buttons.min.js') }}"></script> --}}
{{-- <script src="/vendor/datatables/buttons.server-side.js"></script> --}}
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
            "pagingType": "input",
        "aoColumns": [
        { "bSortable": false,sWidth: '5%' },
        { "bSortable": bSortable,sWidth: '0%' },
        { "bSortable": bSortable,sWidth: '3%' },
        { "bSortable": bSortable,sWidth: '5%' },
        { "bSortable": false,sWidth: '1%' }
        ],
        processing: true,
        serverSide: true,
        responsive: true,
        lengthMenu: [10, 20, 30, 50, 100, 200],
        orderCellsTop: true,
        dom: `<'row'<'col-sm-12'tr>>
        <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
        ajax: "{{ route('questions.index') }}",
        order: [0,'DESC'],
        'columnDefs': [
            { 'responsivePriority': 1, 'targets': 0 },
            { 'responsivePriority': 2,'orderable': false, 'targets': -1 },
        ],
        columns: [
            {data: 'id', name: 'id', orderable: false, searchable: false},
            {data: 'question', name: 'question'},
            {data: 'category', name: 'category'},
            {data: 'ans', name: 'ans'},
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

    function disable_record(id,status){
        var statusvar = (status!=1)?"Active":"Inactive'";
        swal.fire({
            title: 'Are you sure you want to'+statusvar+'?',
            type: 'warning',
            showCancelButton: true,
            cancelButtonText : 'Cancel',
            confirmButtonText: 'Ok',
        }).then(function(result) {
            if (result.value) {
                jQuery.ajax({
                    type : "POST",
                    url : "{{ route('user.ajaxDisableAll') }}",
                    data : {'id':id,'status':status},
                    success: function(response) {
                        console.log(response);
                        $(tableId).DataTable().table().draw();
                        // $(tableId).DataTable().ajax.reload();
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                      alert(errorThrown);
                    }
                });
            }
        });
    }

</script>

@endsection
