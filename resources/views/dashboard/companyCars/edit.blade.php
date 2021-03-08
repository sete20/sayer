@extends('dashboard.layouts.app')

@section('content')
    @php $model = 'company-cars'; @endphp
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-8 col-sm-12">
                <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-right"></i></a> @lang('admin.dashboard')</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('dashboard.'.$model.'.index') }}">@lang('admin.'.$model)</a></li>
                    <li class="breadcrumb-item active">@lang('admin.edit_element')</li>
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
                    <form  enctype="multipart/form-data" action="{{ route('dashboard.'. $model . '.update',$row->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="mb-3 col-md-4 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.Model')</span>
                                </div>
                                <input type="text" name="Model" class="form-control" value="{{ $row->Model }}" placeholder="@lang('admin.Model')" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="mb-3 col-md-4 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.vehicleType')</span>
                                </div>
                                <input type="text" name="vehicleType" class="form-control" value="{{$row->vehicleType}}" placeholder="@lang('admin.vehicleType')" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="mb-3 col-md-4 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.chassisNo')</span>
                                </div>
                                <input type="text" name="chassisNo" class="form-control" value="{{$row->chassisNo}}" placeholder="@lang('admin.chassisNo')" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="mb-3 col-md-6 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.vehicleNumber')</span>
                                </div>
                                <input type="text" name="vehicleNumber" class="form-control" value="{{ $row->vehicleNumber}}" placeholder="@lang('admin.vehicleNumber')" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="mb-3 col-md-6 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.vehicleClass')</span>
                                </div>
                                <input type="text" name="vehicleClass" class="form-control" value="{{$row->vehicleClass }}" placeholder="@lang('admin.vehicleClass')" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="mb-3 col-md-4 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.licenseAuthority')</span>
                                </div>
                                <input type="text" name="licenseAuthority" class="form-control" value="{{$row->licenseAuthority }}" placeholder="@lang('admin.licenseAuthority')" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="mb-3 col-md-4 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.ownershipType')</span>
                                </div>
                                <input type="text" name="ownershipType" class="form-control" value="{{$row->ownershipType }}" placeholder="@lang('admin.ownershipType')" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="mb-3 col-md-4 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.trafficCode')</span>
                                </div>
                                <input type="text" name="trafficCode" class="form-control" value="{{ $row->trafficCode }}" placeholder="@lang('admin.trafficCode')" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="mb-3 col-md-4 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.registrationDate')</span>
                                </div>
                                <input type="date" name="registrationDate" class="form-control" value="{{$row->registrationDate}}" placeholder="@lang('admin.registrationDate')" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="mb-3 col-md-4 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.registrationExpirationDate')</span>
                                </div>
                                <input type="date" name="registrationExpirationDate" class="form-control" value="{{ $row->registrationExpirationDate }}" placeholder="@lang('admin.registrationExpirationDate')" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="mb-3 col-md-4 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.insuranceDate')</span>
                                </div>
                                <input type="date" name="insuranceDate" class="form-control" value="{{$row->insuranceDate }}" placeholder="@lang('admin.insuranceDate')" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="mb-3 col-md-4 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.insuranceExpirationDate')</span>
                                </div>
                                <input type="date" name="insuranceExpirationDate" class="form-control" value="{{ $row->insuranceExpirationDate}}" placeholder="@lang('admin.insuranceExpirationDate')" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="mb-3 col-md-4 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.insuranceCompany')</span>
                                </div>
                                <input type="text" name="insuranceCompany" class="form-control" value="{{ $row->insuranceCompany }}" placeholder="@lang('admin.insuranceCompany')" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="mb-3 col-md-4 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.ownershipImage')</span>
                                </div>
                                <input type="file" name="ownershipImage" class="form-control" value="{{ $row->ownershipImage }}" placeholder="@lang('admin.ownershipImage')" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="mb-3 col-md-6 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.trafficID')</span>
                                </div>
                                <input type="text" name="trafficID" class="form-control" value="{{ $row->trafficID }}" placeholder="@lang('admin.trafficID')" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="mb-3 col-md-6 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.salikCardNo')</span>
                                </div>
                                <input type="text" name="salikCardNo" class="form-control" value="{{ $row->salikCardNo }}" placeholder="@lang('admin.salikCardNo')" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="mb-3 col-md-6 input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.status')</span>
                                </div>
                                <select name="status" class="form-control">
                                    <option {{ $row->status == 'working' ? 'selected' : '' }} value="working">@lang('admin.working')</option>
                                    <option {{ $row->status == 'stopped' ? 'selected' : '' }} value="stopped">@lang('admin.stopped')</option>
                                    <option {{ $row->status == 'garage' ? 'selected' : '' }} value="garage">@lang('admin.garage')</option>
                                    <option {{ $row->status == 'damaged' ? 'selected' : '' }} value="damaged">@lang('admin.damaged')</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-6 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.aberCardNo')</span>
                                </div>
                                <input type="text" name="aberCardNo" class="form-control" value="{{ $row->aberCardNo }}" placeholder="@lang('admin.aberCardNo')" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="mb-3 input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.Notice')</span>
                            </div>
                            <textarea type="textarea" name="Notice" class="form-control" placeholder="@lang('admin.Notice')" aria-label="Username" aria-describedby="basic-addon1">{{ $row->Notice }}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-12 input-group mb-3">
                                <a href="{{ url('dashboard/uploads/companyCars/ownershipImages/'.$row->ownershipImage) }}" target="_blank" class="btn btn-default">صورة الملكية الحالية</a>
                            </div>
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
@endpush
