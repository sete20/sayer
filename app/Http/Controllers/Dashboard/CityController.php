<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\userLog;
class CityController extends DashboardController {

    protected $name = 'cities';

    public function __construct(City $row)
    {
        parent::__construct($row);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name_ar' => 'required|max:150',
            'name_en' => 'required|max:150',
            'country_id' => 'required|numeric',
            'status' => 'required|in:0,1',
        ]);

        City::query()->create($data);
        userLog::create([
            'user_name'=>Auth('admin')->user()->name,
            'user_id'=>Auth('admin')->user()->id,
            'columnAction'=>$data['name_ar'],
            'logMessage'=>"تـم انـشاء مدينة بواسطة"  . auth('admin')->user()->name,
                  ]);
        return redirect()->route('dashboard.' . $this->name . '.index')->with('success', __('admin.store_success'));
    }

    public function update(Request $request,$id)
    {
        $row = City::query()->find($id);
        $data = $request->validate([
            'name_ar' => 'required|max:150',
            'name_en' => 'required|max:150',
            'country_id' => 'required|numeric',
            'status' => 'required|in:0,1',
        ]);

        $row->update($data);
        userLog::create([
            'user_name'=>Auth('admin')->user()->name,
            'user_id'=>Auth('admin')->user()->id,
            'columnAction'=>$data['name_ar'],
            'logMessage'=>"تـم تحديث مدينة بواسطة"  .auth('admin')->user()->name,
                  ]);
        return redirect()->route('dashboard.' . $this->name . '.index')->with('success', __('admin.update_success'));
    }

    public function setPassParams($params = [])
    {
        $params['countries'] = Country::query()->where('status',1)->get();
        return $params;
    }
}
