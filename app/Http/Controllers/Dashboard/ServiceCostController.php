<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Service;
use App\Models\Country;
use App\Models\ServiceCost;
use App\Models\State;
use Illuminate\Http\Request;

class ServiceCostController extends Controller {

    public function index()
    {
        $countries = Country::query()->get();
        if (request()->has('city_id') && request()->has('country_id')) {
            $states = State::query()
                ->with(['country','city','services'])
                ->where('city_id',request('city_id'))
                ->where('status',1)
                ->get();
            $services = Service::query()
                ->with(['states'])
                ->where('status',1)
                ->select(['id','name_'.App()->getLocale().' as name'])
                ->get();
            $cities = City::query()->where('country_id',request('country_id'))->get();
        } else {
            $states = null;
            $services = null;
            $cities = null;
        }

        return view('dashboard.service-costs.index',compact('countries','states','services','cities'));
    }

    public function update(Request $request)
    {
        $states = State::query()
            ->where('city_id',$request->city_id)
            ->where('status',1)
            ->get();
        $requestStatesValues = $request->except(['country_id','city_id','_token']);
        foreach ($states as $state)
        {
            foreach ($requestStatesValues as $stateId=>$costServiceValues)
            {
                if ($state->id == $stateId)
                {
                    $state->services()->sync([]);
                    foreach ($costServiceValues as $serviceId=>$costServiceValue)
                    {
                        ServiceCost::query()->create(['state_id'=>$state->id,'service_id'=>$serviceId,'cost'=>$costServiceValue]);

                    }
                }
            }
        }

        return redirect()->back()->with('success', __('admin.update_success'));
    }

    public function relatedCountryCities(Request $request)
    {
        $cities = City::query()
            ->where('country_id',$request->country_id)
            ->where('status',1)
            ->has('states')
            ->select(['id','name_'.App()->getLocale().' as name'])
            ->get();

        return response()->json($cities);
    }

    public function relatedCityStates(Request $request)
    {
        $states = State::query()
            ->with(['country','city','services'])
            ->where('city_id',$request->city_id)
            ->where('status',1)
            ->get();

        $services = Service::query()
            ->with(['states'])
            ->where('status',1)
            ->select(['id','name_'.App()->getLocale().' as name'])
            ->get();

        return response()->json(['states' => $states,'services'=>$services]);
    }
}
