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
                    <li class="breadcrumb-item active">@lang('admin.edit_element')</li>
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
                    <h2> @lang('admin.edit_element')</h2>
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
                    <form action="{{ route('dashboard.'. $model .'.update',$row->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <input type="hidden" name="type" value="{{ $row->type }}">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.type')</span>
                            </div>
                            <select required disabled class="form-control">
                                <option value="">@lang('admin.type')</option>
                                <option {{ $row->type == 1 ? 'selected' : '' }} value="1">@lang('admin.delivery_employees')</option>
                                <option {{ $row->type == 2 ? 'selected' : '' }} value="2">@lang('admin.delivery_representatives')</option>
                                <option {{ $row->type == 3 ? 'selected' : '' }} value="3">@lang('admin.companies')</option>
                                <option {{ $row->type == 4 ? 'selected' : '' }} value="4">@lang('admin.individuals')</option>
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
                                        <option {{ $row->profile->country_id == $country->id ? 'selected' : '' }} value="{{ $country->id }}">{{ $country['name_'.App()->getLocale()] }}</option>
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
                            @if($row->type == 1 || $row->type == 2)
                                <div class="row">
                                    <div class="col-md-6 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.name_ar')</span>
                                        </div>
                                        <input required type="text" value="{{ $row->profile->name_ar }}" name="name_ar" class="form-control" placeholder="@lang('admin.name_ar')" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="col-md-6 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.name_en')</span>
                                        </div>
                                        <input required type="text" value="{{ $row->profile->name_en }}" name="name_en" class="form-control" placeholder="@lang('admin.name_en')" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.started_job_at')</span>
                                        </div>
                                        <input required type="date" value="{{ $row->profile->started_job_at }}" name="started_job_at" class="form-control" placeholder="@lang('admin.started_job_at')" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="col-md-4 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.drive_license_number')</span>
                                        </div>
                                        <input required type="number" value="{{ $row->profile->drive_license_number }}" name="drive_license_number" class="form-control" placeholder="@lang('admin.drive_license_number')" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="col-md-4 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.drive_license_end_at')</span>
                                        </div>
                                        <input required type="date" value="{{ $row->profile->drive_license_end_at }}" name="drive_license_end_at" class="form-control" placeholder="@lang('admin.drive_license_end_at')" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.drive_license_photo')</span>
                                        </div>
                                        <input type="file" name="drive_license_photo" class="form-control" placeholder="@lang('admin.drive_license_photo')" aria-label="Username" aria-describedby="basic-addon1">
                                        <img src="" alt="">
                                    </div>
                                    <div class="col-md-6 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.phone_number')</span>
                                        </div>
                                        <input required type="text" value="{{ $row->phone }}" name="phone_number" class="form-control" placeholder="@lang('admin.phone_number')" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">@lang('admin.email')</span>
                                    </div>
                                    <input required type="text" value="{{ $row->email }}" name="email" class="form-control" placeholder="@lang('admin.email')" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">@lang('admin.national_license_number')</span>
                                    </div>
                                    <input required type="text" value="{{ $row->profile->national_license_number }}" name="national_license_number" class="form-control" placeholder="@lang('admin.national_license_number')" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                                <div class="row">
                                    <div class="col-md-6 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.national_license_end_at')</span>
                                        </div>
                                        <input required type="date" value="{{ $row->profile->national_license_end_at }}" name="national_license_end_at" class="form-control" placeholder="@lang('admin.national_license_end_at')" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="col-md-6 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.national_license_photo')</span>
                                        </div>
                                        <input type="file" name="national_license_photo" class="form-control" placeholder="@lang('admin.national_license_photo')" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.passport_number')</span>
                                        </div>
                                        <input required type="text" value="{{ $row->profile->passport_number }}" name="passport_number" class="form-control" placeholder="@lang('admin.passport_number')" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="col-md-4 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.passport_photo')</span>
                                        </div>
                                        <input type="file" name="passport_photo" class="form-control" placeholder="@lang('admin.passport_photo')" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="col-md-4 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.passport_end_at')</span>
                                        </div>
                                        <input required type="date" value="{{ $row->profile->passport_end_at }}" name="passport_end_at" class="form-control" placeholder="@lang('admin.passport_end_at')" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.residence_end_at')</span>
                                        </div>
                                        <input required type="date" value="{{ $row->profile->residence_end_at }}"  name="residence_end_at" class="form-control" placeholder="@lang('admin.residence_end_at')" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="col-md-6 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.residence_photo')</span>
                                        </div>
                                        <input type="file" name="residence_photo" class="form-control" placeholder="@lang('admin.residence_photo')" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.delivery_commission')</span>
                                        </div>
                                        <input required type="text" value="{{ $row->profile->delivery_commission }}" name="delivery_commission" class="form-control" placeholder="@lang('admin.delivery_commission')" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="col-md-6 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.receiving_commission')</span>
                                        </div>
                                        <input required type="text" value="{{ $row->profile->receiving_commission }}" name="receiving_commission" class="form-control" placeholder="@lang('admin.receiving_commission')" aria-label="Username" aria-describedby="basic-addon1">
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
                            @elseif($row->type == 3)
                                <div class="row">
                                    <div class="col-md-6 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.shop_name_ar')</span>
                                        </div>
                                        <input required type="text" value="{{ $row->profile->shop_name_ar }}" name="shop_name_ar" class="form-control" placeholder="@lang('admin.shop_name_ar')" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="col-md-6 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.shop_name_en')</span>
                                        </div>
                                        <input required type="text" value="{{ $row->profile->shop_name_en }}" name="shop_name_en" class="form-control" placeholder="@lang('admin.shop_name_en')" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.shop_owner_name')</span>
                                        </div>
                                        <input required type="text" value="{{ $row->profile->shop_owner_name }}" name="shop_owner_name" class="form-control" placeholder="@lang('admin.shop_owner_name')" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="col-md-4 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.shop_photo')</span>
                                        </div>
                                        <input type="file" name="shop_photo" class="form-control" placeholder="@lang('admin.shop_photo')" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="col-md-4 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.contract_type')</span>
                                        </div>
                                        <select required class="form-control" name="contract_type">
                                            <option value="">@lang('admin.contract_type')</option>
                                            <option {{ $row->profile->contract_type == 1 ? 'selected' : '' }} value="1">@lang('admin.normal_contract')</option>
                                            <option {{ $row->profile->contract_type == 2 ? 'selected' : '' }} value="2">@lang('admin.discount_for_all_percent')</option>
                                            <option {{ $row->profile->contract_type == 3 ? 'selected' : '' }} value="3">@lang('admin.commission_on_order_worth')</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.cities')</span>
                                        </div>
                                        <select required class="form-control" name="city_id">
                                            @foreach($cities as $city)
                                                <option {{ $row->profile->city_id == $city->id ? 'selected' : '' }} value="{{ $city->id }}">{{ $city['name_'.App()->getLocale()] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.states')</span>
                                        </div>
                                        <select required class="form-control" name="state_id">
                                            @foreach($states as $state)
                                                <option {{ $row->profile->state_id == $state->id ? 'selected' : '' }} value="{{ $state->id }}">{{ $state['name_'.App()->getLocale()] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.contract_start_at')</span>
                                        </div>
                                        <input required type="date" value="{{ $row->profile->contract_start_at }}" name="contract_start_at" class="form-control" placeholder="@lang('admin.contract_start_at')" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="col-md-6 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.address')</span>
                                        </div>
                                        <input required value="{{ $row->profile->address }}" type="text" name="address" class="form-control" placeholder="@lang('admin.address')" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.email')</span>
                                        </div>
                                        <input type="email" value="{{ $row->email }}" name="email" class="form-control" placeholder="@lang('admin.email')" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="col-md-6 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.phone_number')</span>
                                        </div>
                                        <input required type="text" value="{{ $row->phone }}" name="phone_number" class="form-control" placeholder="@lang('admin.phone_number')" aria-label="Username" aria-describedby="basic-addon1">
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
                            @elseif($row->type == 4)
                                <div class="row">
                                    <div class="col-md-4 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.name')</span>
                                        </div>
                                        <input required type="text" value="{{ $row->profile->name }}" name="name" class="form-control" placeholder="@lang('admin.name')" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="col-md-4 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.cities')</span>
                                        </div>
                                        <select required class="form-control" name="city_id">
                                            @foreach($cities as $city)
                                                <option {{ $row->profile->city_id == $city->id ? 'selected' : '' }} value="{{ $city->id }}">{{ $city['name_'.App()->getLocale()] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.states')</span>
                                        </div>
                                        <select required class="form-control" name="state_id">
                                            @foreach($states as $state)
                                                <option {{ $row->profile->state_id == $state->id ? 'selected' : '' }} value="{{ $state->id }}">{{ $state['name_'.App()->getLocale()] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.address')</span>
                                        </div>
                                        <input type="text" value="{{ $row->profile->address }}" name="address" class="form-control" placeholder="@lang('admin.address')" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.email')</span>
                                        </div>
                                        <input type="email" value="{{ $row->email }}" name="email" class="form-control" placeholder="@lang('admin.email')" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="col-md-6 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.phone_number')</span>
                                        </div>
                                        <input type="text" value="{{ $row->phone }}" name="phone_number" class="form-control" placeholder="@lang('admin.phone_number')" aria-label="Username" aria-describedby="basic-addon1">
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
                            @endif
                            <div class="row">
                                <div class="col-md-12 input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">@lang('admin.status')</span>
                                    </div>
                                    <select name="status" class="form-control">
                                        <option {{ $row->status == 1 ? 'selected' : '' }} value="1">@lang('admin.active')</option>
                                        <option {{ $row->status == 0 ? 'selected' : '' }} value="0">@lang('admin.deactive')</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('admin.edit_element')</button>

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
