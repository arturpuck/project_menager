<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function showProjects(){
        return view('main_panel.projects')->with([
            'title' => 'projects_list',
            'description' => 'projects_list_description'
        ]);
    }
}
