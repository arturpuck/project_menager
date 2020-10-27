<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainPanelController extends Controller
{
   public function showProjects(){
       return view('main_panel.projects');
   }
}
