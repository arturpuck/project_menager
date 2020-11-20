<?php

namespace App\Http\Requests\Team;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\YearWhenCompanyExisted;
use Illuminate\Http\Exceptions\HttpResponseException;

class FilterEmployeeReportsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        
        if($userId = request()->get('employee_id')){

            if(\Auth::user()->canModifyOrEditOtherUser($userId)){
                return true;
            }
            else{
               throw new HttpResponseException(response('you_are_not_allowed_to_see_this_user_data'),403);
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
            'employee_id' => ['required', 'exists:users,id'],
            'month' => ['nullable', 'numeric', 'min:1', 'max:12'],
            'year' => ['nullable',new YearWhenCompanyExisted()]
        ];
    }

    public function messages(){

        return [
            'employee_id.required' => 'employee_id_is_missing',
            'employee_id.exists' => "employee_does_not_exist",
            'month.numeric' => 'month_must_be_a_numeric_symbol_between_01_and_12',
            'month.min' => 'month_must_be_greather_than_zero',
            'month.max' => 'month_must_be_less_or_equal_twelve'
        ];
    }
}
