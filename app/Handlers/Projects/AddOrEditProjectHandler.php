<?php

namespace App\Handlers\Projects;

use App\Http\Requests\Projects\CreateOrEditProjectRequest;
use App\Models\Project;
use App\Models\TaskStage;
use App\Models\PaymentStage;

Class AddOrEditProjectHandler {

    public function handle(CreateOrEditProjectRequest $request){

        if($projectID = $request->get('project_id')){
            $project = Project::find($projectID);
            $project->taskStages()->delete();
            $project->paymentStages()->delete(); //do zoptymalizowania - średnio eleganckie
        }
        else{
            $project = new Project();
        }
        
        $project->name = $request->get('project_name');
        $project->project_menager_id = $request->get('project_menager_id');
        $project->account_id = $request->get('account_id');
        $project->full_name_contact_person = $request->get('client_contact_person');
        $project->contact_person_phone_number = $request->get('client_phone_number');
        $project->contact_person_email = $request->get('client_email');
        $project->client_id = $request->get('client_id');
        $project->invoice_company_addres = $request->get('invoice_addres');
        $project->invoice_company_name = $request->get('invoice_company_name');
        $project->invoice_tax_identification_number = $request->get('tax_identification_number');
        $project->finished_at = $request->get('finish_date');
        $project->status_id = $request->get('project_status_id');
        $project->project_comment = $request->get('comment');
        $project->save();
        $project->tasks()->sync($request->get('tasks_ids'));
        $project->employees()->sync($request->get('employees_ids'));
        $workStageData = [];
       
        foreach($request->get('work_stages') as $key => $value){
            $workStage = [];
            $workStage['task_id'] = $request->get('work_stages')[$key];
            $workStage['user_id'] = $request->get('work_stage_engaged_persons')[$key];
            $workStage['estimated_time_of_work'] = $request->get('work_stage_estimated_number_of_hours')[$key];
            $workStage['estimated_amount_of_money'] = $request->get('work_stage_estimated_ammount_of_money')[$key];
            $workStage['start_at'] = $request->get('work_stage_date_start')[$key];
            $workStage['deadline'] = $request->get('work_stage_dead_line_date')[$key];
            $workStage['project_id'] = $project->id;
            $workStageData[] = $workStage;
        }
        TaskStage::insert($workStageData);
        $paymentStageData = [];
       
        foreach($request->get('payment_stage_names') as $key => $value){
            $paymentStage = [];
            $paymentStage['name'] = $request->get('payment_stage_names')[$key];
            $paymentStage['ammount'] = $request->get('payment_ammounts')[$key];
            $paymentStage['estimated_payment_date'] = $request->get('payment_stage_dates')[$key];
            $paymentStage['payment_status_id'] = $request->get('payment_status')[$key];
            $paymentStage['project_id'] = $project->id;
            $paymentStageData[] = $paymentStage;
        }
        PaymentStage::insert($paymentStageData);

        return back()->with('succesMessage', 'operation_successfull');
    }
}