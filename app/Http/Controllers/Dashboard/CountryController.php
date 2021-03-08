<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\userLog;
class CountryController extends DashboardController {

    protected $name = 'countries';

    public function __construct(Country $row)
    {
        parent::__construct($row);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name_ar' => 'required|max:150',
            'name_en' => 'required|max:150',
            'status' => 'required|in:0,1',
        ]);

        Country::query()->create($data);
        userLog::create([
            'user_name'=>Auth('admin')->user()->name,
            'user_id'=>Auth('admin')->user()->id,
            'columnAction'=>$data['name_ar'],
            'logMessage'=>"تـم انشاء بلد جديد بواسطة"  . auth('admin')->user()->name,
                  ]);
        return redirect()->route('dashboard.' . $this->name . '.index')->with('success', __('admin.store_success'));
    }

    public function update(Request $request,$id)
    {
        $row = Country::query()->find($id);
        $data = $request->validate([
            'name_ar' => 'required|max:150',
            'name_en' => 'required|max:150',
            'status' => 'required|in:0,1',
        ]);

        $row->update($data);
        userLog::create([
            'user_name'=>Auth('admin')->user()->name,
            'user_id'=>Auth('admin')->user()->id,
            'columnAction'=>$data['name_ar'],
            'logMessage'=>"تـم تعديل بلد بواسطة"  . auth('admin')->user()->name,
                  ]);
        return redirect()->route('dashboard.' . $this->name . '.index')->with('success', __('admin.update_success'));
    }
}
