<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\City;
use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\userLog;
class StateController extends DashboardController {

    protected $name = 'states';

    public function __construct(State $row)
    {
        parent::__construct($row);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name_ar' => 'required|max:150',
            'name_en' => 'required|max:150',
            'country_id' => 'required|numeric',
            'city_id' => 'required|numeric',
            'status' => 'required|in:0,1',
        ]);

        State::query()->create($data);
        userLog::create([
            'user_name'=>Auth('admin')->user()->name,
            'user_id'=>Auth('admin')->user()->id,
            'columnAction'=> $data['name_ar'],
            'logMessage'=>"تم انشاء منطقة جديدة   بواسطة" . Auth('admin')->user()->name,
                  ]);
        return redirect()->route('dashboard.' . $this->name . '.index')->with('success', __('admin.store_success'));
    }

    public function update(Request $request,$id)
    {
        $row = State::query()->find($id);
        $data = $request->validate([
            'name_ar' => 'required|max:150',
            'name_en' => 'required|max:150',
            'city_id' => 'required|numeric',
            'country_id' => 'required|numeric',
            'status' => 'required|in:0,1',
        ]);

        $row->update($data);
        userLog::create([
            'user_name'=>Auth('admin')->user()->name,
            'user_id'=>Auth('admin')->user()->id,
            'columnAction'=> $data['name_ar'],
            'logMessage'=>"تم تحديث منطقة بواسطة" . Auth('admin')->user()->name,
                  ]);
        return redirect()->route('dashboard.' . $this->name . '.index')->with('success', __('admin.update_success'));
    }

    public function relatedCountryCities(Request $request)
    {
        $cities = City::query()
            ->where('country_id',$request->country_id)
            ->where('status',1)
            ->select(['id','name_'.App()->getLocale().' as name'])
            ->get();

        return response()->json($cities);
    }

    public function setPassParams($params = [])
    {
        $params['countries'] = Country::query()->where('status',1)->get();
        $params['cities'] = City::query()
            ->where('status',1)
            ->where('country_id',request('country_id'))
            ->get();

        return $params;
    }
}
