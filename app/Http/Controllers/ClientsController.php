<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Clients\GetSingleClientIdRequest;
use App\Handlers\Clients\GetSingleClientDataHandler;

class ClientsController extends Controller
{
    public function  getSingle(GetSingleClientIdRequest $request, GetSingleClientDataHandler $singleClientDataHandler){
         return $singleClientDataHandler->handle($request);
    }
}
