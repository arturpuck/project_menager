<?php

namespace App\Http\Requests\Team;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateEmployeeDataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($employeeId = request()->get('id')){
           return \Auth::user()->canModifyOrEditOtherUser($employeeId);
        }
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
            'id' => ['required', 'exists:users,id'],
            'full_name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'email'],
            'phone_number' => ['required', 'string', 'max:20'],
            'role_id' => ['required', 'numeric', 'exists:roles,id'],
            'rate_per_hour_set_by_deal' => ['required', 'numeric'],
            'rate_per_month' => ['required', 'numeric'],
            'real_rate_per_hour' => ['nullable', 'numeric'],
            'note' => ['nullable', 'string', 'max:1000'],
            'positions_ids.*' => ['required', 'exists:positions,id'],
            'skills_ids.*' => ['required', 'exists:skills,id']  
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->messages()->all(),400));
    }
}
