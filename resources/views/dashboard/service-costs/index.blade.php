@extends('dashboard.layouts.app')

@section('content')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-8 col-sm-12">
                <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-right"></i></a> @lang('admin.dashboard')</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active">@lang('admin.service-costs')</li>
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
        <div class="col-lg-12">
            <div class="card">
                <form action="{{ route('dashboard.service-costs.update') }}" method="post">
                @csrf
                <div class="header">
                    <h2>@lang('admin.service-costs-table')<small>@lang('admin.table_desc')</small> </h2>
                    <br>
                    <div class="container">
                            <div class="row">
                                <select name="country_id" class="col-md-6 form-control">
                                    <option value="">@lang('admin.choose_country')</option>
                                    @foreach($countries as $country)
                                        <option {{ $country->id == request('country_id') ? 'selected' : '' }} value="{{ $country->id }}">{{ $country['name_'.App()->getLocale()] }}</option>
                                    @endforeach
                                </select>
                                <select name="city_id" class="col-md-6 form-control">
                                    <option value="">@lang('admin.choose_city')</option>
                                    @if($cities != null)
                                        @foreach($cities as $city)
                                            <option {{ $city->id == request('city_id') ? 'selected' : '' }} value="{{ $city->id }}">{{ $city['name_'.App()->getLocale()] }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                    </div>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        @if($cities !== null)
                            <table class="table table-bordered table-striped table-hover dataTable new_datatable_table">
                                <thead class="head_of_service_cost_table">
                                @if($services !== null)
                                    <tr>
                                        <td>{{ __('admin.state_ar') }}</td>
                                        <td>{{ __('admin.state_en') }}</td>
                                        @foreach($services as $service)
                                            <td>{{ $service->name }}</td>
                                        @endforeach
                                    </tr>
                                @endif
                                </thead>
                                <tbody class="content_of_service_cost_table">
                                @if($services !== null)
                                    @foreach($states as $state)
                                        <tr>
                                            <td>{{ $state->name_ar }}</td>
                                            <td>{{ $state->name_en }}</td>
                                            @foreach($services as $service)
                                                <td><input type="text" style="min-width: 60px;" class="form-control" name="{{ $state->id .'['.$service->id.']' }}" value="{{ $service->relValue($state->id) }}"></td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        @else
                            <h1>@lang('admin.no_states_found')</h1>
                        @endif
                    </div>
                    <div class="button-append-position">
                        @if($services !== null)
                            <button type="submit" class="btn btn-success">@lang('admin.save_info')</button>
                        @endif
                    </div>
                </div>

                </form>
            </div>
        </div>

    </div>
@endsection


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
                url : "{{ route('dashboard.service-costs.related.country-cities') }}",
                data : {country_id: $(this).val(),_token: '{{ csrf_token() }}'},
                method: "post",
                success: function (data) {
                    $("select[name=city_id]").html(`<option value="">{{ __('admin.choose_city') }}</option>`);
                    data.forEach(function (city){
                        $("select[name=city_id]").append(`<option value="${city.id}">${city.name}</option>`);
                    });
                }
            });
        });

        $("select[name=city_id]").on('change',function () {
                document.location.href = "{{ route('dashboard.service-costs.index') }}?city_id="+$(this).val()+"&country_id="+$('select[name=country_id]').val();
        });

    </script>
@endpush
