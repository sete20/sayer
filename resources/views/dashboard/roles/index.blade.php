@extends('dashboard.layouts.app')
@section('title', 'Roles')
@section('content')
@php $path = 'dashboard.laratrust.permissions'; @endphp
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
      <div class="header">
          <h2>@lang('admin.roles_table')<small>@lang('admin.table_desc')</small> </h2>
          <br>
          <a href="{{route('dashboard.laratrust.roles.create')}}" class="btn btn-success"><i class="fa fa-plus"></i> @lang('admin.new_role')</a>
      </div>
    <div class="body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover dataTable new_datatable_table">
          <thead>
            <tr>
              <th class="th">#</th>
              <th class="th">الاسم الظاهر للمستخدم</th>
              <th class="th">اسم اللائحة</th>
              <th class="th">الصلاحيات</th>
              <th class="th">العمليات</th>
            </tr>
          </thead>
          <tbody class="bg-white">
            @foreach ($roles as $role)
            <tr>
              <td>{{$role->id}}</td>
              <td>{{$role->display_name}}</td>
              <td>{{$role->name}}</td>
              <td>{{$role->permissions_count}}</td>
              <td>
                <form
                  action="{{route('dashboard.laratrust.roles.destroy', $role->id)}}"
                  method="POST"
                  onsubmit="return confirm('Are you sure you want to delete the record?');"
                >
                  @method('DELETE')
                  @csrf
                    @if (\Laratrust\Helper::roleIsEditable($role))
                        <a href="{{route('dashboard.laratrust.roles.edit', $role->id)}}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                    @else
                        <a href="{{route('dashboard.laratrust.roles.show', $role->id)}}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                    @endif
                  <button
                    type="submit"
                    class="{{\Laratrust\Helper::roleIsDeletable($role) ? 'text-red-600 hover:text-red-900' : 'text-gray-600 hover:text-gray-700 cursor-not-allowed'}} btn btn-danger"
                    @if(!\Laratrust\Helper::roleIsDeletable($role)) disabled @endif
                  ><i class="fa fa-trash"></i></button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  {{ $roles->links() }}
@endsection
