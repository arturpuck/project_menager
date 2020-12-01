<?php

namespace App\Handlers\Clients;

use App\Http\Requests\Projects\FilterProjectPaymentsRequest;
use App\Http\Requests\Clients\GetSingleClientIdRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Client;

Class GetSingleClientDataHandler {

    public function handle(GetSingleClientIdRequest $request) : Response{
         $client = Client::find($request->get('id'));
         return response()->json($client->toArray());
    }
}