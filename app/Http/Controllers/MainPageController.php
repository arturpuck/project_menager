<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainPageController extends Controller
{
    public function showLoginPanel(){
        
        return view('auth.login_panel');
    }
}
