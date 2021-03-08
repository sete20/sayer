<div class="row">
    <input type="hidden" name="status" value="{{ request('status') }}">
    <div class="p-2 col-lg-4">
        <label> المندوب</label>
        <select name="representative_id" id="user_id" class="form-control" style="height: 3.2em;font-size:15px;font-weight:bold">
            <option value="0">  جميع المناديب  </option>
            @foreach(App\Models\User::query()->where('type',2)->get() as $user)
                <option {{ request('representative_id') == $user->id ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->profile->name_ar }}</option>
            @endforeach
        </select>
    </div>
    <div class="p-2 col-lg-4">
        <label> التاجر او الفرد</label>
        <select name="user_id" id="user_id" class="form-control" style="height: 3.2em;font-size:15px;font-weight:bold">
            <option value="0">  جميع التجار والافراد  </option>
            @foreach(App\Models\User::query()->whereIn('type',[3,4])->get() as $user)
                <option {{ request('user_id') == $user->id ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->type == 3 ? $user->profile->shop_name_ar : $user->profile->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-4">
        <label></label>
        <button type="submit" class=" btn btn-primary btnsearch" id="btnsearch-trader" style=" margin-top:35px;width:100px;height:50px">
        <i class="m-2 fa fa-search"></i>  بحث </button>
{{--        <label></label>--}}
{{--        <button type="button" class=" btn btn-danger btnsearch cancel-order" id="btnsearch-trader" style=" margin-top:35px;width:150px;height:50px">--}}
{{--        <i class="m-2 fa fa-trash"></i>  الغاء الطلبات </button>--}}
        @if(request('status') == 3)
            <label></label>
            <button type="button" class=" btn btn-info" id="confirm_deliveries_in_office" style=" margin-top:35px;width:150px;height:50px">تسليم الطلبات للمكتب</button>
        @endif
    </div>

</div>
