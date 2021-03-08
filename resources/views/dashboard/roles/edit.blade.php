@extends('dashboard.layouts.app')
@section('title', $model ? "Edit {$type}" : "New {$type}")

@section('content')
    @php $path = 'dashboard.laratrust.permissions'; @endphp
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-8 col-sm-12">
                <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-right"></i></a> @lang('admin.dashboard')</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route($path.'.index') }}">@lang('admin.permissions')</a></li>
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
  <div class="row clearfix">
      <div class="col-lg-12 col-md-12">
          <div class="card">
              <div class="header">
                  <h2> @lang('admin.edit_element')</h2>
              </div>
              <div class="body">
                  <form
                      x-data="laratrustForm()"
                      x-init="{!! $model ? '' : '$watch(\'displayName\', value => onChangeDisplayName(value))'!!}"
                      method="POST"
                      action="{{$model ? route("dashboard.laratrust.{$type}s.update", $model->id) : route("dashboard.laratrust.{$type}s.store")}}"
                  >
                      @csrf
                      @if ($model)
                          @method('PUT')
                      @endif
                      <div class="input-group mb-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text">الاسم او الشفرة</span>
                          </div>
                          <input
                              class="form-control @error('name') border-red-500 @enderror"
                              name="name"
                              placeholder="هذا سيكون شفرة اللائحة ( اسمها )"
                              :value="name"
                              readonly
                              autocomplete="off"
                          >
                          @error('name')
                          <div class="alert alert-danger">{{ $message}} </div>
                          @enderror
                      </div>
                      <div class="input-group mb-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text">لاسم الظاهر للمستخدم</span>
                          </div>
                          <input
                              class="form-control"
                              name="display_name"
                              placeholder="الاسم الظاهر للمستخدم عند التعديل"
                              x-model="displayName"
                              autocomplete="off"
                          >
                      </div>

                      <div class="input-group mb-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text">الوصف</span>
                          </div>
                          <textarea
                              class="form-control"
                              rows="3"
                              name="description"
                              placeholder="بعض الوصف ل {{$type}}"
                          >{{ $model->description ?? old('description') }}</textarea>
                      </div>

                      @if($type == 'role')
                          <div class="form-group">
                              <label>الصلاحيات</label>
                              <br>
                              @foreach ($permissions as $permission)
                              <label class="fancy-checkbox">
                                  <input
                                      type="checkbox"
                                      class=""
                                      data-parsley-multiple="checkbox"
                                      name="permissions[]"
                                      value="{{$permission->id}}"
                                      {!! $permission->assigned ? 'checked' : '' !!}
                                  >
                                  <span>{{$permission->display_name ?? $permission->name}}</span>
                              </label>
                              @endforeach
                              <p id="error-checkbox"></p>
                          </div>
                      @endif
                      <div class="flex justify-end">
                          <button class="btn btn-info" type="submit">حفظ البيانات</button>
                          <a
                              href="{{route("dashboard.laratrust.{$type}s.index")}}"
                              class="btn btn-default"
                          >
                              رجوع
                          </a>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
  <script>
    window.laratrustForm =  function() {
      return {
        displayName: '{{ $model->display_name ?? old('display_name') }}',
        name: '{{ $model->name ?? old('name') }}',
        toKebabCase(str) {
          return str &&
            str
              .match(/[A-Z]{2,}(?=[A-Z][a-z]+[0-9]*|\b)|[A-Z]?[a-z]+[0-9]*|[A-Z]|[0-9]+/g)
              .map(x => x.toLowerCase())
              .join('-')
              .trim();
        },
        onChangeDisplayName(value) {
          this.name = this.toKebabCase(value);
        }
      }
    }
  </script>
@endsection
