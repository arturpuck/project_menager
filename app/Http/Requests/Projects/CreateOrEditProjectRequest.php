<?php

namespace App\Http\Requests\Projects;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\EmployeeIDBelongsToProjectMenager;
use App\Rules\EmployeeIDBelongsToAccount;
use App\Rules\SkillsMatchEmployee;
use App\Models\Project;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;


class CreateOrEditProjectRequest extends FormRequest
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

    public static function getRules($workStages, $workStageEngagedPersons,int $projectID){

        return [
            'project_id' => ['nullable', 'exists:projects,id'],
            'project_name' => ['required', 'max:100', Rule::unique('projects', 'name')->ignore($projectID, 'id')],
            'project_menager_id' => ['required', new EmployeeIDBelongsToProjectMenager()],
            'account_id' => ['required', new EmployeeIDBelongsToAccount()],
            'work_stages.*' => ['required', 'exists:tasks,id'],
            'work_stage_engaged_persons.*' => ['required', 'exists:users,id', new SkillsMatchEmployee($workStages, $workStageEngagedPersons)],
            'work_stage_estimated_number_of_hours.*' => ['required', 'min:0', 'numeric'],
            'work_stage_estimated_ammount_of_money.*' => ['required', 'min:0', 'numeric'],
            'work_stage_date_start.*' => ['required', 'date_format:Y-m-d'],
            'work_stage_dead_line_date.*' => ['required', 'date_format:Y-m-d'],
            'payment_stage_names.*' => ['required', 'max:100'],
            'payment_ammounts.*' => ['required', 'min:0', 'numeric'],
            'payment_stage_dates.*' => ['required', 'date_format:Y-m-d'],
            'payment_status' => ['required', 'exists:payment_statuses,id'],
            'client_contact_person' => ['nullable', 'max:40'],
            'client_phone_number' => ['nullable', 'max:20'],
            'client_email' => ['nullable', 'email', 'max:40'],
            'client_id' => ['nullable', 'exists:clients,id'],
            'invoice_addres' => ['required', 'max:100'],
            'invoice_company_name' => ['required', 'max:100'],
            'finish_date' => ['required', 'date_format:Y-m-d'],
            'project_comment' => ['nullable', 'max:1000'],
            'project_status_id' => ['required', 'exists:project_statuses,id'],
            'tax_identification_number' => ['required', 'numeric']
        ];
    }

    const messages = [
        'project_id.exists' => 'the_selected_project_id_does_not_exist',
        'project_name.required' => 'project_name_is_missing',
        'project_name.max' => 'project_name_exceeds_100_characters',
        'project_name.unique' => 'project_name_has_already_been_taken',
        'project_menager_id.required' => 'project_menager_is_missing',
        'tasks_ids.*.required' => 'tasks_are_missing',
        'tasks_ids.exists' => 'at_least_one_task_does_not_exist_on_the_list',
        'employees_ids.*.required' => 'employees_are_missing',
        'account_id.required' => 'account_id_is_missing',
        'employees_ids.*.exists' => 'at_least_one_employee_does_not_exist_on_the_list',
        'work_stages.*.required' => 'work_stages_are_missing',
        'work_stages.*.exists' => 'at_least_one_work_stage_does_not_exist_on_the_list',
        'work_stage_engaged_persons.*.required' => 'work_stage_engaged_persons_are_missing',
        'work_stage_engaged_persons.*.exists' => 'at_least_one_work_stage_engaged_person_does_not_exist_on_the_list',
        'work_stage_estimated_number_of_hours.*.required' => 'work_stages_estimated_number_of_hours_are_missing',
        'work_stage_estimated_number_of_hours.*.min' => 'work_stages_estimated_number_of_hours_must_be_greather_or_equal_zero',
        'work_stage_estimated_number_of_hours.*.numeric' => 'work_stages_estimated_number_of_hours_must_be_numeric',
        'work_stage_estimated_number_of_money.*.required' => 'work_stages_estimated_number_of_money_are_missing',
        'work_stage_estimated_number_of_money.*.min' => 'work_stages_estimated_number_of_money_must_be_greather_or_equal_zero',
        'work_stage_estimated_number_of_money.*.numeric' => 'work_stages_estimated_number_of_money_must_be_numeric',
        'work_stage_date_start.*.required' => 'work_stages_date_start_is_missing',
        'work_stage_date_start.*.date_format' => 'at_least_one_work_stage_date_start_has_incorrect_format',
        'work_stage_dead_line_date.*.required' => 'work_stage_dead_line_date_is_missing',
        'work_stage_dead_line_date.*.date_format' => 'at_least_one_work_stage_dead_line_date_has_incorrect_format',
        'payment_stage_names.*.required' => 'payment_stage_names_are_missing',
        'payment_stage_names.*.max' => 'at_least_one_payment_stage_name_exceeds_30_characters',
        'payment_ammounts.*.required' => 'payment_ammounts_are_missing',
        'payment_ammounts.*.min' => 'payment_ammounts_must_be_greather_or_equal_zero',
        'payment_ammounts.*.numeric' => 'payment_ammounts_must_be_a_number',
        'payment_stage_dates.required' => 'payment_stage_dates_are_missing',
        'payment_stage_dates.*.date_format' => 'payment_stage_date_has_incorrect_format',
        'payment_status.*.required' => 'payment_status_is_missing',
        'payment_status.*.exists' => 'at_least_one_payment_status_does_not_exist_on_the_list',
        'client_contact_person.max' => 'client_contact_person_exceeds_40_characters',
        'client_phone_number.max' => 'client_phone_number_exceeds_20_characters',
        'client_email.email' => 'client_email_has_incorrect_format',
        'client_id.exists' => 'client_chosen_from_the_list_does_not_exist',
        'client_id.required' => 'client_id_is_missing',
        'invoice_addres.required' => 'invoice_addres_is_missing',
        'invoice_addres.max' => 'invoice_addres_exceeds_100_characters',
        'invoice_company_name.required' => 'invoice_company_name_is_missing',
        'invoice_company_name.max' => 'invoice_company_name_exceeds_100_characters',
        'finish_date.required' => 'finish_date_is_missing',
        'finish_date.date_format' => 'finish_date_has_incorrect_format',
        'project_comment.max' => 'project_comment_exceeds_1000_characters',
        'project_status_id.required' => 'project_status_is_missing',
        'project_status_id.exists' => 'chosen_project_status_is_not_on_the_list'
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */


}
