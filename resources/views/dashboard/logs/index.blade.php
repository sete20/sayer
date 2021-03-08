@extends('dashboard.layouts.app')

@section('content')
    @php $model = 'logs'; @endphp
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-8 col-sm-12">
                <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-right"></i></a> @lang('admin.dashboard')</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active">@lang('admin.'.$model)</li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                <div class="bh_chart hidden-xs">
                    <div class="float-left m-l-15">
                        <small>@lang('admin.visitors')</small>
                        <h6 class="mb-0 mt-1"><i class="icon-user"></i> 1,784</h6>
                    </div>
                    <span class="bh_visitors float-right">2,5,1,8,3,6,7,5</span>
                </div>
                <div class="bh_chart hidden-sm">
                    <div class="float-left m-l-15">
                        <small>@lang('admin.visits')</small>
                        <h6 class="mb-0 mt-1"><i class="icon-globe"></i> 325</h6>
                    </div>
                    <span class="bh_visits float-right">10,8,9,3,5,8,5</span>
                </div>
                <div class="bh_chart hidden-sm">
                    <div class="float-left m-l-15">
                        <small>@lang('admin.statics')</small>
                        <h6 class="mb-0 mt-1"><i class="icon-bubbles"></i> 13</h6>
                    </div>
                    <span class="bh_chats float-right">1,8,5,6,2,4,3,2</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>@lang('admin.'.$model.'_table')<small>@lang('admin.table_desc')</small> </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable new_datatable_table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('admin.message')</th>
                                <th>@lang('admin.user')</th>
                                <th>@lang('admin.user_name')</th>
                                <th>@lang('admin.columnAction')</th>
                                <th>@lang('admin.created_at')</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>@lang('admin.message')</th>
                                <th>@lang('admin.user')</th>
                                <th>@lang('admin.user_name')</th>
                                <th>@lang('admin.columnAction')</th>
                                <th>@lang('admin.created_at')</th>
                            </tr>
                            </tfoot>
                            <tbody>
                                @foreach($rows as $index=>$row)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $row->logMessage }}</td>
                                        <td>{{ $row->user->email }}</td>
                                        <td>{{ $row->user_name }}</td>
                                        <td>{{ $row->columnAction }}</td>
                                        <td>{{ $row->created_at->diffForHumans() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

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
    <script>
        $('.new_datatable_table').DataTable();
    </script>

    @push('js')
        @if(session()->has('success'))
            <script>
                toastr.success("{{ session()->get('success') }}","{{ __('admin.done') }}",{
                    "positionClass": "toast-bottom-{{ App()->getLocale() == 'ar' ? 'left' : 'right' }}",
                });
            </script>
        @endif
    @endpush
@endpush
