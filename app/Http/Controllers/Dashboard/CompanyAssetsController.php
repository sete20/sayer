<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\companyAssetsRequest;
use Illuminate\Http\Request;
use App\Models\companyAsset;
use App\Models\userLog;
class CompanyAssetsController  extends DashboardController
{
    protected $name = 'company-assets';

    public function __construct(companyAsset $row)
    {
        parent::__construct($row);
    }

    public function store(companyAssetsRequest $request)
    {
        $company_assets_request = $request->validated();
        companyAsset::create($company_assets_request);
        userLog::create([
            'user_name'=>Auth('admin')->user()->name,
            'user_id'=>Auth('admin')->user()->id,
            'columnAction'=>$company_assets_request['assetName'],
            'logMessage'=>"تـم انـشاء اصل بواسطة"  . auth('admin')->user()->name,
                  ]);
        return redirect()->route('dashboard.' . $this->name . '.index')->with('success', __('admin.store_success'));
    }

    public function update(companyAssetsRequest $request, $id)
    {
        $company_assets_request = $request->validated();
        companyAsset::find($id)->update($company_assets_request);
        userLog::create([
            'user_name'=>Auth('admin')->user()->name,
            'user_id'=>Auth('admin')->user()->id,
            'columnAction'=>$company_assets_request['assetName'],
            'logMessage'=>"تـم تحديث اصل بواسطة"  . auth('admin')->user()->name,
                  ]);
        return redirect()->route('dashboard.' . $this->name . '.index')->with('success', __('admin.update_success'));
    }

}
