@extends('dashboard.layouts.app')

@section('content')
    @php $model = 'deliveries'; @endphp
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-8 col-sm-12">
                <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-right"></i></a> @lang('admin.dashboard')</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.'.$model.'.index') }}">@lang('admin.'.$model)</a></li>
                    <li class="breadcrumb-item active">@lang('admin.add_new')</li>
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
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="header">
                    <h2> @lang('admin.add_new_delivery')</h2>
                </div>
                <div class="body">
                    <div class="show-validate"></div>
                    <form action="{{ route('dashboard.'. $model .'.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="country_id" value="{{ request('country_id') }}">
                        <input type="hidden" name="type_id" value="{{ request('type_id') }}">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.coupon_code')</span>
                                </div>
                                <input type="text" name="coupon_code" class="form-control" value="{{ old('coupon_code') }}" placeholder="@lang('admin.coupon_code')" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.received_data')</span>
                                </div>
                                <input type="text" name="received_date" value="{{ \Carbon\Carbon::tomorrow()->format('Y-m-d') }}" class="form-control">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.sender_type')</span>
                                </div>
                                <select name="sender_type_id" class="form-control">
                                    <option value="">@lang('admin.choose_person')</option>
                                    <option value="1">@lang('admin.person')</option>
                                    <option value="2">@lang('admin.seller')</option>
                                </select>
                            </div>
                            <div class="sender_type_fields"></div>
                            <div class="user_details"></div>
                            <div class="row">
                                <div class="col-md-12 input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"  style="background-color: #2eacb3; color: white;">@lang('admin.consignee')</span>
                                    </div>
                                    <input type="text" name="consignee" style="border: 1px solid #2eacb3;" class="form-control" value="{{ old('consignee') }}" placeholder="@lang('admin.consignee')" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                                <div class="col-md-12 input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="background-color: #2eacb3; color: white;">@lang('admin.consignee_phone')</span>
                                    </div>
                                    <input type="text" name="consignee_phone" style="direction: ltr;border: 1px solid #2eacb3;" maxlength="9" class="form-control phone_num_util" value="{{ old('consignee_phone') }}" placeholder="e.g. +1 702 123 4567" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                                <div class="col-md-12 input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="background-color: #2eacb3; color: white;">@lang('admin.consignee_telephone')</span>
                                    </div>
                                    <input type="text" name="consignee_telephone" style="direction: ltr;border: 1px solid #2eacb3;" maxlength="9" class="form-control phone_num_util2" value="{{ old('consignee_telephone') }}" placeholder="e.g. +1 702 123 4567" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                                <div class="col-md-12 input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">@lang('admin.country')</span>
                                    </div>
                                    <p class="form-control">الامارات العربية المتحدة</p>
                                </div>
                                <div class="col-md-4 input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="background-color: #2eacb3; color: white;">@lang('admin.city')</span>
                                    </div>
                                    <select name="city_id" class="form-control" style="border: 1px solid #2eacb3;">
                                        <option value="">@lang('admin.choose_city')</option>
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city['name_'.App()->getLocale()] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="background-color: #2eacb3; color: white;">@lang('admin.state')</span>
                                    </div>
                                    <select name="state_id" class="form-control" style="border: 1px solid #2eacb3;">
                                        <option value="">@lang('admin.choose_state')</option>
                                    </select>
                                </div>
                                <div class="col-md-4 input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="background-color: #2eacb3; color: white;">@lang('admin.home_number')</span>
                                    </div>
                                    <input type="text" class="form-control" style="border: 1px solid #2eacb3;" name="home_number" value="{{ old('home_number') }}">
                                </div>
                                <div class="col-md-4 input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="background-color: #2eacb3; color: white;">@lang('admin.service')</span>
                                    </div>
                                    <select name="service_id" class="form-control" style="border: 1px solid #2eacb3;">
                                        <option value="0">@lang('admin.choose_service')</option>
                                        @foreach($services as $service)
                                            <option value="{{ $service->id }}">{{ $service['name_'.App()->getLocale()] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="service-details col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.service_cost')</span>
                                        </div>
                                        <p class="form-control">0</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="background-color: #2eacb3; color: white;">@lang('admin.order_price')</span>
                                        </div>
                                        <input type="number" name="order_price" style="border: 1px solid #2eacb3;" class="form-control" value="0">
                                    </div>
                                </div>
                                <div class="col-md-12 input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="background-color: #2eacb3; color: white;">@lang('admin.consignee_address')</span>
                                    </div>
                                    <input type="text" name="consignee_address" style="border: 1px solid #2eacb3;" class="form-control" value="{{ old('consignee_address') }}" placeholder="@lang('admin.consignee_address')" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                                <div class="col-md-4 input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="background-color: #2eacb3; color: white;">@lang('admin.package_number')</span>
                                    </div>
                                    <input type="number" name="package_number" style="border: 1px solid #2eacb3;" value="1" min="1" max="3" autocomplete="off" placeholder="@lang('admin.package_number')" class="form-control">
                                </div>
                                <div class="col-md-4 input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="background-color: #2eacb3; color: white;">@lang('admin.weight_in_kilo')</span>
                                    </div>
                                    <input type="number" name="weight_in_kilo" style="border: 1px solid #2eacb3;" value="5" min="5" autocomplete="off" placeholder="@lang('admin.weight_in_kilo')" class="form-control">
                                </div>
                                <div class="col-md-4 input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">@lang('admin.total_price')</span>
                                    </div>
                                    <p class="form-control total_price">0.00</p>
                                </div>
                                <div class="col-md-12 input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="background-color: #2eacb3; color: white;">@lang('admin.notes')</span>
                                    </div>
                                    <textarea name="notes" class="form-control" style="border: 1px solid #2eacb3;">{{ old('notes') }}</textarea>
                                </div>

                                {{--  /////////  --}}
                                <div class="col-md-6 card">
                                    <div class="pb-0 header">
                                        <h2>@lang('admin.other_notes')</h2>
                                    </div>
                                    <div class="pt-0 body">
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12">
                                                @foreach($deliveryNotes as $note)
                                                    <div class="fancy-checkbox">
                                                        <label><input name="delivery_notes[]" value="{{ $note->id }}" type="checkbox"><span>{{ $note['name_'.App()->getLocale()] }}</span></label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 card">
                                    <div class="pb-0 header">
                                        <h2>@lang('admin.delivery_amount_from')</h2>
                                    </div>
                                    <div class="pt-0 body">
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="fancy-radio">
                                                    <label><input name="delivery_amount_from" class="delivery_amount_from_first" value="1"  type="radio"><span><i></i>@lang('admin.sender_name')</span></label>
                                                    <label><input name="delivery_amount_from" class="delivery_amount_from_second" value="2"  type="radio" checked><span><i></i>@lang('admin.consignee_name')</span></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
{{--                                   <div class="col-md-4 card">--}}
{{--                                    <div class="pb-0 header">--}}
{{--                                        <h2>@lang('admin.receive_from')</h2>--}}
{{--                                    </div>--}}
{{--                                    <div class="pt-0 body">--}}
{{--                                        <hr>--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-lg-12 col-md-12">--}}
{{--                                                <div class="fancy-radio">--}}
{{--                                                    <label><input name="from_home_or_office" value="1"  type="radio"><span><i></i>@lang('admin.receive_from_office')</span></label>--}}
{{--                                                    <label><input name="from_home_or_office" value="2"  type="radio" checked=""><span><i></i>@lang('admin.receive_from_home')</span></label>--}}
{{--                                                    <select id="users" style="visibility: hidden" name="delegate_id" class="form-control">--}}
{{--                                                        <option value="">اختر موظف او مندوب</option>--}}
{{--                                                        @foreach($users as $user)--}}

{{--                                                            <option value="{{ $user->id }}">--}}
{{--                                                                @switch($user->type)--}}
{{--                                                                    @case($user->type == 3)--}}
{{--                                                                    {{ $user->profile->name_ar . '(الادارة)'}}--}}
{{--                                                                    @break--}}
{{--                                                                    @case($user->type == 1)--}}
{{--                                                                    {{ $user->profile->name_ar . ' (موظف)' }}--}}
{{--                                                                    @break--}}
{{--                                                                    @default--}}
{{--                                                                    {{ $user->profile->name_ar . ' (مندوب)' }}--}}
{{--                                                                @endswitch--}}
{{--                                                            </option>--}}

{{--                                                        @endforeach--}}
{{--                                                    </select>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                            </div>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('admin.add_new')</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="add_new_person" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('admin.add_new_person')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.name')</span>
                            </div>
                            <input type="text" name="name" class="form-control" placeholder="@lang('admin.name')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="col-md-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.cities')</span>
                            </div>
                            <select class="form-control" name="city_modal_id">
                                <option value="">@lang('admin.choose_city')</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city['name_'.App()->getLocale()] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.states')</span>
                            </div>
                            <select class="form-control" name="state_modal_id"></select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.address')</span>
                            </div>
                            <input type="text" name="address" class="form-control" placeholder="@lang('admin.address')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.person_email')</span>
                            </div>
                            <input type="email" name="email" class="form-control" placeholder="@lang('admin.email')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="col-md-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.person_phone')</span>
                            </div>
                            <input type="text" name="phone_number" class="form-control" placeholder="@lang('admin.phone_number')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.password')</span>
                            </div>
                            <input type="password" name="password" class="form-control" placeholder="@lang('admin.password')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="col-md-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.person_pass')</span>
                            </div>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="@lang('admin.password_confirmation')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary add_the_new_person">@lang('admin.add_new')</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('admin.close')</button>
                </div>
            </div>
        </div>
    </div>
{{--  //////////////////  --}}

@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" integrity="sha512-gxWow8Mo6q6pLa1XH/CcH8JyiSDEtiwJV78E+D+QP0EVasFs8wKXq16G8CLD4CJ2SnonHr4Lm/yY2fSI2+cbmw==" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="{{ url('dashboard/dist/jquery.datetimepicker.min.css') }}"/>
    <style>
        .iti--separate-dial-code {
            width: 60%;
        }
    </style>
@endpush

@push('js')
    @if(session()->has('success'))
        <script>
            toastr.success("{{ session()->get('success') }}","{{ __('admin.done') }}",{
                "positionClass": "toast-bottom-{{ App()->getLocale() == 'ar' ? 'left' : 'right' }}",
            });
        </script>
    @endif

    <script src="{{ url('dashboard/') }}/assets-rtl/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script> <!-- Bootstrap Colorpicker Js -->
    <script src="{{ url('dashboard/') }}/assets-rtl/vendor/jquery-inputmask/jquery.inputmask.bundle.js"></script> <!-- Input Mask Plugin Js -->
    <script src="{{ url('dashboard/') }}/assets-rtl/vendor/jquery.maskedinput/jquery.maskedinput.min.js"></script>
    <script src="{{ url('dashboard/') }}/assets-rtl/vendor/multi-select/js/jquery.multi-select.js"></script> <!-- Multi Select Plugin Js -->
    <script src="{{ url('dashboard/') }}/assets-rtl/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
    <script src="{{ url('dashboard/') }}/assets-rtl/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ url('dashboard/') }}/assets-rtl/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script> <!-- Bootstrap Tags Input Plugin Js -->
    <script src="{{ url('dashboard/') }}/assets-rtl/vendor/nouislider/nouislider.js"></script> <!-- noUISlider Plugin Js -->
    <script src="{{ url('dashboard/') }}/assets-rtl/bundles/mainscripts.bundle.js"></script>
    <script src="{{ url('dashboard/') }}/assets-rtl/js/pages/forms/advanced-form-elements.js"></script>
    <script src="{{ url('dashboard/dist/jquery.datetimepicker.full.min.js') }}"></script>
    <script>
    $(document).ready(function(){
        $('.check').click(function() {
            $('.check').not(this).prop('checked', false);
        });
});

        $(document).on('change','input[name=from_home_or_office]',function(){
            if ($(this).val() == 1) {
                $("#users").css("visibility", "visible");
            } else {
                $("#users").css("visibility", "hidden");
                $("#users").firstChild.attr("selected","selected");
            }
        });

        // $('.phone').mask('(999) 999-9999');

        $(document).on('change','select[name=sender_type_id]',function (){
            let type_id = $(this).val();
                $.ajax({
                    url: "{{ route('dashboard.deliveries.users.index') }}",
                    method: "post",
                    data: {_token: "{{ csrf_token() }}",type_id:type_id},
                    success: function (data) {
                        let users = [`<option>@lang('admin.choose_sender')</option>`];
                        data.users.forEach(function (user){
                            users += `<option value="${user.user_id}">${type_id == 1 ? user.name : user.shop_name_ar}</option>`;
                        });
                        $('.sender_type_fields').html('');
                        if (type_id == 1)
                        {
                            $('.sender_type_fields').append(`
                                <div class="row">
                                    <div class="col-md-11 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.sender_name')</span>
                                        </div>
                                        <select class="form-control" name="user_id">
                                        ${users}
                                        </select>
                                    </div>
                                    <div class="col-md-1"><button type="button" data-toggle="modal" data-target="#add_new_person" class="btn btn-success"><i class="fa fa-plus"></i></button></div>
                                </div>
                            `);
                        } else {
                            $('.sender_type_fields').append(`
                                <div class="row">
                                    <div class="col-md-12 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.shop_name_ar')</span>
                                        </div>
                                        <select class="form-control" name="user_id">
                                        ${users}
                                        </select>
                                    </div>
                                </div>
                            `);
                        }
                    }
                });
        });

        $(document).on('change','select[name=city_modal_id]',function () {
            $.ajax({
                url : "{{ route('dashboard.users.related.city-states') }}",
                data : {city_id: $(this).val(),_token: '{{ csrf_token() }}'},
                method: "post",
                success: function (data) {
                    $("select[name=state_modal_id]").html("");
                    $("select[name=state_modal_id]").append(`<option value="">@lang('admin.choose_state')</option>`);
                    data.forEach(function (state){
                        $("select[name=state_modal_id]").append(`<option value="${state.id}">${state.name}</option>`);
                    });
                }
            });
        });

        $(document).on('change','select[name=city_id]',function () {
            $.ajax({
                url : "{{ route('dashboard.users.related.city-states') }}",
                data : {city_id: $(this).val(),_token: '{{ csrf_token() }}'},
                method: "post",
                success: function (data) {
                    $("select[name=state_id]").html("");
                    $("select[name=state_id]").append(`<option value="">@lang('admin.choose_state')</option>`);
                    data.forEach(function (state){
                        $("select[name=state_id]").append(`<option value="${state.id}">${state.name}</option>`);
                    });
                }
            });
        });

        $(document).on('click','.add_the_new_person',function (){
            let type_id = 4;
            let country_id = '{{ request('country_id') }}';
            let name = $('input[name=name]').val();
            let city_id = $('select[name=city_modal_id]').val();
            let state_id = $('select[name=state_modal_id]').val();
            let address = $('input[name=address]').val();
            let email = $('input[name=email]').val();
            let phone_number = $('input[name=phone_number]').val();
            let password = $('input[name=password]').val();
            let password_confirmation = $('input[name=password_confirmation]').val();

            $.ajax({
                url: "{{ route('dashboard.users.add-new-person') }}",
                method: "post",
                data: {
                    _token: '{{ csrf_token() }}',type: type_id,
                    name:name,country_id: country_id,
                    city_id: city_id,state_id: state_id,
                    address: address,email: email,
                    phone_number: phone_number,password: password,
                    password_confirmation:password_confirmation
                },
                success: function (data){
                    toastr.success("{{ session()->get('success') }}","تمت اضافة فرد جديد بنجاح",{
                        "positionClass": "toast-top-{{ App()->getLocale() == 'ar' ? 'left' : 'right' }}",
                    });
                    $('select[name=user_id]').append(`<option selected value="${data.user_id}">${data.name}</option>`);
                    $('#add_new_person').modal('hide');

                },
                error: function (){
                    toastr.error("{{ session()->get('success') }}","خطأ في البيانات المدخلة",{
                        "positionClass": "toast-top-{{ App()->getLocale() == 'ar' ? 'left' : 'right' }}",
                    });
                }
            });
        });

        $(document).on('change','select[name=state_id]',function (){
            $('select[name=service_id]').val(0);
        });

        $(document).on('change','select[name=service_id]',function (){
            let service_id = $(this).val();
            let city_id = $('select[name=city_id]').val();
            let state_id = $('select[name=state_id]').val();
            $.ajax({
                url: "{{ route('dashboard.deliveries.service.get') }}",
                method: "post",
                data: { _token: "{{ csrf_token() }}",service_id:service_id,city_id:city_id,state_id:state_id },
                success: function(data) {
                    if (data.id !=  undefined) {
                        $('.service-details').html('');
                        $('.service-details').append(`
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.service_cost')</span>
                            </div>
                            <p class="form-control">${data.cost}</p>
                            <input type="hidden" name="real_service_cost" value="${data.cost}">
                        </div>
                    `);

                        let package_number = $('input[name=package_number]').val();
                        let weight_number = $('input[name=weight_in_kilo]').val();
                        let packageTotalPrice = packagePercentageTotal(package_number);
                        let weightTotalPrice = weightPercentageTotal(weight_number);
                        let orderTotalPrice = $('input[name=order_price]').val();
                        $('.total_price').text(parseFloat(packageTotalPrice) + parseFloat(weightTotalPrice) + parseFloat(orderTotalPrice));
                    } else{
                        toastr.error("{{ session()->get('success') }}","اختر المدينة والمنطقة اولا",{
                            "positionClass": "toast-top-{{ App()->getLocale() == 'ar' ? 'left' : 'right' }}",
                        });
                    }

                },
                error: function () {
                    toastr.error("{{ session()->get('success') }}","اختر المدينة والمنطقة اولا",{
                        "positionClass": "toast-top-{{ App()->getLocale() == 'ar' ? 'left' : 'right' }}",
                    });
                }
            });
        });

        $(document).on('change','select[name=user_id]',function (){
            let user_id = $(this).val();
            $.ajax({
                url: "{{ route('dashboard.deliveries.user.details') }}",
                method: "post",
                data: {_token:'{{ csrf_token() }}',user_id: user_id},
                success : function (data) {
                    $('.user_details').html('');
                    if (data.user.type == 4) {
                        $('.user_details').append(`
                        <div class="row">
                            <div class="col-md-4 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.sender_country')</span>
                                </div>
                                <p class="form-control">${data.profile.country.name_ar}</p>
                            </div>
                            <div class="col-md-4 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.sender_city')</span>
                                </div>
                                <p class="form-control">${data.profile.city.name_ar}</p>
                            </div>
                            <div class="col-md-4 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.sender_state')</span>
                                </div>
                                <p class="form-control">${data.profile.state.name_ar}</p>
                            </div>
                            <div class="col-md-12 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.sender_address')</span>
                                </div>
                                <p class="form-control">${data.profile.address}</p>
                            </div>
                            <div class="col-md-6 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.sender_email')</span>
                                </div>
                                <p class="form-control">${data.user.email}</p>
                            </div>
                            <div class="col-md-6 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.sender_phone')</span>
                                </div>
                                <p class="form-control">${data.user.phone}</p>
                            </div>
                        </div>
                    `);
                    } else if (data.user.type == 3) {
                        $('.user_details').append(`
                        <div class="row">
                            <div class="col-md-6 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.shop_logo')</span>
                                </div>
                                <img src="{{ url('dashboard/uploads/users/') }}/${data.profile.shop_photo}" style="width: 200px;height: 100px" />
                            </div>

                            <div class="col-md-6 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.sender_address')</span>
                                </div>
                                <p class="form-control" style="height: 100px;">${data.profile.address}</p>
                            </div>
                            <div class="col-md-4 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.sender_country')</span>
                                </div>
                                <p class="form-control">${data.profile.country.name_ar}</p>
                            </div>
                            <div class="col-md-4 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.sender_city')</span>
                                </div>
                                <p class="form-control">${data.profile.city.name_ar}</p>
                            </div>
                            <div class="col-md-4 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.state')</span>
                                </div>
                                <p class="form-control">${data.profile.state.name_ar}</p>
                            </div>
                            <div class="col-md-12 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.shop_owner_name')</span>
                                </div>
                                <p class="form-control">${data.profile.shop_owner_name}</p>
                            </div>
                            <div class="col-md-6 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.shop_name_ar')</span>
                                </div>
                                <p class="form-control">${data.profile.shop_name_ar}</p>
                            </div>
                            <div class="col-md-6 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.shop_name_en')</span>
                                </div>
                                <p class="form-control">${data.profile.shop_name_en}</p>
                            </div>
                            <div class="col-md-6 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.sender_email')</span>
                                </div>
                                <p class="form-control">${data.user.email}</p>
                            </div>
                            <div class="col-md-6 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.sender_phone')</span>
                                </div>
                                <p class="form-control">${data.user.phone}</p>
                            </div>
                        </div>
                    `);
                    }
                }
            });
        });

        $(document).on('keyup','input[name=package_number]',function () {
            let package_number = $(this).val();
            let weight_number = $('input[name=weight_in_kilo]').val();
            let packageTotalPrice = packagePercentageTotal(package_number);
            let weightTotalPrice = weightPercentageTotal(weight_number);
            let orderTotalPrice = $('input[name=order_price]').val();
            $('.total_price').text(parseFloat(packageTotalPrice) + parseFloat(weightTotalPrice) + parseFloat(orderTotalPrice));
        });

        $(document).on('keyup','input[name=weight_in_kilo]',function () {
            let weight_number = $(this).val();
            let package_number = $('input[name=package_number]').val();
            let packageTotalPrice = packagePercentageTotal(package_number);
            let weightTotalPrice = weightPercentageTotal(weight_number);
            let orderTotalPrice = $('input[name=order_price]').val();
            $('.total_price').text(parseFloat(packageTotalPrice) + parseFloat(weightTotalPrice) + parseFloat(orderTotalPrice));
        });

        $(document).on('keyup','input[name=order_price]',function (){
            let weight_number = $('input[name=weight_in_kilo]').val();
            let package_number = $('input[name=package_number]').val();
            let packageTotalPrice = packagePercentageTotal(package_number);
            let weightTotalPrice = weightPercentageTotal(weight_number);
            let orderTotalPrice = $(this).val();

            $('.total_price').text(parseFloat(packageTotalPrice) + parseFloat(weightTotalPrice) + parseFloat(orderTotalPrice));
        });

        function weightPercentageTotal(weight)
        {
            let total = $('input[name=real_service_cost]').val();
            let percentageOfIncrease = weight - 5;
            if(weight > 5) {
                return parseFloat(total) + parseFloat(percentageOfIncrease);
            }
            return parseFloat(total);
        }

        function packagePercentageTotal(package_number)
        {
            if (package_number > 1) {
                let package_quantity_no_free = package_number - 1;
                return package_quantity_no_free * 3;
            }
            return 0;
        }

        $(document).on('click','input[name=delivery_amount_from]',function() {
            let package_number = $('input[name=package_number]').val();
                let weight_number = $('input[name=weight_in_kilo]').val();
                let packageTotalPrice = packagePercentageTotal(package_number);
                let weightTotalPrice = weightPercentageTotal(weight_number);
                let orderTotalPrice = $('input[name=order_price]').val();
            if($(this).val() == 2) {
                $('.total_price').text(parseFloat(packageTotalPrice) + parseFloat(weightTotalPrice) + parseFloat(orderTotalPrice));
            } else {
                // $('.total_price').text(parseFloat(packageTotalPrice) + parseFloat(weightTotalPrice));
                $('.total_price').text(parseFloat(orderTotalPrice));

            }
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.js" integrity="sha512-s/q7apy90iY/BCy3HnkSxOxqO30Sto5LnhQorz/ce4O/oBxDi1dKluM6C/SYy1AJ9+6MJfXnQl4mHVmrSYfujQ==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
    var consignee_phone = document.querySelector(".phone_num_util");
    var consignee_telephone = document.querySelector(".phone_num_util2");
    window.intlTelInput(consignee_phone, {
        hiddenInput: "consignee_phone",
        initialCountry: "ae",
        separateDialCode: true,
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });
    window.intlTelInput(consignee_telephone, {
        hiddenInput: "consignee_telephone",
        initialCountry: "ae",
        separateDialCode: true,
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });
    $('input[name=received_date]').datetimepicker();
    // form send
    $(document).on('submit','form',function (e) {
        e.preventDefault();
        let data = $(this).serialize();
        $.ajax({
            url: '{{ route("dashboard.deliveries.store") }}',
            method: 'post',
            data : data,
            beforeSend: function(){
                Swal.fire({
                    title: 'انتظر قليلا',
                    html: 'يتم تحميل البيانات',// add html attribute if you want or remove
                    showCancelButton: false,
                    showCloseButton: false,
                    didOpen: () => {
                        Swal.showLoading()
                    },
                    allowOutsideClick: false,
                });
            },
            complete: function(){
                Swal.close();
            },
            success: function (data) {
                if(data.status == 0)
                {
                    let errors = "";
                    data.errors.forEach(function (error) {
                       errors += `<li>${error}</li>`;
                    });

                    $('.show-validate').html(`
                        <div class="alert alert-danger">
                            <ul style="list-style-type: none">
                                ${errors}
                            </ul>
                        </div>
                    `);
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                } else {
                    Swal.fire(
                        'تمت الاضافة بنجاح',
                        'جاري تحويلك ...',
                        'success'
                    )
                    setTimeout(() => {
                        window.location.href = '{{ route("dashboard.deliveries.index") }}?status=1';
                    }, 1000);
                }
            },
        });
    });

    $(document).on('keypress','input[name=consignee_phone]',function(e){
        let val = $(this).val();
        let reg = /^0/gi;
        if (val.match(reg)) {
            $(this).val(val.replace(reg, ''));
        }
    });
    $(document).on('keypress','input[name=consignee_telephone]',function(e){
        let val = $(this).val();
        let reg = /^0/gi;
        if (val.match(reg)) {
            $(this).val(val.replace(reg, ''));
        }
    });
    </script>
@endpush
