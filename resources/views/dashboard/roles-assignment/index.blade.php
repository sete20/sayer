@extends('dashboard.layouts.app')

@section('title', 'Roles Assignment')

@section('content')
<div class="block-header">
    <div class="row">
        <div class="col-lg-6 col-md-8 col-sm-12">
            <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-right"></i></a> @lang('admin.dashboard')</h2>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item"><a href="#">@lang('admin.permissions')</a></li>
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
  <div class="card">
    <div class="body">
      <div
        x-data="{ model: @if($modelKey) '{{$modelKey}}' @else 'initial' @endif }"
        x-init="$watch('model', value => value != 'initial' ? window.location = `?model=${value}` : '')">
          <div class="header">
              <label class="block w-3/12">
                  <select class="form-control" x-model="model">
                      <option value="initial" disabled selected>اختر الموديل</option>
                      @foreach ($models as $model)
                          <option value="{{$model}}">{{ucwords($model)}}</option>
                      @endforeach
                  </select>
              </label>
              <span>الموديل لاخيار اللوائح والصلاحيات</span>
          </div>
          <div class="body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover dataTable new_datatable_table c_list">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>اللائحة</th>
                        @if(config('laratrust.panel.assign_permissions_to_user'))<th> الصلاحيات</th>@endif
                        <th>العمليات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>
                                {{$user->getKey()}}
                            </td>
                            <td>
                                {{$user->name ?? 'The model doesn\'t have a `name` attribute'}}
                            </td>
                            <td>
                                {{$user->roles_count}}
                            </td>
                            @if(config('laratrust.panel.assign_permissions_to_user'))
                                <td>
                                    {{$user->permissions_count}}
                                </td>
                            @endif
                            <td class="">
                                <a
                                    href="{{route('dashboard.laratrust.roles-assignment.edit', ['roles_assignment' => $user->id, 'model' => $modelKey])}}"
                                    class="btn btn-success btn-sm"
                                ><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @if ($modelKey)
          {{ $users->appends(['model' => $modelKey])->links() }}
        @endif
      </div>
    </div>
  </div>
@endsection
