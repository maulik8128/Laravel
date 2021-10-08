@extends('layouts.app')
@section('assets')
{{-- <link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}"> --}}
{{-- <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script> --}}
<!-- <link rel="stylesheet" href="http://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"> -->
<link rel="stylesheet" href="http://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
<script src="http://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>


@endsection
@section('title', 'Posts')
@section('content')

<div class="row">
    <div class="col-6">
        @if (session('status'))
               <div class="alert alert-success" role="alert">
                    {{ session('status') }}
               </div>
        @endif
        <div class="col-3">
            <a href="{{ route('category.create') }}" class="btn btn-primary" >Product Add</a>
        </div>
        <div class="page">
            <div class="container-fluid">

                     {!! $dataTable->table() !!}
                </div>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript">
{!! $dataTable->scripts() !!}

</script>

@endsection
