<?php

namespace App\Http\Requests\Team;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrEditProjectReportRequest extends FormRequest
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
            'employee_id' => ['required', 'exists:users,id'],
            'project_id' => ['required', 'exists:projects,id'],
            'time' => ['required', 'numeric', 'min:0', 'max:540'],
            'status_id' => ['required', 'exists:project_statuses,id'],
            'update_date' => ['required', 'date'],
            'comment' => ['nullable', 'max:1000']
        ];
    }
}
