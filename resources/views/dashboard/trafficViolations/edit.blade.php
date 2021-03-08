@extends('dashboard.layouts.app')

@section('content')
@php $model = 'traffic-violations'; @endphp
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-8 col-sm-12">
                <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-right"></i></a> @lang('admin.dashboard')</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.violations.index') }}">@lang('admin.'.$model)</a></li>
                    <li class="breadcrumb-item active">@lang('admin.add_new')</li>
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



                        <form action="{{ route('dashboard.violations.update',$trafficViolation->id) }}" enctype="multipart/form-data" method="post">
                            @method('put')
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-4 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.violation_number')</span>
                                </div>
                                <input type="text" name="violation_number" class="form-control" value="{{ $trafficViolation->violation_number }}" placeholder="@lang('admin.violation_number')" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="mb-3 col-md-4 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.violation_date')</span>
                                </div>
                                <input type="date" name="violation_date" class="form-control" value="{{ $trafficViolation->violation_date }}" placeholder="@lang('admin.violation_date')" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="mb-3 col-md-4 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.violation_type')</span>
                                </div>
                                <input type="text" name="violation_type" class="form-control" value="{{ $trafficViolation->violation_type }}" placeholder="@lang('admin.violation_type')" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="mb-3 col-md-6 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.violation_area')</span>
                                </div>
                                <input type="text" name="violation_area" class="form-control" value="{{ $trafficViolation->violation_area }}" placeholder="@lang('admin.violation_area')" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="mb-3 col-md-6 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.violation_value')</span>
                                </div>
                                <input type="number" name="violation_value" class="form-control" value="{{ $trafficViolation->violation_value}}" placeholder="@lang('admin.violation_value')" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="mb-3 col-md-6 input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.status')</span>
                                </div>
                                <select name="violation_status" value={{ $trafficViolation->violation_status}} class="form-control">
                                    <option value="paid">@lang('admin.paid')</option>
                                    <option value="unpaid">@lang('admin.unpaid')</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-4 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.violation_image')</span>
                                </div>
                                <input type="file" name="violation_image" class="form-control" value="{{ $trafficViolation->violation_image }}" placeholder="@lang('admin.violation_image')" aria-label="Username" aria-describedby="basic-addon1">
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('admin.update')</button>
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
