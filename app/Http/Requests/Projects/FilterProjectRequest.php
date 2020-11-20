<?php

namespace App\Http\Requests\Projects;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\YearWhenCompanyExisted;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class FilterProjectRequest extends FormRequest
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
            'client_id' => ['nullable','exists:clients,id'],
            'task_id' => ['nullable', 'exists:tasks,id'],
            'status_id' => ['nullable', 'exists:project_statuses,id'],
            'month' => ['nullable', 'min:1', 'max:12'],
            'year' => ['nullable',new YearWhenCompanyExisted()],
        ];
    }

    public function messages(){
        
        return [
            'client_id.exists' => 'selected_client_does_not_exist',
            'task_id.exists' => 'selected_task_does_not_exist',
            'status_id.exists' => 'selected_status_does_not_exist',
            'month.min' => 'invalid_month_must_be_at_least_one',
            'month.max' => 'invalid_month_must_be_less_or_equal_twelve'
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json($validator->messages()->all(),400));
    }
}
