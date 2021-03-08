@extends('dashboard.layouts.app')

@section('content')
    @php $model = 'custodies'; @endphp
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
                    <form action="{{ route('dashboard.'. $model .'.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.company_assets')</span>
                                </div>
                                <select name="company_asset_id" class="form-control">
                                    <option value="">@lang('admin.choose_assets')</option>
                                    @foreach($companyAssets as $asset)
                                        <option {{ old('company_asset_id') == $asset->id ? 'selected' : '' }} value="{{ $asset->id }}">{{ $asset->assetName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.users')</span>
                                </div>
                                <select name="user_id" class="form-control">
                                    <option value="">@lang('admin.choose_user')</option>
                                    @foreach($users as $user)
                                        <option {{ old('user_id') == $user->id ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->email }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.quantity')</span>
                            </div>
                            <input type="number" value="{{ old('quantity') }}" name="quantity" class="form-control">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.delivery_date')</span>
                            </div>
                            <input type="date" value="{{ old('delivery_date') }}" name="delivery_date" class="form-control">
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
        $("select[name=country_id]").on('change',function () {
            $.ajax({
                url : "{{ route('dashboard.states.related.country-cities') }}",
                data : {country_id: $(this).val(),_token: '{{ csrf_token() }}'},
                method: "post",
                success: function (data) {
                    $("select[name=city_id]").html("");
                    data.forEach(function (city){
                        $("select[name=city_id]").append(`<option value="${city.id}">${city.name}</option>`);
                    });
                }
            });
        });
    </script>
@endpush
