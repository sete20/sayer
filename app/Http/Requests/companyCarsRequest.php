<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class companyCarsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'Model'=>'required|string|max:32',
            'vehicleType'=>'required|string|max:32',
            'chassisNo'=>'required|string',
            "vehicleNumber"=>'required|numeric',
            'vehicleClass'=>"required|string|max:32",
            "licenseAuthority"=>"required|string|max:32",
            "ownershipType"=>"required|string|max:32",
            "trafficCode"=>"required|string|max:64",
            "registrationDate"=>"required|date|max:64",
            "registrationExpirationDate"=>"required|date|max:64",
            "insuranceDate"=>"required|date|max:64",
            "insuranceExpirationDate"=>"required|date|max:64",
            "insuranceCompany"=>"required|string|max:64",
            "ownershipImage"=> request()->isMethod('put') ? "sometimes|nullable|mimes:jpeg,png" : "required|image|mimes:jpeg,png",
            "trafficID"=>'required|max:64|string',
            "salikCardNo"=>'required|max:64|string',
            "aberCardNo"=>'required|max:64|string ',
            "Notice"=>"nullable|string|max:500",
            "status"=>"required|in:working,stopped,damaged,garage"
        ];
    }
}
