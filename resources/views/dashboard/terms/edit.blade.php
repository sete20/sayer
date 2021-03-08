@extends('dashboard.layouts.app')

@section('content')
    @php $model = 'terms'; @endphp
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

    <form action="{{ route('dashboard.'. $model .'.update',$row->id) }}" method="post">
        @csrf
        @method('put')
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">@lang('admin.description_ar')</span>
            </div>
            <textarea name="name_ar" class="form-control" rows="5" cols="10" placeholder="@lang('admin.name_ar')" aria-label="Username" aria-describedby="basic-addon1" required>{{ $row->name_ar }}</textarea>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">@lang('admin.description_en')</span>
            </div>
            <textarea name="name_en" class="form-control" rows="5" cols="10" placeholder="@lang('admin.name_en')" aria-label="Username" aria-describedby="basic-addon1" required>{{ $row->name_en }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('admin.edit_element')</button>

    </form>
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
