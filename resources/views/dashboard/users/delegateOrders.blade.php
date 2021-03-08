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

    <div class="clearfix row">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>جدول شحنات التابعة للمستخدم {{ $user->profile->name_ar }}<small>@lang('admin.table_desc')</small> </h2>
{{--                    <br>--}}
{{--                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add_delivery_modal"> <i class="fa fa-plus"></i> @lang('admin.add_new')</button>--}}
{{--                    <a href="{{ route('dashboard.deliveries.create') }}?type_id=1&country_id=1" class="btn btn-success"> <i class="fa fa-plus"></i> @lang('admin.add_new')</a>--}}
{{--                    @if(request('status') == 1)--}}
{{--                        <button type="button" class="btn btn-info direct_orders_to_delegate"> <i class="fa fa-television"></i> @lang('admin.direct_orders_to_delegate')</button>--}}
{{--                    @endif--}}
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable new_datatable_table">
                            <thead>
                            <tr>
                                <th></th>
                                <th>@lang('admin.delivery_number')</th>
                                <th>@lang('admin.coupon_code')</th>
                                <th>@lang('admin.sender_name')</th>
                                <th>@lang('admin.consignee')</th>
                                <th>@lang('admin.city')</th>
                                <th>@lang('admin.state')</th>
                                <th>@lang('admin.status')</th>
                                <th>العمليات</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th class="yes">@lang('admin.delivery_number')</th>
                                <th class="yes">@lang('admin.coupon_code')</th>
                                <th class="yes">@lang('admin.sender_name')</th>
                                <th class="yes">@lang('admin.consignee')</th>
                                <th class="yes">@lang('admin.city')</th>
                                <th class="yes">@lang('admin.state')</th>
                                <th>@lang('admin.status')</th>
                                <th>العمليات</th>
                            </tr>
                            </tfoot>
                            <tbody>
                                @foreach($orders as $index=>$row)
                                    <tr>
                                        <td><input type="checkbox" name="deliveryIds[]" class="deliveryIds" value="{{ $row->id }}"></td>
                                        <td>{{ $row->order_number }}</td>
                                        <td>{{ $row->coupon_code }}</td>
                                        <td>{{ $row->user->type == 4 ? $row->user->profile->name : $row->user->profile->shop_owner_name }}</td>
                                        <td>{{ $row->consignee }}</td>
                                        <td>{{ $row->city['name_'.App()->getLocale()] }}</td>
                                        <td>{{ $row->state['name_'.App()->getLocale()] }}</td>
                                        @if($row->status == 1)
                                            <td><button class="btn btn-dark disabled">@lang('admin.new_delivery')</button></td>
                                        @elseif($row->status == 2)
                                            <td><button class="btn btn-info disabled">@lang('admin.request_delegate_delivery')</button></td>
                                        @elseif($row->status == 3)
                                            <td><button class="btn btn-info disabled">@lang('admin.delivery_to_delegate')</button></td>
                                        @elseif($row->status == 4)
                                            <td><button class="btn btn-primary disabled">@lang('admin.delivery_to_office')</button></td>
                                        @elseif($row->status == 5)
                                            <td><button class="btn btn-warning disabled">@lang('admin.delivery_onroad')</button></td>
                                        @elseif($row->status == 6)
                                            <td><button class="btn btn-default disabled">@lang('admin.delivery_success')</button></td>
                                        @endif
                                        <td>
                                            <a href="{{ route('dashboard.' . $model . '.show',$user->id) }}?type_id=1" class="btn btn-info"><i class="fa fa-eye"></i></a>
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

    <div class="modal fade" id="direct_orders_to_delegate_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="#" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">@lang('admin.choose_delegate')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3 col-md-12 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.employees_and_delegates')</span>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="display: block">
                        <button type="submit" class="btn btn-success submit_redirect_orders_to_delegates_button"><i class="fa fa-edit"></i>@lang('admin.apply_changes')</button>
                    </div>
                </form>
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
        $('.new_datatable_table tfoot th.yes').each( function () {
            var title = $(this).text();
            $(this).html( `<input type="text" class="form-control" placeholder="${title}" />` );
        } );
        $('.new_datatable_table').DataTable({
            initComplete: function () {
                // Apply the search
                this.api().columns().every( function () {
                    var that = this;

                    $( 'input', this.footer() ).on( 'keyup change clear', function () {
                        if ( that.search() !== this.value ) {
                            that
                                .search( this.value )
                                .draw();
                        }
                    } );
                } );
            }
        });

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
