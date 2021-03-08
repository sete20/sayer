<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\companyAsset;
use App\Models\Custody;
use App\Models\User;
use Illuminate\Http\Request;

class CustodyController extends DashboardController {

    protected $name = 'custodies';

    public function __construct(Custody $row)
    {
        parent::__construct($row);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|numeric',
            'company_asset_id' => 'required|numeric',
            'quantity' => 'required|numeric',
            'delivery_date' => 'required|date'
        ]);

        $companyAsset = companyAsset::query()->find($request->company_asset_id);
        if ($request->has('company_asset_id'))
        {
            if ($companyAsset->quantity < $request->quantity)
            {
                return redirect()->back()->withErrors(['يجب ان تكون الكمية اقل من الكمية الموجودة في الاصل او تساويها']);
            }
        }

        Custody ::query()->create($data);
        $companyAsset->update(['quantity' => $companyAsset->quantity - $request->quantity]);

        return redirect()->route('dashboard.' . $this->name . '.index')->with('success', __('admin.store_success'));
    }

    public function update(Request $request,$id)
    {
        $row = Custody ::query()->find($id);
        $data = $request->validate([
            'user_id' => 'required|numeric',
            'company_asset_id' => 'required|numeric',
            'quantity' => 'required|numeric',
            'delivery_date' => 'required|date'
        ]);

        // return the quantity to the original asset
        $companyAsset = companyAsset::query()->find($request->company_asset_id);
        $companyAsset->update(['quantity'=> $companyAsset->quantity + $row->quantity]);
        if ($request->has('company_asset_id'))
        {
            if ($companyAsset->quantity < $request->quantity)
            {
                return redirect()->back()->withErrors(['يجب ان تكون الكمية اقل من الكمية الموجودة في الاصل او تساويها']);
            }
        }

        $row->update($data);
        // remove the taken quantity from the original asset
        $companyAsset->update(['quantity' => $companyAsset->quantity - $request->quantity]);

        return redirect()->route('dashboard.' . $this->name . '.index')->with('success', __('admin.update_success'));
    }

    public function destroy($id)
    {
        $row = Custody::query()->find($id);

        // return the quantity to the original asset
        $companyAsset = companyAsset::query()->find($row->company_asset_id);
        $companyAsset->update(['quantity'=> $companyAsset->quantity + $row->quantity]);

        $row->delete();

        return redirect()->back()->with('success', __('admin.destroy_success'));
    }

    public function setPassParams($params = [])
    {
        $params['companyAssets'] = companyAsset::query()->where('quantity','>',0)->get();
        $params['users'] = User::query()
            ->where('status',1)
            ->whereIn('type',[1,2])->get();
        return $params;
    }
}
