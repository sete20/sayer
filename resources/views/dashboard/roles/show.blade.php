
@extends('dashboard.layouts.app')
@section('title', "Role details")
@section('content')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
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
  <div class="flex flex-col">
    <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-32">
      <div
        class="inline-block min-w-full p-8 overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg"
      >
        <label class="flex justify-between w-4/12">
          <span class="font-bold text-gray-900">Name/Code:</span>
          <span class="ml-4 text-gray-800">{{$role->name}}</span>
        </label>

        <label class="flex justify-between w-4/12 my-4">
          <span class="font-bold text-gray-900">Display Name:</span>
          <span class="ml-4 text-gray-800">{{$role->display_name}}</span>
        </label>

        <label class="flex justify-between w-4/12 my-4">
          <span class="font-bold text-gray-900">Description:</span>
          <span class="ml-4 text-gray-800">{{$role->description}}</span>
        </label>
        <span class="font-bold text-gray-900">Permissions:</span>
        <ul class="grid grid-cols-1 list-inside md:grid-cols-4">
          @foreach ($role->permissions as $permission)
            <li class="text-gray-800 list-disc" >{{$permission->display_name ?? $permission->name}}</li>
          @endforeach
        </ul>
        <div class="flex justify-end">
          <a
            href="{{route("dashboard.laratrust.roles.index")}}"
            class="text-blue-600 hover:text-blue-900"
          >
            Back
          </a>
        </div>
      </form>
    </div>
  </div>
@endsection
