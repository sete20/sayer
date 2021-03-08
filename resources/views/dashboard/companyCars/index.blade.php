@extends('dashboard.layouts.app')

@section('content')
    @php $model = 'company-cars';

    @endphp
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
                                <th>@lang('admin.Model')</th>
                                <th>@lang('admin.vehicleNumber')</th>
                                <th>@lang('admin.chassisNo')</th>
                                <th>@lang('admin.ownershipType')</th>
                                <th>@lang('admin.trafficCode')</th>
                                <th>@lang('admin.trafficID')</th>
                                <th>@lang('admin.status')</th>
                                <th>@lang('admin.operation')</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>@lang('admin.Model')</th>
                                <th>@lang('admin.vehicleNumber')</th>
                                <th>@lang('admin.chassisNo')</th>
                                <th>@lang('admin.ownershipType')</th>
                                <th>@lang('admin.trafficCode')</th>
                                <th>@lang('admin.trafficID')</th>
                                <th>@lang('admin.status')</th>
                                <th>@lang('admin.operation')</th>
                            </tr>
                            </tfoot>
                            <tbody>
                                @foreach($rows as $index=>$row)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $row->Model }}</td>
                                        <td>{{ $row->vehicleType }}</td>
                                        <td>{{ $row->chassisNo }}</td>
                                        <td>{{ $row->ownershipType }}</td>
                                        <td>{{ $row->trafficCode }}</td>
                                        <td>{{ $row->trafficID }}</td>
                                        <td>@lang('admin.'.$row->status)</td>
                                        <td>

                                            <form action="{{ route('dashboard.' . $model . '.destroy',$row->id) }}" method="post">
                                                @csrf
                                                @method('delete')
{{--                                                @if ($row->user_id == 0)--}}
                                                    <button type="button" class="btn btn-primary violation_button" data-user-id="{{ $row->user_id }}" data-car-id="{{ $row->id }}" data-toggle="modal" data-target="#traffic-violation-modal"><i class="fa fa-plus"></i></button>
{{--                                                @else--}}
{{--                                                <a href="{{ route('dashboard.remove.driver',$row->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>--}}
{{--                                                @endif--}}
                                                @if ($row->user_id == 0 || $row->user_id == null)
                                                <a href="{{ route('dashboard.violations.create',$row->id) }}" class="btn btn-danger"><i class="fa fa-ban"></i></a>
                                                @else
                                                <a href="{{ route('dashboard.violations.create',['id'=>$row->id,'user_id'=>$row->user_id]) }}" class="btn btn-danger"><i class="fa fa-ban"></i></a>
                                                @endif
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

    <!-- Modal -->
    <div class="modal fade" id="traffic-violation-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('admin.trafficViolations')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@lang('admin.users')</span>
                        </div>
                        <select name="" class="form-control users_values"></select>
                        <input type="hidden" name="car_id" value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary add_user_to_violation">@lang('admin.edit_element')</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('admin.close')</button>
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
        <script>
            $(document).on('click',".violation_button",function () {
                let id = $(this).data('car-id');
                let user_id = $(this).data('user-id');
                $.ajax({
                    url: "{{ route('dashboard.add.selectDrivers') }}",
                    method: "get",
                    success : function (data) {
                        $('input[name=car_id]').val(id);
                        $('.users_values').html(`<option value="">@lang('admin.not_found_user')</option>`);
                        data.forEach(function (user){
                            $('.users_values').append(`
                                <option ${user.id == user_id ? 'selected' : ''} value="${user.id}">${user.email}</option>
                            `);
                        });
                    }
                });
            });

            $(".add_user_to_violation").on('click',function (){
                let id = $('input[name=car_id]').val();
                let user_id = $('.users_values').val();
                $.ajax({
                    url: "{{ route('dashboard.add.driver.update') }}",
                    method: "post",
                    data: {_token: "{{ csrf_token() }}",car_id: id,user_id: user_id},
                    success: function (data) {
                        toastr.success("{{ session()->get('success') }}","{{ __('admin.done') }}",{
                            "positionClass": "toast-bottom-{{ App()->getLocale() == 'ar' ? 'left' : 'right' }}",
                        });
                        $("#traffic-violation-modal").modal('hide');
                    }
                });
            });
        </script>
    @endpush
@endpush
