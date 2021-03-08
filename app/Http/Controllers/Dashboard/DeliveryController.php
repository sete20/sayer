<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\City;
use App\Models\State;
use App\Models\CompanyProfile;
use App\Models\Country;
use App\Models\Delivery;
use App\Models\DeliveryNote;
use App\Models\PersonalProfile;
use App\Models\Service;
use App\Models\ServiceCost;
use App\Models\User;
use App\Models\UserCommission;
use App\Models\UserDelivery;
use App\Models\VerifyOrderStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\userLog;
use App\Models\{Admin,delayOrder, canceledOrder, EmployeeIndividualProfile};
use Validator;

class DeliveryController extends DashboardController {

    protected $name = 'deliveries';

    public function __construct(Delivery $row)
    {
        parent::__construct($row);
    }

    public function index(Request $request)
    {
        // dd($request->all());
        $cities =  City::query()->where('country_id',1)->get();
        $states = null;
        $deliveryQuery = Delivery::query();
        if ($request->has('status')) {
            $deliveryQuery->where('status',$request->status);
        }
        if ($request->has('city_id')) {
            if($request->city_id != 0) {
                $deliveryQuery->where('city_id',$request->city_id);
            }
        }
        if ($request->has('region')) {
            if($request->region != 0) {
                $deliveryQuery->where('state_id',$request->region);
                $states = State::query()->where('city_id',$request->city_id)->get();
            }
        }
        if ($request->has('user_id')) {
            if($request->user_id != 0) {
                $deliveryQuery->where('user_id',$request->user_id);
            }
        }
        if ($request->has('representative_id')) {
            if($request->representative_id != 0) {
                $deliveryQuery->whereHas('representative', function($q) use($request){
                    $q->where('user_id', $request->representative_id);
                });
            }
        }

        if ($request->has('from')) {
            if($request->from != 0) {
                $deliveryQuery->where('received_date','>=',$request->from);
            }
        }

        if ($request->has('to')) {
            if($request->to != 0) {
                $deliveryQuery->where('received_date','<=',$request->to);
            }
        }
        if($request->has('trackMethod') && $request->has('trackKey') && !empty($request->trackKey)){
           $request->trackMethod === "byOrderNumber" ? $deliveryQuery->where('track_delivery_number',$request->trackKey) :"";
           $request->trackMethod === "byPhoneNumber" ? $deliveryQuery->where('consignee_phone',$request->trackKey) :"";
           $request->trackMethod === "byUserEmail" ? $user = User::where('email',$request->trackKey)->firstOrFail() : "";
           $request->trackMethod === "byUserEmail" ? $deliveryQuery->where('user_id',$user->id) :"";
        }


        $rows = $deliveryQuery->get();
        $users = User::query();

        return view('dashboard.'.$this->name .'.index',compact('states','rows','users','cities'));
    }

