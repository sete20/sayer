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
                    <h2>
                        @lang('admin.'.$model.'_table')
                        @switch(request('status'))
                            @case(1)
                                => @lang('admin.new_deliveries')
                            @break
                            @case(2)
                                => @lang('admin.request_delegate_deliveries')
                            @break
                            @case(3)
                                => @lang('admin.request_delegate_deliveries_submit')
                            @break
                            @case(4)
                                => @lang('admin.request_submit_in_office')
                            @break
                            @case(5)
                                => @lang('admin.orders_redirect_to_deliver')
                            @break
                            @case(6)
                                => @lang('admin.orders_delivered_success')
                            @break
                            @case(7)
                                => @lang('admin.orders_delivered_delay')
                            @break
                            @case(8)
                                => @lang('admin.orders_delivered_cancelled')
                            @break
                            @default
                        @endswitch

                        <small>@lang('admin.table_desc')</small> </h2>
                    <br>
                    <form action="" method="get">
                        @include('dashboard.deliveries.deliveries_order.tracking')
                    </form>
                    @if(request('status') == 1)
                    <a href="{{ route('dashboard.deliveries.create') }}?type_id=1&country_id=1" class="btn btn-success"> <i class="fa fa-plus"></i> @lang('admin.add_new')</a>
                    @endif

                    @if(request('status') == 1 || request('status') == 7)
                        <button type="button" class="btn btn-info direct_orders_to_delegate"> <i class="fa fa-television"></i> @lang('admin.direct_orders_to_delegate')</button>
                    @endif
                    @if(request('status') == 4 || request('status') == 7)
                        <button type="button" class="btn btn-info redirect_delegate_to_deliver_order"> <i class="fa fa-television"></i> @lang('admin.redirect_delegate_to_deliver_order')</button>
                    @endif
                    <!-- filters -->
                    @if( (request('status') == 1 || request('status') == 4) || request('status') == 7 )
                        <form action="" method="get">
                            @include('dashboard.deliveries.deliveries_order.order_with_city_and_state')
                        </form>
                    @elseif(request('status') == 2)
                            <form action="" method="get">
                                @include('dashboard.deliveries.deliveries_order.order_with_seller')
                            </form>
                    @elseif(request('status') == 3 || request('status') == 5)
                            <form action="" method="get">
                                @include('dashboard.deliveries.deliveries_order.order_with_representative')
                            </form>
                    @elseif(request('status') == 6)
                        <form action="" method="get">
                            @include('dashboard.deliveries.deliveries_order.order_with_representative_and_from_to_date')
                        </form>
                    @endif
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <form action="{{ route('dashboard.deliveries.remove-deliveries') }}" method="post" class="cancel-delivery-form">
                            @csrf
                            <table class="table table-bordered table-striped table-hover dataTable new_datatable_table">
                                <thead>
                                <tr>
                                    <th><input type="checkbox" class="selectAll"></th>
                                    <th>@lang('admin.delivery_number')</th></th>
                                    <th>@lang('admin.sender_name')</th>
                                    <th>@lang('admin.received_date')</th>
                                    <th>@lang('admin.consignee')</th>
                                    <th>@lang('admin.city')</th>
                                    <th>@lang('admin.state')</th>
                                    <th>@lang('admin.status')</th>
                                    <th>@lang('admin.operation')</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th></th>
                                    <th class="yes">@lang('admin.delivery_number')</th>
                                    <th class="yes">@lang('admin.sender_name')</th>
                                    <th class="yes">@lang('admin.received_date')</th>
                                    <th class="yes">@lang('admin.consignee')</th>
                                    <th class="yes">@lang('admin.city')</th>
                                    <th class="yes">@lang('admin.state')</th>
                                    <th>@lang('admin.status')</th>
                                    <th>@lang('admin.operation')</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($rows as $index=>$row)
                                        <tr>
                                            <td><input type="checkbox" name="deliveryIds[]" class="deliveryIds" value="{{ $row->id }}"></td>
                                            <td>{{ $row->order_number }}</td>
                                            <td>{{ $row->user->type == 4 ? $row->user->profile->name : $row->user->profile->shop_owner_name }}</td>
                                            <td>{{ $row->received_date }}</td>
                                            <td>{{ $row->consignee }}</td>
                                            <td>{{ $row->city['name_'.App()->getLocale()] }}</td>
                                            <td>{{ $row->state['name_'.App()->getLocale()] }}</td>
                                            @if($row->status == 1)
                                                <td><button disabled class="btn btn-dark disabled">@lang('admin.new_delivery')</button></td>
                                            @elseif($row->status == 2)
                                                <td><button disabled class="btn btn-info disabled">@lang('admin.request_delegate_delivery')</button></td>
                                            @elseif($row->status == 3)
                                                <td><button disabled class="btn btn-info disabled">@lang('admin.delivery_to_delegate')</button></td>
                                            @elseif($row->status == 4)
                                                <td><button disabled class="btn btn-primary disabled">@lang('admin.delivery_to_office')</button></td>
                                            @elseif($row->status == 5)
                                                <td><button disabled class="btn btn-warning disabled">@lang('admin.delivery_onroad')</button></td>
                                            @elseif($row->status == 6)
                                                <td><button disabled class="btn btn-default disabled">@lang('admin.delivery_success')</button></td>
                                            @elseif($row->status == 7)
                                                <td><button disabled class="btn btn-warning disabled">@lang('admin.delivery_delay')</button></td>
                                            @elseif($row->status == 8)
                                                <td><button disabled class="btn btn-danger disabled">@lang('admin.delivery_cancelled')</button></td>
                                            @endif
                                            <td>
                                                <a href="{{ route('dashboard.' . $model . '.show',$row->id) }}?type_id=1" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                                @if( request()->has('status') && !in_array(request('status'),[1,6,8]) )
                                                <a href="{{ route('dashboard.deliveries.invoice',$row->id) }}" target="_blank" class="btn btn-default"><i class="fa fa-print"></i></a>
                                                @endif
                                                @if(in_array($row->status,[2,3,4,5]))
                                                <a href='#'  class="btn btn-danger cancel-order" data-toggle="modal" data-id={{$row->id}}><i class="fa fa-stop-circle"></i></a>
                                                @endif
                                                @if(in_array($row->status,[2,3,4,5]))
                                                <a href='#'  class="btn btn-warning delay-order" data-toggle="modal" data-id={{$row->id}}><i class="fa fa-stop-circle"></i></a>
                                                @endif
                                                @if(request()->has("trackKey")||request()->has("trackMethod"))
                                                
                                                @if(request('trackKey') && in_array(request('trackMethod'),["byOrderNumber","byUserEmail","byPhoneNumber"]))
                                                <a href="{{route('dashboard.deliveries.tacking.timeline',$row->id)}}"  class="btn btn-warning delay-order"><i class="fa fa-stop-circle"></i> مجرد محتوي نصي </a>
                                                @endif

                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="cancel_order_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="#" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">الــرجاء ملئ القائمة التالية</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group card col-md-12 col-lg-12 col-sm-12 display-in-line-block">
                                <label for="recipient-name" class="col-form-label">
                                    <span class="input-group-text">االرجاء كتـابة سبب الغاء الطلب</span>
                                </label>
                                <input type="hidden" id="orderCancelID" value="">
                                <textarea class="form-control reasonOfCancel" name="reasonOfCancel" cols="50"></textarea>
                          </div>
                    </div>
                    <div class="modal-footer" style="display: block">

                        <button type="submit" class="btn btn-success cancel_order_class"><i class="fa fa-edit"></i>@lang('admin.apply_changes')</button>

                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
{{--  //////////////////////////////////////////////////////  --}}
    <div class="modal fade" id="delay_order_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="#" method="get">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">الــرجاء ملئ القائمة التالية</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
            <div class="form-group card col-md-6 col-lg-6 col-sm-6 display-in-line-block">
            <label for="recipient-name" class="col-form-label">
            <span class="input-group-text">الرجاء كتـابة سبب تـاجـيل الطلب</span>
            </label>
            <textarea class="form-control reasonOfDelay" name="reasonOfDelay" cols="50"></textarea>
            <input type="hidden" id="orderId"value="">
          </div>
          <br>
          <div class="form-group card col-md-6 col-lg-6 col-sm-6 display-in-line-block" >
            <label for="message-text" class="mb-10 col-form-label">
            <span class="input-group-text"> موعد التاجيل</span>
           </label>
            <input type="date" name="delayDate" class="form-control delayDate">
          </div>

                </div>
                <div class="modal-footer" style="display: block">
                    <button type="submit" class="btn btn-success delay_order_class"><i class="fa fa-edit"></i>@lang('admin.apply_changes')</button>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{--  /////////////////////////////////////////  --}}
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
                                <select name="user_employee_or_delegate_id" class="form-control">
                                    <option value="">اختر موظف او مندوب</option>
                                    @foreach($users->whereIn('type',[1,2])->get() as $user)

                                        <option value="{{ $user->id }}">
                                        @switch($user->type)
                                            @case($user->type == 3)
                                           {{ $user->profile->name_ar . '(الادارة)'}}
                                            @break
                                            @case($user->type == 1)
                                            {{ $user->profile->name_ar . ' (موظف)' }}
                                            @break
                                            @default
                                            {{ $user->profile->name_ar . ' (مندوب)' }}
                                        @endswitch
                                        </option>

                                    @endforeach
                                </select>
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
{{--  //////////////////////////////////////////////////////  --}}
    <div class="modal fade" id="redirect_delegate_to_deliver_order" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <select name="user_delegate_id" class="form-control">
                                    <option value="">اختر المندوب لتسليم الطلبات</option>
                                    @foreach($users->whereIn('type',[1,2])->get() as $user)
                                        @if($user->type == 2)
                                            <option value="{{ $user->id }}">
                                                {{ $user->profile->name_ar . ' (مندوب)' }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="display: block">
                        <button type="submit" class="btn btn-success submit_redirect_delegate_to_deliver_order_button"><i class="fa fa-edit"></i>@lang('admin.apply_changes')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
{{--  //////////////////////////////////////////////////////  --}}
    <div class="modal fade" id="redirect_confirm_deliveries_in_office" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <select name="user_confirm_id" class="form-control">
                                    <option value="">اختر لتسليم الطلبات في المكتب</option>
                                    @foreach(App\Models\User::query()->whereIn('type',[1])->get() as $user)
                                            <option value="{{ $user->id }}">{{ $user->profile->name_ar . ' (موظف)' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="display: block">
                        <button type="submit" class="btn btn-success submit_redirect_confirm_deliveries_in_office"><i class="fa fa-edit"></i>@lang('admin.apply_changes')</button>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).on('click','.delete_order_delegate',function (e){
            e.preventDefault();
            Swal.fire({
                title: 'هل انت متأكد من سحب الشحنة من المندوب',
                text: "تستطيع اضافة مندوب اخر بعد السحب",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'اغلاق',
                confirmButtonText: 'نعم اسحب الشحنه'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `{{ route('dashboard.' . $model . '.delete-order.delegate') }}/${$(this).data('id')}`;
                }
            });
        });

    </script>
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

        $(document).on('click','.direct_orders_to_delegate',function (){
            let deliveryIds = $(".deliveryIds:checkbox:checked").map(function(){
                return $(this).val();
            }).get();

            if (deliveryIds.length == 0) {
                toastr.error("{{ session()->get('success') }}","اختر شحنة واحدة علي الاقل",{
                    "positionClass": "toast-top-{{ App()->getLocale() == 'ar' ? 'left' : 'right' }}",
                });
            } else {
                $('#direct_orders_to_delegate_modal').modal('show');
            }
        });

        $(document).on('click','.redirect_delegate_to_deliver_order',function (){
            let deliveryIds = $(".deliveryIds:checkbox:checked").map(function(){
                return $(this).val();
            }).get();
            if (deliveryIds.length == 0) {
                toastr.error("{{ session()->get('success') }}","اختر شحنة واحدة علي الاقل",{
                    "positionClass": "toast-top-{{ App()->getLocale() == 'ar' ? 'left' : 'right' }}",
                });
            } else {
                $('#redirect_delegate_to_deliver_order').modal('show');
            }
        });

        $(document).on('click','#confirm_deliveries_in_office',function () {
            let deliveryIds = $(".deliveryIds:checkbox:checked").map(function(){
                return $(this).val();
            }).get();
            if (deliveryIds.length == 0) {
                toastr.error("{{ session()->get('success') }}","اختر شحنة واحدة علي الاقل",{
                    "positionClass": "toast-top-{{ App()->getLocale() == 'ar' ? 'left' : 'right' }}",
                });
            } else {
                $('#redirect_confirm_deliveries_in_office').modal('show');
            }
        });

        $(document).on('click','.submit_redirect_delegate_to_deliver_order_button',function (e){
            e.preventDefault();
            let user_id = $('select[name=user_delegate_id]').val();
            if (user_id > 0) {
                let deliveryIds = $(".deliveryIds:checkbox:checked").map(function(){
                    return $(this).val();
                }).get();
                $.ajax({
                    url: "{{ route('dashboard.deliveries.users.add_order_delegate_to_deliver') }}",
                    method: "post",
                    data: {deliveryIds: deliveryIds,user_id: user_id,_token:'{{ csrf_token() }}'},
                    success: function (data) {
                        toastr.success("{{ session()->get('success') }}","تمت العملية بنجاح سيتم تحويلك الان",{
                            "positionClass": "toast-top-{{ App()->getLocale() == 'ar' ? 'left' : 'right' }}",
                        });

                        setTimeout(function () {
                           window.location.reload();
                        },1000);
                    }
                });
            } else {
                toastr.error("{{ session()->get('success') }}","اختر مندوب من القائمة",{
                    "positionClass": "toast-top-{{ App()->getLocale() == 'ar' ? 'left' : 'right' }}",
                });
            }
        });

        $(document).on('click','.submit_redirect_orders_to_delegates_button',function (e){
            e.preventDefault();
            let user_id = $('select[name=user_employee_or_delegate_id]').val();
            console.log(user_id);
            if (user_id > 0) {
                let deliveryIds = $(".deliveryIds:checkbox:checked").map(function(){
                    return $(this).val();
                }).get();
                $.ajax({
                    url: "{{ route('dashboard.deliveries.users.add_order_delegate') }}",
                    method: "post",
                    data: {deliveryIds: deliveryIds,user_id: user_id,_token:'{{ csrf_token() }}'},
                    success: function (data) {
                        toastr.success("{{ session()->get('success') }}","تمت العملية بنجاح سيتم تحويلك الان",{
                            "positionClass": "toast-top-{{ App()->getLocale() == 'ar' ? 'left' : 'right' }}",
                        });

                        setTimeout(function () {
                           window.location.reload();
                        },1000);
                    }
                });
            } else {
                toastr.error("{{ session()->get('success') }}","اختر موظف او مندوب من القائمة",{
                    "positionClass": "toast-top-{{ App()->getLocale() == 'ar' ? 'left' : 'right' }}",
                });
            }
        });

        $(document).on('click','.submit_redirect_confirm_deliveries_in_office',function (e) {
            e.preventDefault();

            let user_id = $('select[name=user_confirm_id]').val();
            if (user_id > 0) {
                let deliveryIds = $(".deliveryIds:checkbox:checked").map(function(){
                    return $(this).val();
                }).get();
                $.ajax({
                    url: "{{ route('dashboard.deliveries.users.confirm_orders_to_office') }}",
                    method: "post",
                    data: {deliveryIds: deliveryIds,user_id: user_id,_token:'{{ csrf_token() }}'},
                    success: function (data) {
                        toastr.success("{{ session()->get('success') }}","تمت العملية بنجاح سيتم تحويلك الان",{
                            "positionClass": "toast-top-{{ App()->getLocale() == 'ar' ? 'left' : 'right' }}",
                        });

                        setTimeout(function () {
                           window.location.reload();
                        },1000);
                    }
                });
            } else {
                toastr.error("{{ session()->get('success') }}","اختر موظف او مندوب من القائمة",{
                    "positionClass": "toast-top-{{ App()->getLocale() == 'ar' ? 'left' : 'right' }}",
                });
            }
        });

        $('#city_id').on('change',function(e){

            var city_id = e.target.value

           $.get('city-region?city_id='+city_id, function(data){
            $('#region').empty();
               $.each(data,function(index,regionObj){
                $('#region').append('<option value="'+regionObj.id+'">'+regionObj.name_ar+'</option>')
               })

           })
        });

        {{--$(document).on('click','.cancel-delivery',function (e){--}}
        {{--    e.preventDefault();--}}
        {{--    let deliveryIds = $(".deliveryIds:checkbox:checked").map(function(){--}}
        {{--        return $(this).val();--}}
        {{--    }).get();--}}
        {{--    if (deliveryIds.length == 0) {--}}
        {{--        toastr.error("{{ session()->get('success') }}","اختر شحنة واحدة علي الاقل",{--}}
        {{--            "positionClass": "toast-top-{{ App()->getLocale() == 'ar' ? 'left' : 'right' }}",--}}
        {{--        });--}}
        {{--    } else {--}}
        {{--        $('.cancel-delivery-form').submit();--}}
        {{--    }--}}
        {{--});--}}

        $(document).on('click','.delay-order',function (){
            var id = $(this).data('id');
            $('#orderId').val(id);
            $('#delay_order_modal').modal('show');
        });

        $(document).on('click','.delay_order_class',function delayOrder(e){
            e.preventDefault();
            $.ajax({
                url: "{{ route('dashboard.deliveries.order.daley') }}",
                method: "post",
                data: {_token: '{{ csrf_token() }}',order_id: $('#orderId').val(),dateDelay:$('.delayDate').val(),reasonOfDelay:$('.reasonOfDelay').val()},
                success: function (data) {
                    toastr.success("{{ session()->get('success') }}","تمت العملية بنجاح سيتم تحويلك الان",{
                        "positionClass": "toast-top-{{ App()->getLocale() == 'ar' ? 'left' : 'right' }}",
                    });

                    setTimeout(function () {
                       window.location.reload();
                    },1000);
                }
            });
        });

        $(document).on('click','.cancel-order',function (){
            var id = $(this).data('id');
            $('#orderCancelID').val(id);
            $('#cancel_order_modal').modal('show');
       });

        $(document).on('click','.cancel_order_class',function cancelOrder(e){
            e.preventDefault();
            $.ajax({
                url: "{{ route('dashboard.deliveries.order.cancel') }}",
                method: "post",
                data: {_token: '{{ csrf_token() }}',order_id: $('#orderCancelID').val(),reasonOfCancel:$('.reasonOfCancel').val()},
                success: function (data) {
                    toastr.success("{{ session()->get('success') }}","تمت العملية بنجاح سيتم تحويلك الان",{
                        "positionClass": "toast-top-{{ App()->getLocale() == 'ar' ? 'left' : 'right' }}",
                    });

                    setTimeout(function () {
                       window.location.reload();
                    },1000);
                }
            });
        });

        $(document).on('click','.selectAll', function () {
            if ($(this).hasClass('allChecked')) {
                $('input[type="checkbox"]').prop('checked', false);
            } else {
                $('input[type="checkbox"]').prop('checked', true);
            }
            $(this).toggleClass('allChecked');
        });
    </script>

    @if(session()->has('success'))
        <script>

            toastr.success("{{ session()->get('success') }}","{{ __('admin.done') }}",{
                "positionClass": "toast-bottom-{{ App()->getLocale() == 'ar' ? 'left' : 'right' }}",
            });

        </script>
    @endif
@endpush
