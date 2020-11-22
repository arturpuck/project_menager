<?php

namespace App\Handlers\Projects;

use App\Http\Requests\Projects\UpdatePaymentStageRequest;
use App\Models\PaymentStage;


Class UpdatePaymentStageStatusHandler {

    

    public function handle(UpdatePaymentStageRequest $request){

        $paymentStageId = $request->get('payment_stage_id');
        $paymentStatusId = $request->get('payment_status_id');

        PaymentStage::where('id',$paymentStageId)
                    ->update(['payment_status_id' => $paymentStatusId]);

        return response('payment_status_modified_successfully');
    }
}