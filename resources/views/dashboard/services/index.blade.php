@extends('dashboard.layouts.app')

@section('content')
    @php $model = 'services'; @endphp
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

    <div class="clearfix row">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>@lang('admin.'.$model.'_table')<small>@lang('admin.table_desc')</small> </h2>
                    <br>
                    <a href="{{ route('dashboard.'.$model.'.create') }}" class="btn btn-success"> <i class="fa fa-plus"></i> @lang('admin.add_new')</a>

                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable new_datatable_table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('admin.service_ar')</th>
                                <th>@lang('admin.service_en')</th>
                                <th>@lang('admin.service_type')</th>
                                <th>@lang('admin.status')</th>
                                <th>@lang('admin.operation')</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>@lang('admin.service_ar')</th>
                                <th>@lang('admin.service_en')</th>
                                <th>@lang('admin.service_type')</th>
                                <th>@lang('admin.status')</th>
                                <th>@lang('admin.operation')</th>
                            </tr>
                            </tfoot>
                            <tbody>
                                @foreach($rows as $index=>$row)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $row->name_ar }}</td>
                                        <td>{{ $row->name_en }}</td>
                                        @if($row->type == 1)
                                            <td><button class="btn btn-primary disabled">@lang('admin.local')</button></td>
                                        @elseif($row->type == 2)
                                            <td><button class="btn btn-warning disabled">@lang('admin.international')</button></td>
                                        @endif

                                        @if($row->status == 1)
                                            <td><button class="btn btn-dark disabled">@lang('admin.active')</button></td>
                                        @elseif($row->status == 0)
                                            <td><button class="btn btn-info disabled">@lang('admin.deactive')</button></td>
                                        @endif
                                        <td>
                                            <form action="{{ route('dashboard.' . $model . '.destroy',$row->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <a href="{{ route('dashboard.' . $model . '.edit',$row->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are You Sure ?')"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
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
