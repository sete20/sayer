<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\City;
use App\Models\Service;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\userLog;
class ServiceController extends DashboardController {

    protected $name = 'services';

    public function __construct(Service $row)
    {
        parent::__construct($row);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name_ar' => 'required|max:150',
            'name_en' => 'required|max:150',
            'type' => 'required|numeric|in:1,2',
        ]);

        Service::query()->create($data);
        userLog::create([
            'user_name'=>Auth('admin')->user()->name,
            'user_id'=>Auth('admin')->user()->id,
            'columnAction'=> $data['name_ar'],
            'logMessage'=>"تم انشاء خـدمة جديدة  بواسطة" . Auth('admin')->user()->name,
                  ]);
        return redirect()->route('dashboard.' . $this->name . '.index')->with('success', __('admin.store_success'));
    }

    public function update(Request $request,$id)
    {
        $row = Service::query()->find($id);
        $data = $request->validate([
            'name_ar' => 'required|max:150',
            'name_en' => 'required|max:150',
            'type' => 'required|numeric|in:1,2',
            'status' => 'required|in:0,1',
        ]);

        $row->update($data);
        userLog::create([
            'user_name'=>Auth('admin')->user()->name,
            'user_id'=>Auth('admin')->user()->id,
            'columnAction'=> $data['name_ar'],
            'logMessage'=>"تم انشاء تحديث خدمة بواسطة" . Auth('admin')->user()->name,
                  ]);
        return redirect()->route('dashboard.' . $this->name . '.index')->with('success', __('admin.update_success'));
    }

    public function setPassParams($params = [])
    {
        return $params;
    }
}
