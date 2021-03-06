<?php

namespace App\Http\Requests\Team;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Rules\CurrentUserCanModifyRole;

class UpdateEmployeeDataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($userId = request()->get('id')){

            if(\Auth::user()->canModifyOrEditOtherUser($userId)){
                return true;
            }
            else{
               throw new HttpResponseException(response('you_are_not_allowed_to_modify_this_user_data'),403);
            }
        }
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
            'role_id' => ['nullable', 'numeric', 'exists:roles,id', new CurrentUserCanModifyRole()],
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
