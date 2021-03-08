@extends('dashboard.layouts.app')

@section('title', "Edit {$modelKey}")
@php
$model ='dashboard.laratrust.roles-assignment';
@endphp
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
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
      <div class="card">
          <div class="header">
              <h2>توزيع الصلاحيات</h2>
          </div>
        <div class="body">
          <form method="POST" action="{{route($model.'.update', ['roles_assignment' => $user->id, 'model' => $modelKey])}}">
            @csrf
            @method('PUT')
            <div class="mb-3 input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">@lang('admin.name')</span>
                </div>
                <input type="text" name="name" placeholder="this-will-be-the-code-name" value="{{$user->email ?? 'لا يوجد بريد الكتروني لهذا النموزج'}}" readonly
                autocomplete="off"class="form-control" value="{{ old('name') }}" placeholder="@lang('admin.name')" aria-label="Username" aria-describedby="basic-addon1">
            </div>
{{--              <div class="input-group mb-3">--}}
{{--                  <div class="input-group-prepend">--}}
{{--                      <span class="input-group-text">الاسم</span>--}}
{{--                  </div>--}}
{{--                  <input name="name" class="form-control">--}}
{{--                  @error('name')--}}
{{--                  <div class="alert alert-danger">{{ $message}} </div>--}}
{{--                  @enderror--}}
{{--              </div>--}}
            <span>اللوائح</span>
            <div class="body">
                <div class="row">
                    @foreach ($roles as $role)
                        <label class="fancy-checkbox " style="flex: 1 0 20%;">
                            <input
                                type="checkbox"
                                @if ($role->assigned && !$role->isRemovable)
                                class="w-4 h-4 text-gray-500 form-checkbox focus:shadow-none focus:border-transparent"
                                @else
                                class="w-4 h-4 form-checkbox"
                                @endif
                                name="roles[]"
                                value="{{$role->id}}"
                                {!! $role->assigned ? 'checked' : '' !!}
                                {!! $role->assigned && !$role->isRemovable ? 'onclick="return false;"' : '' !!}
                            >
                            <span class="ml-2 {!! $role->assigned && !$role->isRemovable ? 'text-gray-600' : '' !!}">
                            {{$role->display_name ?? $role->name}}
                          </span>
                        </label>
                    @endforeach
                </div>
            </div>
            @if ($permissions)
              <span class="">الصلاحيات</span>
              <div class="body">
                  <div class="row">
                      @foreach ($permissions as $permission)

                          <label class="fancy-checkbox" style="flex: 1 0 20%;">

                              <input
                                  type="checkbox"
                                  class="w-4 h-4 form-check-inline form-checkbox"
                                  name="permissions[]"
                                  value="{{$permission->id}}"
                                  {!! $permission->assigned ? 'checked' : '' !!}
                              >
                              <span class="ml-2">{{$permission->display_name ?? $permission->name}}</span>
                          </label>
                      @endforeach
                  </div>
              </div>
            @endif
            <div class="flex justify-end">
              <a
                href="{{route($model.".index", ['model' => $modelKey])}}"
                class="mr-4 btn btn-danger"
              >
                Cancel
              </a>
              <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> حفظ</button>
            </div>
          </form>
        </div>
      </div>
        </div>
    </div>
@endsection
