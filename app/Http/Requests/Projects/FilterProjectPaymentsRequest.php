<?php

namespace App\Http\Requests\Projects;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\YearWhenCompanyExisted;

class FilterProjectPaymentsRequest extends FormRequest
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
            'status' => ['nullable', 'exists:payment_statuses,name'],
            'month' => ['nullable', 'numeric', 'min:1', 'max:12'],
            'year' => ['nullable',new YearWhenCompanyExisted()],
        ];
    }
}
