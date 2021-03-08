@extends('dashboard.layouts.app')

@section('content')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-8 col-sm-12">
                <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-right"></i></a> @lang('admin.dashboard')</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">@lang('admin.dashboard')</a></li>
                    <li class="breadcrumb-item active">@lang('admin.settings')</li>
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
                    <h2> @lang('admin.settings')</h2>
                </div>
                <div class="body">
                    <form action="{{ route('dashboard.configs.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @foreach($configs as $config)
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ $config->display_name }}</span>
                                </div>
                                @if($config->type == 1)
                                    <input type="text" class="form-control" name="{{ $config->var }}" value="{{ $config->value }}" placeholder="{{ $config->display_name }}" aria-label="{{ $config->display_name }}" aria-describedby="basic-addon1">
                                @elseif($config->type == 2)
                                    <input type="file" class="form-control" name="{{ $config->var }}" style="height: 72px;" placeholder="{{ $config->display_name }}" aria-label="{{ $config->display_name }}" aria-describedby="basic-addon1">
                                    <br>
                                    <img src="{{ url('dashboard/uploads/configs/'.$config->value) }}" style="width: 72px" alt="">
                                @else
                                    <textarea class="form-control" name="{{ $config->var }}" aria-label="With textarea">{{ $config->value }}</textarea>
                                @endif
                            </div>
                        @endforeach
                        <button class="btn btn-info">@lang('admin.save_changes')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
