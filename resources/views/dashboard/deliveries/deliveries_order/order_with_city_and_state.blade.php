<div class="row">
    <input type="hidden" name="status" value="{{ request('status') }}">
    <div class="p-2 col-lg-2">
        <label> الامارة</label>
        <select class="form-control" name="city_id" id="city_id" style="height: 3.2em;font-size:15px;font-weight:bold">
        <option value="0"><p style="color:lightgrey">  جميع الامارات </p></option>
        @foreach($cities as $city)
            <option {{ request('city_id') == $city->id ? 'selected' : '' }} value="{{$city->id}}">{{$city->name_ar}}</option>
        @endforeach
        </select>
    </div>
    <div class="p-2 col-lg-2">
        <label> المناطق</label>
        <select class="form-control" name="region" id="region" style="height: 3.2em;font-size:15px;font-weight:bold">
            <option value="0"> جميع المناطق</option>
            @if(request()->has('city_id') && request()->has('region'))
                @if(request('city_id') != 0 && request('region') != 0)
                    @foreach($states as $state)
                        <option {{ request('region') == $state->id ? 'selected' : '' }} value="{{$state->id}}">{{$state->name_ar}}</option>
                    @endforeach
                @endif
            @endif
        </select>
    </div>
    <div class="p-2 col-lg-2">
        <label> التاجر او الفرد</label>
        <select name="user_id" id="user_id" class="form-control" style="height: 3.2em;font-size:15px;font-weight:bold">
            <option value="0">  جميع التجار والافراد  </option>
            @foreach(App\Models\User::query()->whereIn('type',[3,4])->get() as $user)
                <option {{ request('user_id') == $user->id ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->type == 3 ? $user->profile->shop_name_ar : $user->profile->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="p-2 col-lg-2">
        <label> من تاريخ</label>
        <input type="date" name="from" value="{{ request('from') }}" class="form-control" style="height: 3.2em;font-size:15px;font-weight:bold">
    </div>
    <div class="p-2 col-lg-2">
        <label> الي تاريخ</label>
        <input type="date" name="to" value="{{ request('to') }}" class="form-control" style="height: 3.2em;font-size:15px;font-weight:bold">
    </div>
    <div class="p-2 col-lg-1">
        <label></label>
        <button type="submit" class=" btn btn-primary btnsearch" id="btnsearch" style="margin: 8px;width:100px;height:50px">
        <i class="fa fa-search"></i>  بحث </button>
    </div>
</div>
