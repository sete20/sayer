<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserCommission;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CommissionController extends Controller {

    public function index(Request $request)
    {
        $representatives = User::query()->where('type',2)->get();
        $rows = User::query();

        if($request->has('representative_id'))
        {
            if( $request->representative_id != 0){
                $rows = $rows->where('id',$request->representative_id);
            }
        }

        $rows = $rows->whereHas('commissions')->with(['commissions' => function($query) use ($request){

            if ($request->has('isPaid'))
            {
                $query->where('isPaid',$request->isPaid)->orderByDesc('created_at');
            }
            if($request->has('from'))
            {
                if($request->from != '')
                {
                    $query->whereDate('created_at','>=',$request->from);
                }
            }
            if($request->has('to'))
            {
                if($request->to != '')
                {
                    $query->whereDate('created_at','<=',$request->to);
                }
            }
            if(!$request->has('from') && !$request->has('to'))
            {
                if($request->from != '' && $request->to != '')
                {
                    $query->whereDate('created_at',Carbon::today());
                }
            }

        }]);

        return view('dashboard.commissions.filters.earningsByDate',compact('rows','representatives'));
    }

    public function paid($id)
    {
        $row = UserCommission::query()->find($id);
        $row->update(['isPaid' => 1]);

        return redirect()->route('dashboard.commissions.index')->with('success', __('admin.update_success'));
    }
    public function filterByDate(){
        return view('dashboard.commissions.filters.earningsByDate');
    }
    public function ByDate(Request $request){
        return $request->all();
    }
}
