@extends('dashboard.layouts.app')

@section('content')
    @php $model = 'users'; @endphp
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
                    <h2> @lang('admin.add_new')</h2>
                </div>
                <div class="body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul style="list-style-type: none">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('dashboard.'. $model .'.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.type')</span>
                            </div>
                            <select required name="type" class="form-control">
                                <option value="">@lang('admin.type')</option>
                                <option value="1">@lang('admin.delivery_employees')</option>
                                <option value="2">@lang('admin.delivery_representatives')</option>
                                <option value="3">@lang('admin.companies')</option>
                                <option value="4">@lang('admin.individuals')</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.nationality')</span>
                                </div>
                                <select required name="country_id" class="form-control">
                                    <option value="">@lang('admin.choose_country')</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country['name_'.App()->getLocale()] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.personal_photo')</span>
                                </div>
                                <input type="file" name="personal_photo" class="form-control" placeholder="@lang('admin.photo')" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="create-user-form">

                        </div>

                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('admin.add_new')</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')

@endpush

@push('js')
    @if(session()->has('success'))
        <script>
            toastr.success("{{ session()->get('success') }}","{{ __('admin.done') }}",{
                "positionClass": "toast-bottom-{{ App()->getLocale() == 'ar' ? 'left' : 'right' }}",
            });
        </script>
    @endif

    <script>
        $('select[name=type]').on('change',function (){
            $('.create-user-form').html('');
            if ($(this).val() == 1 || $(this).val() == 2) {
                $('.create-user-form').append(`
                    <div class="row">
                        <div class="col-md-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.name_ar')</span>
                            </div>
                            <input required type="text" name="name_ar" class="form-control" placeholder="@lang('admin.name_ar')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="col-md-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.name_en')</span>
                            </div>
                            <input required type="text" name="name_en" class="form-control" placeholder="@lang('admin.name_en')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.started_job_at')</span>
                            </div>
                            <input required type="date" name="started_job_at" class="form-control" placeholder="@lang('admin.started_job_at')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="col-md-4 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.drive_license_number')</span>
                            </div>
                            <input required type="number" name="drive_license_number" class="form-control" placeholder="@lang('admin.drive_license_number')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="col-md-4 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.drive_license_end_at')</span>
                            </div>
                            <input required type="date" name="drive_license_end_at" class="form-control" placeholder="@lang('admin.drive_license_end_at')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.drive_license_photo')</span>
                            </div>
                            <input required type="file" name="drive_license_photo" class="form-control" placeholder="@lang('admin.drive_license_photo')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="col-md-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.phone_number')</span>
                            </div>
                            <input required type="text" name="phone_number" class="form-control" placeholder="@lang('admin.phone_number')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@lang('admin.email')</span>
                        </div>
                        <input required type="text" name="email" class="form-control" placeholder="@lang('admin.email')" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@lang('admin.national_license_number')</span>
                        </div>
                        <input required type="text" name="national_license_number" class="form-control" placeholder="@lang('admin.national_license_number')" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="row">
                        <div class="col-md-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.national_license_end_at')</span>
                            </div>
                            <input required type="date" name="national_license_end_at" class="form-control" placeholder="@lang('admin.national_license_end_at')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="col-md-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.national_license_photo')</span>
                            </div>
                            <input required type="file" name="national_license_photo" class="form-control" placeholder="@lang('admin.national_license_photo')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.passport_number')</span>
                            </div>
                            <input required type="text" name="passport_number" class="form-control" placeholder="@lang('admin.passport_number')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="col-md-4 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.passport_photo')</span>
                            </div>
                            <input required type="file" name="passport_photo" class="form-control" placeholder="@lang('admin.passport_photo')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="col-md-4 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.passport_end_at')</span>
                            </div>
                            <input required type="date" name="passport_end_at" class="form-control" placeholder="@lang('admin.passport_end_at')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.residence_end_at')</span>
                            </div>
                            <input required type="date" name="residence_end_at" class="form-control" placeholder="@lang('admin.residence_end_at')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="col-md-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.residence_photo')</span>
                            </div>
                            <input required type="file" name="residence_photo" class="form-control" placeholder="@lang('admin.residence_photo')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.delivery_commission')</span>
                            </div>
                            <input required type="text" name="delivery_commission" class="form-control" placeholder="@lang('admin.delivery_commission')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="col-md-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.receiving_commission')</span>
                            </div>
                            <input required type="text" name="receiving_commission" class="form-control" placeholder="@lang('admin.receiving_commission')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.password')</span>
                            </div>
                            <input required type="password" name="password" class="form-control" placeholder="@lang('admin.password')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="col-md-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.password_confirmation')</span>
                            </div>
                            <input required type="password" name="password_confirmation" class="form-control" placeholder="@lang('admin.password_confirmation')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                `);
            } else if ($(this).val() == 3) {
                $('.create-user-form').append(`
                    <div class="row">
                        <div class="col-md-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.shop_name_ar')</span>
                            </div>
                            <input required type="text" old="{{ old('shop_name_ar') }}" name="shop_name_ar" class="form-control" placeholder="@lang('admin.shop_name_ar')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="col-md-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.shop_name_en')</span>
                            </div>
                            <input required type="text" old="{{ old('shop_name_en') }}" name="shop_name_en" class="form-control" placeholder="@lang('admin.shop_name_en')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.shop_owner_name')</span>
                            </div>
                            <input required type="text" old="{{ old('shop_owner_name') }}" name="shop_owner_name" class="form-control" placeholder="@lang('admin.shop_owner_name')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="col-md-4 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.shop_photo')</span>
                            </div>
                            <input required type="file" name="shop_photo" class="form-control" placeholder="@lang('admin.shop_photo')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="col-md-4 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.contract_type')</span>
                            </div>
                            <select required class="form-control" name="contract_type">
                                <option value="">@lang('admin.contract_type')</option>
                                <option value="1">@lang('admin.normal_contract')</option>
                                <option value="2">@lang('admin.discount_for_all_percent')</option>
                                <option value="3">@lang('admin.commission_on_order_worth')</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.cities')</span>
                            </div>
                            <select required class="form-control" name="city_id"></select>
                        </div>
                        <div class="col-md-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.states')</span>
                            </div>
                            <select required class="form-control" name="state_id"></select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.contract_start_at')</span>
                            </div>
                            <input required type="date" old="{{ old('contract_start_at') }}" name="contract_start_at" class="form-control" placeholder="@lang('admin.contract_start_at')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="col-md-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.address')</span>
                            </div>
                            <input required old="{{ old('address') }}" type="text" name="address" class="form-control" placeholder="@lang('admin.address')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.email')</span>
                            </div>
                            <input type="email" old="{{ old('email') }}" name="email" class="form-control" placeholder="@lang('admin.email')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="col-md-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.phone_number')</span>
                            </div>
                            <input required type="text" old="{{ old('phone_number') }}" name="phone_number" class="form-control" placeholder="@lang('admin.phone_number')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.password')</span>
                            </div>
                            <input required type="password" name="password" class="form-control" placeholder="@lang('admin.password')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="col-md-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.password_confirmation')</span>
                            </div>
                            <input required type="password" name="password_confirmation" class="form-control" placeholder="@lang('admin.password_confirmation')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                `);
            } else if ($(this).val() == 4) {
                $('.create-user-form').append(`
                    <div class="row">
                        <div class="col-md-4 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.name')</span>
                            </div>
                            <input required type="text" name="name" class="form-control" placeholder="@lang('admin.name')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="col-md-4 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.cities')</span>
                            </div>
                            <select class="form-control" name="city_id"></select>
                        </div>
                        <div class="col-md-4 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.states')</span>
                            </div>
                            <select class="form-control" name="state_id"></select>
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
                                <span class="input-group-text">@lang('admin.email')</span>
                            </div>
                            <input type="email" name="email" class="form-control" placeholder="@lang('admin.email')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="col-md-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.phone_number')</span>
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
                                <span class="input-group-text">@lang('admin.password_confirmation')</span>
                            </div>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="@lang('admin.password_confirmation')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                `);
            }
        });

            $("select[name=country_id]").on('change',function () {
                $.ajax({
                    url : "{{ route('dashboard.users.related.country-cities') }}",
                    data : {country_id: $(this).val(),_token: '{{ csrf_token() }}'},
                    method: "post",
                    success: function (data) {
                        $("select[name=city_id]").html("");
                        $("select[name=city_id]").append(`<option value="">@lang('admin.choose_city')</option>`);
                        data.forEach(function (city){
                            $("select[name=city_id]").append(`<option value="${city.id}">${city.name}</option>`);
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
    </script>
@endpush
