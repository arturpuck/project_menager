<?php

namespace App\Http\Requests\Projects;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\EmployeeIDBelongsToAccount;
use App\Rules\EmployeeIDBelongsToProjectMenager;

class GetProjectsProfitabilityRequest extends FormRequest
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
            'project_id' => ['nullable', 'exists:projects,id'],
            'account_id' => ['nullable', new EmployeeIDBelongsToAccount()],
            'project_menager_id' => ['nullable', new EmployeeIDBelongsToProjectMenager()]
        ];
    }
}
