<?php

namespace App\Handlers\Projects;

use App\Http\Requests\Projects\CreateOrEditProjectRequest;
use App\Models\Project;
use App\Models\TaskStage;
use App\Models\PaymentStage;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

Class AddOrEditProjectHandler {

    public function handle(Request $request){

        $projectID = intval($request->get('project_id'));
        $rules = CreateOrEditProjectRequest::getRules($request->get('work_stages'),
        $request->get('work_stage_engaged_persons'), $projectID);
        $messages = CreateOrEditProjectRequest::messages;
        $validator = Validator::make($request->all(),$rules,$messages);
        
        if($validator->fails()){
            return back()->withErrors(($validator));
        }
        
        if(!$request->get('client_id')){
            $client = new Client();
            $client->name = $request->get('invoice_company_name');
            $client->contact_phone_number = $request->get('client_phone_number');
            $client->email = $request->get('client_email');
            $client->address = $request->get('invoice_addres');
            $client->tax_identification_number = $request->get('tax_identification_number');
            $client->contact_person_name = $request->get('client_contact_person');
            $client->save();
            $clientId = $client->id;
         }
         else{
             $clientId = $request->get('client_id');
         }

        if($projectID = $request->get('project_id')){
            $project = Project::find($projectID);
        }
        else{
            $project = new Project();
        }
        
        $project->name = $request->get('project_name');
        $project->project_menager_id = $request->get('project_menager_id');
        $project->account_id = $request->get('account_id');
        $project->client_contact_person_name = $request->get('client_contact_person');
        $project->client_phone_number = $request->get('client_phone_number');
        $project->client_email = $request->get('client_email');
        $project->client_id = $clientId;
        $project->company_addres = $request->get('invoice_addres');
        $project->company_name = $request->get('invoice_company_name');
        $project->company_tax_identification_number = $request->get('tax_identification_number');
        $project->should_be_finished_at = $request->get('finish_date');
        $project->status_id = $request->get('project_status_id');
        $project->project_comment = $request->get('comment');
        $project->save();

        $project->employees()->sync($request->get('work_stage_engaged_persons'));
        $workStageData = [];
       
        foreach($request->get('work_stages') as $key => $value){
            $workStage = [];
            $workStage['task_id'] = $request->get('work_stages')[$key];
            $workStage['user_id'] = $request->get('work_stage_engaged_persons')[$key];
            $workStage['estimated_time_of_work'] = $request->get('work_stage_estimated_number_of_hours')[$key];
            $workStage['start_at'] = $request->get('work_stage_date_start')[$key];
            $workStage['deadline'] = $request->get('work_stage_dead_line_date')[$key];
            $workStage['project_id'] = $project->id;
            $workStageData[] = $workStage;
        }
        $project->taskStages()->delete();
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
        $project->paymentStages()->delete();
        PaymentStage::insert($paymentStageData);

        return back()->with('succesMessage', 'operation_successfull');
    }
}