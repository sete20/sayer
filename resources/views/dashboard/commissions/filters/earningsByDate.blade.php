@extends('dashboard.layouts.app')

@section('content')
    @php $model = 'commissions'; @endphp
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
                    <h2>
                        @lang('admin.'.$model.'_table')
                        @if(!request()->has('from') && !request()->has('to'))
                            => اليوم
                        @endif

                        <small>@lang('admin.table_desc')</small> </h2>
                    <br>
                    <form action="" method="get">
                        <div class="row">
                            <div class="p-1 col-lg-3">
                                <label> من  </label>
                                <input type="date" class="form-control" value="{{ request('from') }}" name="from" style="height: 3.2em;font-size:15px;font-weight:bold">
                                </input>
                            </div>
                            <div class="p-1 col-lg-3">
                                <label> الي </label>
                                <input type="date" class="form-control" value="{{ request('to') }}" name="to" style="height: 3.2em;font-size:15px;font-weight:bold">
                            </input>
                            </div>
                            <div class="p-1 col-lg-4">
                                <label> المندوب </label>
                                <select name="representative_id" style="height: 3.2em;font-size:15px;font-weight:bold" class="form-control">
                                    <option value="0">جميع المناديب</option>
                                    @foreach($representatives as $representative)
                                        <option {{ request('representative_id') == $representative->id ? 'selected' : '' }} value="{{ $representative->id }}">{{$representative->profile->name_ar}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label></label>
                                <button type="submit" class=" btn btn-primary" style=" margin-top:35px;width:100px;height:50px">
                                <i class="m-2 fa fa-search"></i>  بحث 
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

{{--  /////////////////////////////////  --}}

<div class="body" id="show">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover dataTable new_datatable_table">
            <thead>
            <tr>

                <th>اسم المندوب</th>
                <th>عدد الطلبات الموصلة</th>
                @if(!request()->has('to') && !request()->has('from'))
                    <th>تاريخ التوصيل</th>
                @endif
                <th>اجمالي الارباح</th>
                <th>حالة الارباح </th>

            </tr>
            </thead>
            <tfoot>
            <tr>

                <th>اسم المندوب</th>
                <th>عدد الطلبات الموصلة</th>
                @if(!request()->has('to') && !request()->has('from'))
                    <th>تاريخ التوصيل</th>
                @endif
                <th>اجمالي الارباح</th>
                <th>حالة الارباح </th>
            </tr>
            </tfoot>
            <tbody>
                @foreach($rows as $row)
                    <tr>
                        <td>{{ $row->profile->name_ar }}</td>
                        <td>{{ count($row->commissions) }}</td>
                        @if(!request()->has('to') && !request()->has('from'))
                            <td>{{ \Carbon\Carbon::today()->format('Y-m-d') }}</td>
                        @endif
                        <td>{{ $row->commissions->sum('commission') }} درهم</td>
                        <td>
                            @if($row->isPaid == 1)
                                <button class="btn btn-dark disabled">@lang('admin.paid')</button>
                            @elseif($row->isPaid == 0)
                                <form action="{{ route('dashboard.commissions.paid',$row->id) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <button class="btn btn-info">@lang('admin.click_to_unpaid')</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
{{--  /////////////////////////////////////  --}}
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $('.new_datatable_table').DataTable();
    </script>
@endpush

   @if(session()->has('success'))
        <script>
            toastr.success("{{ session()->get('success') }}","{{ __('admin.done') }}",{
                "positionClass": "toast-bottom-{{ App()->getLocale() == 'ar' ? 'left' : 'right' }}",
            });
        </script>
    @endif    