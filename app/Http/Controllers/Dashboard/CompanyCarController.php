<?php

namespace App\Http\Controllers\Dashboard;
use File;
use App\Http\Controllers\Controller;
use App\Http\Requests\companyCarsRequest;
use Illuminate\Http\Request;
use App\Models\companyCar;
use App\Models\userLog;
Use App\Models\User;
class CompanyCarController extends DashboardController
{
    protected $name = 'company-cars';

    public function __construct(companyCar $row)
    {
        parent::__construct($row);
    }

    public function store(companyCarsRequest $request)
    {
        $companyCars = $request->validated();

        if ($request->hasFile('ownershipImage')) {
            $image = $request->file('ownershipImage');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/dashboard/uploads/companyCars/ownershipImages');
            $image->move($destinationPath, $name);
            $companyCars['ownershipImage'] = $name;
        }
            companyCar::query()->create($companyCars);
            userLog::create([
                'user_name'=>Auth('admin')->user()->name,
                'user_id'=>Auth('admin')->user()->id,
                'columnAction'=>$companyCars['trafficCode'],
                'logMessage'=>"تـم اضافة سيارة بواسطة"  .auth('admin')->user()->name,
                      ]);
            return redirect()->route('dashboard.' . $this->name . '.index')->with('success', __('admin.store_success'));
    }


    public function update(companyCarsRequest $request, $id)
    {
        dd($request->user_id);
        $companyCars = $request->validated();
        $old_image = companyCar::query()->find($id,'ownershipImage');

            if ($request->hasFile('ownershipImage')) {
                $image = $request->file('ownershipImage');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/dashboard/uploads/companyCars/ownershipImages');
                $image->move($destinationPath, $name);
                $companyCars['ownershipImage'] = $name;
            }

        companyCar::query()->find($id)->update($companyCars);
        userLog::create([
            'user_name'=>Auth('admin')->user()->name,
            'user_id'=>Auth('admin')->user()->id,
            'columnAction'=>$companyCars['trafficCode'],
            'logMessage'=>"تـم التعديل عل السيارة بواسطة"  . auth('admin')->user()->name,
                  ]);

                  if($request->user_id){
                      dd($request->user_id);
                  }
        return redirect()->route('dashboard.' . $this->name . '.index')->with('success', __('admin.update_success'));
    }
    public function Add_driver($id){

            $Car= companyCar::find($id);
            $Users = User::where('type',1)->get();
            return view('dashboard.companyCars.addDriver',compact('Users','Car'));

    }
    public function Add_driver_update(Request $request){
        if($request->has(('user_id'))){
            $companyCar = companyCar::find($request->car_id);

            $companyCar->update([
                    'user_id'=>$request->user_id
                ]);

            userLog::create([
                'user_name'=>Auth('admin')->user()->name,
                'user_id'=>Auth('admin')->user()->id,
                'columnAction'=>$companyCar['trafficCode'],
                'logMessage'=>  "تم اضافة عهدة السيارة رقم " .$companyCar['trafficCode']. "بواسطة"   . auth('admin')->user()->name,
                      ]);
            return response()->json($companyCar);
        }
    }
    public function remove_driver($id){
            $companyCars = companyCar::find($id)->update([
                'user_id'=> 0
            ]);
            $car = companyCar::where('id',$id)->first();
            userLog::create([
                'user_name'=>Auth('admin')->user()->name,
                'user_id'=>Auth('admin')->user()->id,
                'columnAction'=>$car['trafficCode'],
                'logMessage'=>"تم انهاء عهدة السيارة رقم " . $car['trafficCode'] . "بواسطة"   . auth('admin')->user()->name,
                ]);
            return redirect()->back()->with('success', __('admin.destroy_success'));
    }

    public function addSelectDriver()
    {
        $users = User::where('type',2)->get();
        return response()->json($users);
    }

}

