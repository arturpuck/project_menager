<?php

namespace App\Handlers\Projects;

use App\Repositories\ProjectPaymentsRepository;
use App\Http\Requests\Projects\FilterProjectPaymentsRequest;
use Symfony\Component\HttpFoundation\Response;

Class FilterProjectPaymentsHandler {

    private ProjectPaymentsRepository $projectPaymentsRepository;

    public function __construct(ProjectPaymentsRepository $projectPaymentsRepository){

        $this->projectPaymentsRepository = $projectPaymentsRepository;
    }

    public function handle(FilterProjectPaymentsRequest $request) : Response{
        
        if($status = $request->get('status')){
           $this->projectPaymentsRepository->filterByStatus($status);
        }

        if($month = $request->get('month')){
            $this->projectPaymentsRepository->filterByMonth($month);
         }

         if($year = $request->get('year')){
            $this->projectPaymentsRepository->filterByYear($year);
         }

         $payments =  $this->projectPaymentsRepository->limitCurrentUserPaymentsAccess()
                                                      ->with(['project', 'paymentStatus'])
                                                      ->get();

         return response()->json($payments->toArray());
    }
}