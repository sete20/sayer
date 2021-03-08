@extends('dashboard.layouts.app')

@section('content')
@php $model = 'deliveries'; @endphp
<div class="block-header">
    <div class="row">
        <div class="col-lg-6 col-md-8 col-sm-12">
            <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-right"></i></a> @lang('admin.dashboard')</h2>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active">@lang('admin.'.$model)</li>
            </ul>
        </div>
        <div class="text-right col-lg-6 col-md-4 col-sm-12">
            <div class="bh_chart hidden-xs">
                <div class="float-left m-l-15">
                    <small>@lang('admin.visitors')</small>
                    <h6 class="mt-1 mb-0"><i class="icon-user"></i> 1,784</h6>
                </div>
                <span class="float-right bh_visitors">2,5,1,8,3,6,7,5</span>
            </div>
            <div class="bh_chart hidden-sm">
                <div class="float-left m-l-15">
                    <small>@lang('admin.visits')</small>
                    <h6 class="mt-1 mb-0"><i class="icon-globe"></i> 325</h6>
                </div>
                <span class="float-right bh_visits">10,8,9,3,5,8,5</span>
            </div>
            <div class="bh_chart hidden-sm">
                <div class="float-left m-l-15">
                    <small>@lang('admin.statics')</small>
                    <h6 class="mt-1 mb-0"><i class="icon-bubbles"></i> 13</h6>
                </div>
                <span class="float-right bh_chats">1,8,5,6,2,4,3,2</span>
            </div>
        </div>
    </div>
</div>
@push('css')
    <link rel="stylesheet" href="{{ url('dashboard') }}/assets-ltr/vendor/jquery-datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ url('dashboard') }}/assets-ltr/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ url('dashboard') }}/assets-ltr/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ url('dashboard') }}/assets-ltr/vendor/sweetalert/sweetalert.css"/>
@endpush

@push('js')
    <script src="{{ url('dashboard') }}/assets-ltr/bundles/datatablescripts.bundle.js"></script>
    <script src="{{ url('dashboard') }}/assets-ltr/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
    <script src="{{ url('dashboard') }}/assets-ltr/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
    <script src="{{ url('dashboard') }}/assets-ltr/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
    <script src="{{ url('dashboard') }}/assets-ltr/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
    <script src="{{ url('dashboard') }}/assets-ltr/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>
    <script src="{{ url('dashboard') }}/assets-ltr/vendor/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js -->
    <script src="{{ url('dashboard') }}/assets-ltr/bundles/mainscripts.bundle.js"></script>
{{--    <script src="{{ url('dashboard') }}/assets-ltr/js/pages/tables/jquery-datatable.js"></script>--}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
