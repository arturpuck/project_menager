<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EmployeesRepository;
use Symfony\Component\HttpFoundation\Response;

class TeamController extends Controller
{
   public function showList(){
       
       return view('team')->with([
           'title' => 'team_list_title',
           'description' => 'team_list_description'
       ]);
   }

   public function getAll(EmployeesRepository $employeesRepository) : Response{

      $employees = $employeesRepository->with(['position', 'skills', 'role'])->get();
      return response()->json($employees->toArray());
   }
}
