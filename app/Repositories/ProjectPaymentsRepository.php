<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Collection;
use App\Models\PaymentStage;


Class ProjectPaymentsRepository extends BaseRepository {

    public const MODEL_NAME = PaymentStage::class;

    public function filterByMonth($monthNumber): ProjectPaymentsRepository {
        $this->query = $this->query->whereMonth('estimated_payment_date', $monthNumber);
         return $this;
    }

    public function filterByYear($year): ProjectPaymentsRepository {
         $this->query = $this->query->whereYear('estimated_payment_date', $year);
         return $this;
    }

    public function filterByStatus($status): ProjectPaymentsRepository {
        
        $this->query = $this->query->whereHas('paymentStatus', function($query) use ($status){
              $query->where('name',$status);
        });
        return $this;
   }

   public function limitCurrentUserPaymentsAccess(){

        if(!\Auth::user()->is_admin){

            $this->query = $this->query->whereHas('project', function($query){

                  $query->where('project_menager_id', \Auth::user()->id)
                        ->orWhere('account_id',\Auth::user()->id);
            });
        }
        return $this;
   }
}