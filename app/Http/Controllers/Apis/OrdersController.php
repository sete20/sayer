<?php

namespace App\Http\Controllers\Apis;
use App\Models\{Delivery,UserDelivery,User,UserCommission,ServiceCost,VerifyOrderStatus,CompanyProfile,PersonalProfile,EmployeeIndividualProfile};
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function orders () {
        // user_id used instead Auth id just for testing
        $user_id = UserDelivery::where('user_id',auth('api')->user()->id)->get();
        // array of order ids
        $order_ids = $user_id->pluck('delivery_id');
        // orders where in order ids
        $orders = Delivery::whereIn('id',$order_ids)
            ->whereIn('status',[2,3])
            ->with('user')
            ->get();

        // returned orders
        return response()->json($orders);
    }


    public function order ($id) {
        // user_id used instead Auth id just for testing
        $user_id = UserDelivery::where('user_id',auth('api')->user()->id)->get();
        // array of order ids
        $order_ids = $user_id->pluck('delivery_id');
        // orders where in order ids
        $order = Delivery::whereIn('id',$order_ids)
            ->whereIn('status',[2,3])
            ->with(['country','city','state','service','notes'])
            ->where('id',$id)
            ->first();

        $receiver = User::find($order->user_id);

        if ($receiver->type == 3) {
            $profile = CompanyProfile::with(['country','city','state'])->where('user_id',$receiver->id)->first();
        } else if($receiver->type == 4) {
            $profile = PersonalProfile::with(['country','city','state'])->where('user_id',$receiver->id)->first();
        }

        $service_cost = ServiceCost::query()
            ->where('service_id',$order->service_id)
            ->where('state_id',$order->state_id)
            ->first()->cost;
        // returned order
        return response()->json(['service_cost'=>$service_cost,'order'=>$order,'receiver'=> $receiver,'profile'=>$profile]);
    }


    public function updateStatusToThree(request $request){
        // check order id
        if ($request->order_id) {
            $delivery = Delivery::query()->find($request->order_id);
            if ($delivery->status == 2) {
                $delivery->update(['status' => 3]);

                return response([
                    'message' => 'Success',
                ], 202);
            } else {
                return response([
                    'message' => 'Can not Change Status',
                ], 202);
            }
        }
        return response([
            'message' => 'Not Found',
         ], 410);
    }

    public function updateStatusAndVerify(request $request){
        // check order id
        if ($request->order_id) {
            $delivery = Delivery::query()->find($request->order_id);
            if ($delivery->status == 3 ) {
                $delivery->where('id',$request->order_id)->update(['status'=>4]);
                $representative = EmployeeIndividualProfile::query()
                    ->where('user_id',auth('api')->user()->id)
                    ->first();
                $commission = UserCommission::create([
                    'user_id'=> auth('api')->user()->id,
                    'delivery_id'=>$delivery->id,
                    'commission'=>$representative->delivery_commission,
                    'service_type'=>'Collection'
                ]);
                $user_delivery = UserDelivery::query()
                ->where('user_id',auth('api')->user()->id)
                ->where('delivery_id',$delivery->id)
                ->first();

                $user_delivery->delete();

                return response([
                    'message' => 'Success',
                ], 202);
            } else {
                return response([
                    'message' => 'You Cant Change Status',
                ], 202);
            }
        }
        return response([
            'message' => 'Not Found',
         ], 410);
    }
    
    public function updateStatusToComplete(request $request){
        // check order id
        if ($request->order_id) {
            $delivery = Delivery::query()->find($request->order_id);
            if ($delivery->status == 5 ) {
                $delivery->where('id',$request->order_id)->update(['status'=>6]);
                $representative = EmployeeIndividualProfile::query()
                ->where('user_id',auth('api')->user()->id)
                ->first();
                $commission = UserCommission::create([
                    'user_id'=> auth('api')->user()->id,
                    'delivery_id'=>$delivery->id,
                    'commission'=>$representative->receiving_commission,
                    'service_type'=>'Delivery'
                ]);
                // $user_delivery = UserDelivery::query()
                // ->where('user_id',auth('api')->user()->id)
                // ->where('delivery_id',$delivery->id)
                // ->first();

                // $user_delivery->delete();
                return response([
                    'message' => 'Success',
                ], 202);
            } else {
                return response([
                    'message' => 'You Cant Change Status',
                ], 202);
            }
        }
        return response([
            'message' => 'Not Found',
         ], 410);
    }

}
