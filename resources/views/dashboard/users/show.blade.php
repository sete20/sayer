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
                    <li class="breadcrumb-item active">@lang('admin.show')</li>
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
                    <h2> @lang('admin.show')</h2>
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
                        <div class="create-user-form">
                            @if($row->type == 1 || $row->type == 2)
                                <div class="row">
                                    <div class="col-md-6 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.name_ar')</span>
                                        </div>
                                        <p class="form-control">{{ $row->profile->name_ar }}</p>
                                    </div>
                                    <div class="col-md-6 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.name_en')</span>
                                        </div>
                                        <p class="form-control">{{ $row->profile->name_en }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.started_job_at')</span>
                                        </div>
                                        <p class="form-control">{{ $row->profile->started_job_at }}</p>
                                    </div>
                                    <div class="col-md-4 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.drive_license_number')</span>
                                        </div>
                                        <p class="form-control">{{ $row->profile->drive_license_number }}</p>
                                    </div>
                                    <div class="col-md-4 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.drive_license_end_at')</span>
                                        </div>
                                        <p class="form-control">{{ $row->profile->drive_license_end_at }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.phone_number')</span>
                                        </div>
                                        <p class="form-control">{{ $row->phone }}</p>
                                    </div>
                                    <div class="col-md-4 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.passport_number')</span>
                                        </div>
                                        <p class="form-control">{{ $row->profile->passport_number }}</p>
                                    </div>
                                    <div class="col-md-4 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.passport_end_at')</span>
                                        </div>
                                        <p class="form-control">{{ $row->profile->passport_end_at }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.email')</span>
                                        </div>
                                        <p class="form-control">{{ $row->email }}</p>
                                    </div>
                                    <div class="col-md-6 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.national_license_number')</span>
                                        </div>
                                        <p class="form-control">{{ $row->profile->national_license_number }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.national_license_end_at')</span>
                                        </div>
                                        <p class="form-control">{{ $row->profile->national_license_end_at }}</p>
                                    </div>
                                    <div class="col-md-6 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.residence_end_at')</span>
                                        </div>
                                        <p class="form-control">{{ $row->profile->residence_end_at }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.delivery_commission')</span>
                                        </div>
                                        <p class="form-control">{{ $row->profile->delivery_commission }}</p>
                                    </div>
                                    <div class="col-md-6 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.receiving_commission')</span>
                                        </div>
                                        <p class="form-control">{{ $row->profile->receiving_commission }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 input-group mb-3">
                                        <a href="{{ url('dashboard/uploads/users/'.$row->profile->drive_license_photo) }}" target="_blank" class="btn btn-default">@lang('admin.drive_license_photo')</a>
                                    </div>
                                    <div class="col-md-3 input-group mb-3">
                                        <a href="{{ url('dashboard/uploads/users/'.$row->profile->passport_photo) }}" target="_blank" class="btn btn-warning">@lang('admin.passport_photo')</a>
                                    </div>
                                    <div class="col-md-3 input-group mb-3">
                                        <a href="{{ url('dashboard/uploads/users/'.$row->profile->national_license_photo) }}" target="_blank" class="btn btn-default">@lang('admin.national_license_photo')</a>
                                    </div>
                                    <div class="col-md-3 input-group mb-3">
                                        <a href="{{ url('dashboard/uploads/users/'.$row->profile->personal_photo) }}" target="_blank" class="btn btn-warning">@lang('admin.personal_photo')</a>
                                    </div>
                                </div>
                            @elseif($row->type == 3)
                                <div class="row">
                                    <div class="col-md-6 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.shop_name_ar')</span>
                                        </div>
                                        <p class="form-control">{{ $row->profile->shop_name_ar }}</p>
                                    </div>
                                    <div class="col-md-6 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.shop_name_en')</span>
                                        </div>
                                        <p class="form-control">{{ $row->profile->shop_name_en }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.shop_owner_name')</span>
                                        </div>
                                        <p class="form-control">{{ $row->profile->shop_owner_name }}</p>
                                    </div>
                                    <div class="col-md-6 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.contract_type')</span>
                                        </div>
                                        <select required class="form-control" name="contract_type">
                                            <option value="" disabled>@lang('admin.contract_type')</option>
                                            <option {{ $row->profile->contract_type == 1 ? 'selected' : 'disabled' }} value="1">@lang('admin.normal_contract')</option>
                                            <option {{ $row->profile->contract_type == 2 ? 'selected' : 'disabled' }} value="2">@lang('admin.discount_for_all_percent')</option>
                                            <option {{ $row->profile->contract_type == 3 ? 'selected' : 'disabled' }} value="3">@lang('admin.commission_on_order_worth')</option>
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
                                                <option {{ $row->profile->city_id == $city->id ? 'selected' : 'disabled' }} value="{{ $city->id }}">{{ $city['name_'.App()->getLocale()] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.states')</span>
                                        </div>
                                        <select required class="form-control" name="state_id">
                                            @foreach($states as $state)
                                                <option {{ $row->profile->state_id == $state->id ? 'selected' : 'disabled' }} value="{{ $state->id }}">{{ $state['name_'.App()->getLocale()] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.contract_start_at')</span>
                                        </div>
                                        <p class="form-control">{{ $row->profile->contract_start_at }}</p>
                                    </div>
                                    <div class="col-md-6 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.address')</span>
                                        </div>
                                        <p class="form-control">{{ $row->profile->address }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.email')</span>
                                        </div>
                                        <p class="form-control">{{ $row->email }}</p>
                                    </div>
                                    <div class="col-md-6 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.phone_number')</span>
                                        </div>
                                        <p class="form-control">{{ $row->phone }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 input-group mb-3">
                                        <a href="{{ url('dashboard/uploads/users/'.$row->profile->shop_photo) }}" target="_blank" class="btn btn-default">@lang('admin.shop_photo')</a>
                                    </div>
                                    <div class="col-md-6 input-group mb-3">
                                        <a href="{{ url('dashboard/uploads/users/'.$row->profile->personal_photo) }}" target="_blank" class="btn btn-warning">@lang('admin.personal_photo')</a>
                                    </div>
                                </div>
                            @elseif($row->type == 4)
                                <div class="row">
                                    <div class="col-md-4 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.name')</span>
                                        </div>
                                        <p class="form-control">{{ $row->profile->name }}</p>
                                    </div>
                                    <div class="col-md-4 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.cities')</span>
                                        </div>
                                        <select required class="form-control" name="city_id">
                                            @foreach($cities as $city)
                                                <option {{ $row->profile->city_id == $city->id ? 'selected' : 'disabled' }} value="{{ $city->id }}">{{ $city['name_'.App()->getLocale()] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.states')</span>
                                        </div>
                                        <select required class="form-control" name="state_id">
                                            @foreach($states as $state)
                                                <option {{ $row->profile->state_id == $state->id ? 'selected' : 'disabled' }} value="{{ $state->id }}">{{ $state['name_'.App()->getLocale()] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.address')</span>
                                        </div>
                                        <p class="form-control">{{ $row->profile->address }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.email')</span>
                                        </div>
                                        <p class="form-control">{{ $row->email }}</p>
                                    </div>
                                    <div class="col-md-6 input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@lang('admin.phone_number')</span>
                                        </div>
                                        <p class="form-control">{{ $row->phone }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 input-group mb-3">
                                        <a href="{{ url('dashboard/uploads/users/'.$row->profile->personal_photo) }}" target="_blank" class="btn btn-default">@lang('admin.personal_photo')</a>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <a href="{{ route('dashboard.'.$model.'.index') }}" class="btn btn-info"><i class="fa fa-arrow-circle-left"></i> @lang('admin.back')</a>

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
