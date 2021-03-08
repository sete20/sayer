@extends('dashboard.layouts.app')

@section('content')
    @php $model = 'company-assets'; @endphp
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
                    <form action="{{ route('dashboard.'. $model . '.update',$row->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="mb-3 input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.asset_name')</span>
                            </div>
                            <input type="text" name="assetName" class="form-control" value="{{ $row->assetName }}" placeholder="@lang('admin.asset_name')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="mb-3 input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.purchase_date')</span>
                            </div>
                            <input type="date" name="purchase_date" class="form-control" value="{{ $row->purchase_date }}" placeholder="@lang('admin.purchase_date')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="mb-3 input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.bill_num')</span>
                            </div>
                            <input type="number" name="billNumber" class="form-control" value="{{ $row->billNumber }}" placeholder="@lang('admin.bill_num')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="mb-3 input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.supplier')</span>
                            </div>
                            <input type="text" name="supplier" class="form-control" value="{{ $row->supplier }}" placeholder="@lang('admin.supplier')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="mb-3 input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.quantity')</span>
                            </div>
                            <input type="number" name="quantity" class="form-control" value="{{ $row->quantity }}" placeholder="@lang('admin.quantity')" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="mb-3 input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.Specifications')</span>
                            </div>
                            <textarea name="specifications" class="form-control" placeholder="@lang('admin.Specifications')">{{ $row->specifications }}</textarea>
                        </div>
                        <div class="mb-3 input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.status')</span>
                            </div>
                            <select name="status" class="form-control">
                                <option {{ $row->status == 'new' ? 'selected' : '' }} value="new">@lang('admin.new')</option>
                                <option {{ $row->status == 'used' ? 'selected' : '' }} value="used">@lang('admin.used')</option>
                                <option {{ $row->status == 'damaged' ? 'selected' : '' }} value="damaged">@lang('admin.damaged')</option>
                                <option {{ $row->status == 'custody' ? 'selected' : '' }} value="custody">@lang('admin.custody')</option>
                                <option {{ $row->status == 'stored' ? 'selected' : '' }} value="stored">@lang('admin.stored')</option>
                            </select>
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
