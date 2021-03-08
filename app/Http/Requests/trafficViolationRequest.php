<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class trafficViolationRequest extends FormRequest
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
            'car_id'=>'nullable|integer',
            'user_id'=>'nullable|integer',
            'violation_number'=>'required|string',
            'violation_date'=>'required|date',
            'violation_type'=>'required|string',
            'violation_status'=>'required|string|in:paid,unpaid',
            'violation_area'=>'required|string',
            'violation_image'=>'nullable|image|mimes:png,jpg',
            'violation_value' => 'required|regex:/^\d+(\.\d{1,2})?$/'
        ];
    }
}
