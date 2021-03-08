<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\CompanyProfile;
use App\Models\Country;
use App\Models\Delivery;
use App\Models\DeliveryNote;
use App\Models\PersonalProfile;
use App\Models\Service;
use App\Models\ServiceCost;
use App\Models\User;
use App\Models\UserDelivery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\userLog;

class DeliveryNoteController extends DashboardController {

    protected $name = 'delivery_notes';

    public function __construct(DeliveryNote $row)
    {
        parent::__construct($row);
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
        ]);

        $deliveyNotes = DeliveryNote::query()->create($data);

        userLog::create([
            'user_name'=>Auth('admin')->user()->name,
            'user_id'=>Auth('admin')->user()->id,
            'columnAction'=>'اضافة ملاحظة شحن',
            'logMessage'=>"تـم انـشاء ملاحظة شحن بنجاح بواسطة"  . auth('admin')->user()->name,
        ]);
        return redirect()->route('dashboard.' . $this->name . '.index')->with('success', __('admin.store_success'));
    }

    public function update(Request $request,$id)
    {
        $row = DeliveryNote::query()->find($id);
        $data = $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
            'status' => 'required'
        ]);

        $row->update($data);
        userLog::create([
            'user_name'=>Auth('admin')->user()->name,
            'user_id'=>Auth('admin')->user()->id,
            'columnAction'=>'تحديث ملاحظة شحن',
            'logMessage'=>"تـم تحديث ملاحظة شحن بنجاح بواسطة"  . auth('admin')->user()->name,
        ]);

        return redirect()->route('dashboard.' . $this->name . '.index')->with('success', __('admin.update_success'));
    }
}
