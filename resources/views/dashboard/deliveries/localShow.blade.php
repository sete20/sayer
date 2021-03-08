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
                    <li class="breadcrumb-item active">@lang('admin.from_inside_to_inside')</li>
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
                    <h2> @lang('admin.from_inside_to_inside')</h2>
                </div>
                <div class="body">
                    <div class="row">
                        <div class="col-md-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.coupon_code')</span>
                            </div>
                            <p class="form-control">{{ $delivery->coupon_code }}</p>
                        </div>
                        <div class="col-md-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.track_delivery_number')</span>
                            </div>
                            <p class="form-control">{{ $delivery->track_delivery_number }}</p>
                        </div>
                        <div class="col-md-12 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.received_data')</span>
                            </div>
                            <p class="form-control">{{ $delivery->received_date }}</p>
                        </div>
                    </div>
                    @if ($user->type == 4)
                        <div class="row">
                            <div class="col-md-12 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.sender_name')</span>
                                </div>
                                <p class="form-control">{{ $profile->name }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.sender_country')</span>
                                </div>
                                <p class="form-control">{{ $profile->country->name_ar }}</p>
                            </div>
                            <div class="col-md-4 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.sender_city')</span>
                                </div>
                                <p class="form-control">{{ $profile->city->name_ar }}</p>
                            </div>
                            <div class="col-md-4 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.sender_state')</span>
                                </div>
                                <p class="form-control">{{ $profile->state->name_ar }}</p>
                            </div>
                            <div class="col-md-12 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.sender_address')</span>
                                </div>
                                <p class="form-control">{{ $profile->address }}</p>
                            </div>
                            <div class="col-md-6 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.sender_email')</span>
                                </div>
                                <p class="form-control">{{ $user->email }}</p>
                            </div>
                            <div class="col-md-6 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.sender_phone')</span>
                                </div>
                                <p class="form-control" style="direction: ltr">{{ $user->phone }}</p>
                            </div>
                        </div>
                    @elseif($user->type == 3)
                        <div class="row">
                            <div class="col-md-12 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.sender_email')</span>
                                </div>
                                <p class="form-control">{{ $user->email }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.sender_country')</span>
                                </div>
                                <p class="form-control">{{ $profile->country->name_ar }}</p>
                            </div>
                            <div class="col-md-4 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.sender_city')</span>
                                </div>
                                <p class="form-control">{{ $profile->city->name_ar }}</p>
                            </div>
                            <div class="col-md-4 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.sender_state')</span>
                                </div>
                                <p class="form-control">{{ $profile->state->name_ar }}</p>
                            </div>
                            <div class="col-md-12 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.shop_owner_name')</span>
                                </div>
                                <p class="form-control">{{ $profile->shop_owner_name }}</p>
                            </div>
                            <div class="col-md-6 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.shop_name_ar')</span>
                                </div>
                                <p class="form-control">{{ $profile->shop_name_ar }}</p>
                            </div>
                            <div class="col-md-6 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.shop_name_en')</span>
                                </div>
                                <p class="form-control">{{ $profile->shop_name_en }}</p>
                            </div>
                            <div class="col-md-6 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.shop_logo')</span>
                                </div>
                                <img src="{{ url('dashboard/uploads/users/') }}/{{ $profile->shop_photo }}" style="width: 200px;height: 100px" />
                            </div>
                            <div class="col-md-6 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.sender_address')</span>
                                </div>
                                <p class="form-control" style="height: 100px">{{ $profile->address }}</p>
                            </div>
                            <div class="col-md-6 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.sender_email')</span>
                                </div>
                                <p class="form-control">{{ $user->email }}</p>
                            </div>
                            <div class="col-md-6 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.sender_phone')</span>
                                </div>
                                <p class="form-control">{{ $user->phone }}</p>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.consignee')</span>
                            </div>
                            <p class="form-control">{{ $delivery->consignee }}</p>
                        </div>
                        <div class="col-md-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.consignee_phone')</span>
                            </div>
                            <p class="form-control" style="direction: ltr">{{ $delivery->consignee_phone }}</p>
                        </div>
                        <div class="col-md-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.consignee_telephone')</span>
                            </div>
                            <p class="form-control" style="direction: ltr">{{ $delivery->consignee_telephone }}</p>
                        </div>
                        <div class="col-md-12 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.country')</span>
                            </div>
                            <p class="form-control">الامارات العربية المتحدة</p>
                        </div>
                        <div class="col-md-4 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.city')</span>
                            </div>
                            <p class="form-control">{{ $delivery->city->name_ar }}</p>
                        </div>
                        <div class="col-md-4 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.state')</span>
                            </div>
                            <p class="form-control">{{ $delivery->state->name_ar }}</p>
                        </div>
                        <div class="col-md-4 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.home_number')</span>
                            </div>
                            <p class="form-control">{{ $delivery->home_number }}</p>
                        </div>
                        <div class="col-md-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.service')</span>
                            </div>
                            <p class="form-control">{{ $delivery->service->name_ar }}</p>
                        </div>
                        <div class="service-details col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@lang('admin.service_cost')</span>
                                </div>
                                <p class="form-control">{{ $serviceCost->cost }}</p>
                            </div>
                        </div>
                        <div class="col-md-12 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.consignee_address')</span>
                            </div>
                            <p class="form-control">{{ $delivery->consignee_address }}</p>
                        </div>
                        <div class="col-md-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.package_number')</span>
                            </div>
                            <p class="form-control">{{ $delivery->package_number }}</p>
                        </div>
                        <div class="col-md-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.weight_in_kilo')</span>
                            </div>
                            <p class="form-control">{{ $delivery->weight_in_kilo }}</p>
                        </div>
                        <div class="col-md-12 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.notes')</span>
                            </div>
                            <textarea name="notes" class="form-control disabled">{{ $delivery->notes }}</textarea>
                        </div>
                        <div class="col-md-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.order_price')</span>
                            </div>
                            <p class="form-control">{{ $delivery->order_price }}</p>
                        </div>
                        <div class="col-md-6 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@lang('admin.total_price')</span>
                            </div>
                            <p class="form-control">{{ $delivery->total_price }}</p>
                        </div>
                        <div class="col-md-6 card">
                            <div class="pb-0 header">
                                <h2>@lang('admin.other_notes')</h2>
                            </div>
                            <div class="pt-0 body">
                                <hr>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        @foreach($delivery->notes()->get() as $note)
                                            <div class="fancy-checkbox">
                                                <label>
                                                    <input name="delivery_notes[]" value="{{ $note->id }}" checked type="checkbox">
                                                    <span>{{ $note['name_'.App()->getLocale()] }}</span>
                                                </label>
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
                                    <div class="col-lg-6 col-md-12">
                                        <div class="fancy-radio">
                                            <label><input name="delivery_amount_from" {{ $delivery->delivery_amount_from == 1 ? 'checked' : 'disabled' }} value="1" type="radio" checked=""><span><i></i>@lang('admin.sender_name')</span></label>
                                            <label><input name="delivery_amount_from" {{ $delivery->delivery_amount_from == 2 ? 'checked' : 'disabled' }} value="2" type="radio"><span><i></i>@lang('admin.consignee_name')</span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('dashboard.deliveries.index') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> @lang('admin.back')</a>
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
