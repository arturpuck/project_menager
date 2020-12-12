<?php

namespace App\Handlers\Team;

use App\Models\ProjectReportStatus;
use App\Helpers\Company;
use App\Helpers\Months;
use App\Models\Role;
use App\Models\Position;
use App\Models\Skill;

Class ShowTeamMainPageHandler {

    public function handle(){
       
        $roles = \Auth::user()->is_admin ? Role::all() : Role::where('name', '<>', 'administrator')->get();
        $data = [
            'title' => 'team_list_title',
            'description' => 'team_list_description',
            'projectReportStatuses' => ProjectReportStatus::all(),
            'months' => Months::getNames(),
            'yearsRange' => Company::getYearsRange(),
            'roles' => $roles,
            'positions' => Position::all(),
            'skills' => Skill::all()
        ];

        $data['currentUserMonthsNames'] = \Auth::user()->is_ordinary_team_member ? Months::namesOfCurrentMonthAndPrevious() : Months::getNames();
        $data['currentUserMonthNumbers'] =  \Auth::user()->is_ordinary_team_member ? Months::numbersOfCurrentMonthAndPrevious() : Months::getAlMonthsParsedNumbers();

        return view('team')->with($data);
        
    }
}