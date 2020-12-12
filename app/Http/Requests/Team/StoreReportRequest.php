<?php

namespace App\Http\Requests\Team;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Rules\MonthOfReport;
use App\Rules\YearWhenCompanyExisted;
use Illuminate\Validation\Rule;

class StoreReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($userId = request()->get('user_id'))
        {
            if(\Auth::user()->canModifyOrEditOtherUser($userId)){
                return true;
            }
            else{
               throw new HttpResponseException(response('you_are_not_allowed_to_modify_this_user_report'),403);
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
            'user_id' => ['required', 'exists:users,id'],
            'clockify_report_file' => ['required', 'file'],
            'reported_hours' => ['required', 'numeric', 'min:0', 'max:540'],
            'report_for_month' => ['required', new MonthOfReport()],
            'report_for_year' => ['nullable', Rule::requiredIf(!\Auth::user()->is_ordinary_team_member), new YearWhenCompanyExisted()]
        ];
    }

    public function messages(){

        return [
            'user_id.required' => 'user_id_is_missing',
            'user_id.exists' => 'user_with_this_id_does_not_exist',
            'clockify_report_file.required' => 'clockify_report_file_is_missing',
            'clockify_report_file.file' => 'clockify_report_file_is_invalid',
            'reported_hours.required' => 'reported_hours_are_missing',
            'reported_hours.numeric' => 'reported_hours_must_contain_numeric_value',
            'reported_hours.min' => 'reported_hours_must_be_greather_than_zero',
            'report_for_month.required' => 'month_report_is_required',
            'reported_hours.max' => 'reported_hours_exceed_540_hours',
            'report_for_year.required' => 'you_have_to_choose_year_if_you_are_not_an_ordinary_team_member'
        ];
    }
}
