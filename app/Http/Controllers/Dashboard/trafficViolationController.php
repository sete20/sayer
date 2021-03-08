<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\trafficViolation;
use App\Http\Requests\trafficViolationRequest;
use App\Models\userLog;
use App\Models\companyCar;
use App\Models\User;
use DB;
class trafficViolationController extends Controller
{
    public function index()
    {
        $trafficViolations = DB::table('traffic_violations')
        ->join('company_cars', 'traffic_violations.car_id', 'company_cars.id')
        ->select('traffic_violations.*', 'company_cars.trafficID','company_cars.vehicleNumber')
        ->get();
        // dd($trafficViolations);
        return view('dashboard.trafficViolations.index',compact('trafficViolations'));
    }


    public function create($id, $user_id=null)
    {
        if(!empty($user_id)){
            return view('dashboard.trafficViolations.create',compact('user_id','id'));
        }
        return view('dashboard.trafficViolations.create',compact('id'));

    }


    public function store(trafficViolationRequest $request,$id,$user_id=null)
    {
        $violations = $request->validated();
        if ($request->hasFile('violation_image')) {
            $image = $request->file('violation_image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/dashboard/uploads/violationImage/violation_image');
            $image->move($destinationPath, $name);
            $violations['violation_image'] = $name;
        }
        if(!empty($user_id)){
            $violations['user_id']= $user_id;
            $violations['car_id'] = $id;
        }
        else{
            $user_id=0;
            $violations['user_id']= $user_id;
            $violations['car_id'] = $id;
        }

        trafficViolation::create($violations);
        userLog::create([
            'user_name'=>Auth('admin')->user()->name,
            'user_id'=>Auth('admin')->user()->id,
            'columnAction'=>$violations['car_id'],
            'logMessage'=>"تـم انـشاء مخالفة  بواسطة"  . auth('admin')->user()->name. "للسيارة رقم" . $violations['car_id'],
                  ]);
        return redirect()->route('dashboard.violations.index')->with('success', __('admin.store_success'));

    }

    public function edit($id)
    {
        $trafficViolation = trafficViolation::find($id)->first();
        return view('dashboard.trafficViolations.edit',compact('trafficViolation'));
    }

    public function update(trafficViolationRequest $request, $id)
    {
        $violations = $request->validated();
        if ($request->hasFile('violation_image')) {
            $image = $request->file('violation_image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/dashboard/uploads/violationImage/violation_image');
            $image->move($destinationPath, $name);
            $violations['violation_image'] = $name;
        }
        trafficViolation::find($id)->update($violations);
        $car = trafficViolation::find($id)->first();
        userLog::create([
            'user_name'=>Auth('admin')->user()->name,
            'user_id'=>Auth('admin')->user()->id,
            'columnAction'=>$car['car_id'],
            'logMessage'=>"تـم تعديل مخالفة  بواسطة"  . auth('admin')->user()->name. "للسيارة رقم" . $car['car_id'],
                  ]);
        return redirect()->route('dashboard.violations.index')->with('success', __('admin.update_success'));
    }



}
