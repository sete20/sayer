<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ConfigController extends Controller{

    public function edit()
    {
        $configs = Config::all();

        return view('dashboard.config',compact('configs'));
    }

    public function update(Request $request)
    {
        $requestedConfigs = $request->except(['_token']);
        foreach ($requestedConfigs as $index=>$value)
        {
            $config = Config::query()->where('var',$index)->first();
            if ($config->type != 2)
            {
                $config->update(['value' => $value]);
            }
            else
            {
                $image = $request->file($index);
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('dashboard/uploads/configs');
                $image->move($destinationPath, $name);
                $config->update(['value' => $name]);
            }
        }
        Session::flash('success',__('admin.edit_success'));
        return redirect()->route('dashboard.configs.edit');
    }
}
