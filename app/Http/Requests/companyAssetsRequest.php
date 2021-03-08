<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class companyAssetsRequest extends FormRequest
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
            'assetName'=>'required|max:40|min:3',
            'purchase_date'=>'required|date',
            'billNumber'=>'required|numeric',
            'supplier'=>'required|string|max:40|min:3',
            'quantity'=>'required|numeric|min:1',
            'specifications'=>'required|string|min:12',
            'status'=>'required|in:new,used,damaged,custody,stored'
        ];
    }
}