    public function create()
    {
        if (request('type_id') == 1)
        {
            $users = User::query()->whereIn('type',[1,2])->get();
            $cities = City::query()->where('country_id',request('country_id'))->get();
            $services = Service::query()->where('type',1)->where('status',1)->get();
            $deliveryNotes = DeliveryNote::query()->where('status',1)->get();
            return view('dashboard.'.$this->name .'.localCreate',compact('deliveryNotes','users','cities','services'));
        }
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'country_id' => 'required|numeric',
            'type_id' => 'required|in:1,2,3,4',
            'user_id' => 'required|numeric|not_in:0',
            'consignee' => 'required|max:180',
            'consignee_phone' => 'required',
            'consignee_telephone' => 'sometimes|nullable',
            'consignee_address' => 'required',
            'city_id' => 'required|numeric|not_in:0',
            'state_id' => 'required|numeric|not_in:0',
            'service_id' => 'required|numeric|not_in:0',
            'received_date' => 'required|date',
            'package_number' => 'required|numeric|not_in:0',
            'weight_in_kilo' => 'sometimes|nullable',
            'delivery_amount_from' => 'required|in:1,2',
            'home_number' => 'sometimes|nullable',
            'notes' => 'sometimes|nullable',
            'coupon_code' => 'sometimes|nullable',
            'order_price' => 'required|nullable',
        ]);

        if($validation->fails())
        {
            return response()->json(['errors'=>$validation->errors()->all(),'status'=>0]);
        }
        $data = $request->all();
        // addional informations
        $data['status'] = 1;
        $data['track_delivery_number'] = $this->generateRandomString();
        // Calculate Total Price
        $serviceCost = ServiceCost::query()
            ->where('service_id',$request->service_id)
            ->where('state_id',$request->state_id)
            ->first();

        // first (Service Price Cost)
        $serviceCostPrice = $serviceCost->cost;

        // second Plus Kilos Cost
        if ($data['weight_in_kilo'] > 5) {
            $percentageOfIncrease = $data['weight_in_kilo'] - 5;
            $weight_kilos_price = $percentageOfIncrease;
        } else {
            $weight_kilos_price = 0;
        }

        // third Plus Packages Cost
        if ($data['package_number'] > 1) {
            $percentageOfIncrease = $data['package_number'] - 1;
            $percentageOfIncreaseInEmarate = $percentageOfIncrease * 3;
            $package_nums_price = $percentageOfIncreaseInEmarate;
        } else {
            $package_nums_price = 0;
        }

        // forth Order Price Only
        $order_price = $data['order_price'];

        // fifth sender or consignee
        if(request('delivery_amount_from') == 1) {
            $data['total_price'] = $order_price;
        } elseif (request('delivery_amount_from') == 2) {
            $data['total_price'] = $serviceCostPrice + $weight_kilos_price + $package_nums_price + $order_price;
        }


        $data['order_number'] = Carbon::now()->format('YmdHs') . rand(10,10);
       $delivery = Delivery::query()->create($data);
        if( $request->delegate_id && $request->from_home_or_office == 1){
            UserDelivery::create([
                'user_id' => $request->delegate_id,
                'delivery_id' => $delivery->id
            ]);

            $user = User::query()->find($request->delegate_id);
            if ($user->type == 2) {
                Delivery::find($delivery->id)->update([
                    'status' => 2
                ]);
            } else {
                Delivery::find($delivery->id)->update([
                    'status' => 4
                ]);
            }

        }
        userLog::create([
            'user_name'=>Auth('admin')->user()->name,
            'user_id'=>Auth('admin')->user()->id,
            'columnAction'=>'اضافة شحن',
            'logMessage'=>"تـم انـشاء طلب شحن بنجاح بواسطة"  . auth('admin')->user()->name,
        ]);

        // assign delivery notes
        $delivery->notes()->sync($request->delivery_notes);

        return response()->json(['errors'=>null,'status'=>1]);
    }

    public  function generateRandomString($length = 20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function show($id)
    {
        if (request('type_id') == 1)
        {
            $delivery = Delivery::query()->find($id);
            $user = User::query()->find($delivery->user_id);
            if ($user->type == 4) {
                $profile = PersonalProfile::query()->where('user_id',$user->id)->first();
            } elseif($user->type == 3) {
                $profile = CompanyProfile::query()->where('user_id',$user->id)->first();
            }
            $serviceCost = ServiceCost::query()
                ->where('service_id',$delivery->service_id)
                ->where('state_id',$delivery->state_id)
                ->first();
            $deliveryNotes = DeliveryNote::query()->where('status',1)->get();
            return view('dashboard.'.$this->name .'.localShow',compact('deliveryNotes','delivery','profile','user','serviceCost'));
        }
    }

    public function update(Request $request,$id)
    {
        $row = Delivery::query()->find($id);
        $data = $request->validate([
            'type_id' => 'required|in:1,2,3,4',
            'user_id' => 'required',
            'consignee' => 'required',
            'consignee_phone' => 'required',
            'consignee_telephone' => 'required',
            'consignee_address' => 'required',
            'country_id' => 'required',
            'city_id' => 'required',
            'state_id' => 'required',
            'service_id' => 'required',
            'status' => 'required'
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
    public function filter_orders(request $request){
        // return $request->all();
        return" hi";
        // return view('dashboard.categories.create');
    }
    public function deliveryUsers(Request $request)
    {
        // if he was person
        if ($request->type_id == 1)
        {
//            $users = User::query()->where('type',4)->get();
            $users = PersonalProfile::query()->whereHas('user',function ($query) use ($request) {
                return $query->where('type',4);
            })->get();
        }
        // if he was seller
        else {
//            $users = User::query()->where('type',3)->get();
            $users = CompanyProfile::query()->whereHas('user',function ($query) use ($request) {
                return $query->where('type',3);
            })->get();
        }

        return response()->json(['users'=>$users]);
    }

    public function deliveriesServiceGet(Request $request)
    {
        $serviceCost = ServiceCost::query()
            ->where('service_id',$request->service_id)
            ->where('state_id',$request->state_id)
            ->first();

        return response()->json($serviceCost);
    }

    public function userDetails(Request $request)
    {
        $user = User::query()->find($request->user_id);
        if ($user->type == 4) {
            $profile = PersonalProfile::query()->with(['country','city','state'])->where('user_id',$user->id)->first();
        } elseif($user->type == 3) {
            $profile = CompanyProfile::query()->with(['country','city','state'])->where('user_id',$user->id)->first();
        }
        return response()->json(['profile'=>$profile,'user'=>$user]);
    }
   public function canceled_orders(){
       $canceled_orders = Delivery::where('status',6)->first();
       return $canceled_orders;
   }
    public function addOrderDelegate(Request $request)
    {
        $user = User::find($request->user_id);
        foreach ($request->deliveryIds as $deliveryId) {
            UserDelivery::query()->create(['user_id'=>$request->user_id,'delivery_id'=>$deliveryId,'status' => $user->type == 1 ? 4 : 2]);
            Delivery::query()->find($deliveryId)->update(['status' => $user->type == 1 ? 4 : 2]);
        }

        return response()->json();
    }

    public function addOrderDelegateDeliver(Request $request)
    {
        $user = User::find($request->user_id);
        $userDeliveries = UserDelivery::query()->whereIn('delivery_id',$request->deliveryIds)->delete();
        foreach ($request->deliveryIds as $deliveryId) {
            UserDelivery::query()->create(['user_id'=>$request->user_id,'delivery_id'=>$deliveryId,'status' => 5]);
            Delivery::query()->find($deliveryId)->update(['status' => 5]);
        }

        return response()->json();
    }
    public function DelegateOrders($id){
        $order_id = UserDelivery::where('user_id',$id)->pluck('delivery_id');
        // dd($order_id);
        $orders = Delivery::whereIn('id',$order_id)->get();
        // dd($orders);
        $user = User::query()->find($id);
        return view('dashboard.users.delegateOrders',compact('orders','user'));
    }
    public function DeleteOrderDelegate($id)
    {
        $order_id =Delivery::Find($id)->update([
            'status'=>'1'
        ]);
        $user_order =UserDelivery::where('delivery_id',$id)->delete();
            return redirect()->back();
        // UserDelivery::query()->create();
        return response()->json();
    }

    public function verifyOrderInOfficeStatus(Request $request)
    {
        $delivery = Delivery::query()->find($request->delivery_id);
        // The Relation Between the $representative and Delivery
        $representativeDelivery = UserDelivery::query()
            ->where('delivery_id',$delivery->id)
            ->first();

        $verifyOrderStatus = VerifyOrderStatus::query()
            ->where('shipping_representative',$representativeDelivery->user_id)
            ->where('order_id',$delivery->id)
            ->where('status',0)
            ->first();

        // Update Question Verify
        $verifyOrderStatus->update(['status' => 1]);
        // Update Order Status
        $delivery->update(['status' => 4]);

            $serviceCost = ServiceCost::query()
                ->where('service_id',$delivery->service_id)
                ->where('state_id',$delivery->state_id)
                ->first();
            // UserCommission::create([
            //     'user_id'=>$representativeId,
            //     'delivery_id'=>$delivery->id,
            //     'commission'=>$final_commission_money_result
            // ]);

        // Finally Delete the representative relation and Add New with Employee
        $representativeDelivery->delete();
        $userDelivery = UserDelivery::create([
            'user_id' => $request->user_id,
            'delivery_id' => $delivery->id
        ]);

        return response()->json();
    }

    public function calculateThePercentageOfReceiptReciveing($service_cost,$representativeId,$deliveryId)
    {
        $user = User::query()->find($representativeId);

        // Delivery Commission Logic
        $final_commission_money_result = ($user->profile->receiving_commission * $service_cost) / 100;
        UserCommission::create(['user_id'=>$representativeId,'delivery_id'=>$deliveryId,'commission'=>$final_commission_money_result]);
        return $final_commission_money_result;
    }

    public function deliveriesRemoveDeliveries(Request $request)
    {
        foreach ($request->deliveryIds as $deliveryId) {
            Delivery::query()->find($deliveryId)->update(['status' => 8]);
        }

        return redirect()->back();
    }

    public function invoice($delivery_id)
    {
        $row = Delivery::query()->find($delivery_id);
        $sender = User::query()->find($row->user_id);
        if($sender->type == 3) {
            $senderProfile = CompanyProfile::query()->where('user_id',$row->user_id)->first();
        } else {
            $senderProfile = PersonalProfile::query()->where('user_id',$row->user_id)->first();
        }
        return view('dashboard.deliveries.invoice',compact('row','senderProfile'));
    }


    public function DelayOrder(Request $request) {
        $delivery = Delivery::find($request->order_id);
        $delivery->update(['status' => 7]);
        delayOrder::create([
           'sender_id'=>$delivery->user_id,
           'order_id'=> $delivery->id,
           'actionBy'=>Auth('admin')->user()->id,
           'dateOfDelay'=>$request->dateDelay,
           'reasonOfDelay'=>$request->reasonOfDelay
        ]);

        return response()->json($delivery);
    }


    public function cancelOrder(Request $request){

        $Order = Delivery::find($request->order_id);
        $Order->update(['status' => 8]);
        canceledOrder::create([
           'sender_id'=>$Order->user_id,
           'order_id'=> $Order->id,
           'actionBy'=>Auth('admin')->user()->id,
           'reasonOfCancellation'=>$request->reasonOfCancel
        ]);
        return response()->json($Order);
    }

    public function confirmOrdersToOffice(Request $request)
    {
        $user = User::find($request->user_id);
        foreach ($request->deliveryIds as $deliveryId) {
            $user_old_delivery_relation = UserDelivery::query()->where('delivery_id', $deliveryId)->first();

            UserDelivery::query()->create(['user_id' => $request->user_id,'delivery_id' => $deliveryId,'status' => 4]);

            Delivery::query()->find($deliveryId)->update(['status' => 4]);

            $representative = EmployeeIndividualProfile::query()
                ->where('user_id',$user_old_delivery_relation->user_id)
                ->first();

            UserCommission::create([
                'user_id'=> $user_old_delivery_relation->user_id,
                'delivery_id'=>$deliveryId,
                'commission'=>$representative->delivery_commission
            ]);

            $user_old_delivery_relation->delete();
        }

        return response()->json();
    }
    public function tracking_timeline($id){
        $order = Delivery::find($id)->first();
        $user = User::where('id',$order->user_id)->first();
        $delegateAndOrder_id = UserDelivery::where('delivery_id',$id)->first();
        $delegate = User::find($delegateAndOrder_id->user_id)->first();
        $caneclHistory = canceledOrder::where('order_id',$id)->first();
    //    dd($admin_cancel );
        $delayHistroy = delayOrder::where('order_id',$id)->first();
       
        $delivering = UserDelivery::where('status','=',5)->where('delivery_id','=',$id)->first();
        // if (isset($delayHistroy)) {
        //     // dd($admin_delay);
        //     return view('dashboard.'.$this->name .'.deliveries_order.timeline',
        //   compact(
        //   'order','delegate','delivering'
        //   ,'delayHistroy','user','admin_delay'
        //   ,'delegateAndOrder_id'));
        // }

        if ($order->status == 8  && isset($caneclHistory)) {
            $caneclHistory->actionBy != null ? $admin_cancel = Admin::find($caneclHistory->actionBy)->first() :"";
                return view('dashboard.'.$this->name .'.deliveries_order.timeline',
                compact(
                'order','delegate'
                ,'user','admin_cancel','delivering'
                ,'delegateAndOrder_id','caneclHistory'));
                }
                elseif ($delayHistroy) {
                    $delayHistroy->actionBy != null ?  $admin_delay = Admin::find($delayHistroy->actionBy)->first() :"";
                    return view('dashboard.'.$this->name .'.deliveries_order.timeline',
                    compact(
                    'order','delegate'
                    ,'user','admin_delay','delivering'
                    ,'delegateAndOrder_id','delayHistroy'));
                }
                    return view('dashboard.'.$this->name .'.deliveries_order.timeline',
                    compact('order','delegate'
                    ,'delayHistroy','user','delivering'
                    ,'delegateAndOrder_id','caneclHistory'));
    }
}
