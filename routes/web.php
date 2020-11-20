<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['guest'])->group(function(){

    Route::get('/', 'MainPageController@showLoginPanel')->name('login.panel');

});

Route::namespace('Auth')->name('auth.')->group(function(){

    Route::post('/login', 'LoginController@login')->name('login');
    Route::post('/logout', 'LoginController@logout')->name('logout');

});

Route::middleware(['auth'])->group(function(){

   Route::name('projects.')->group(function(){

      Route::get('/projects', 'ProjectsController@showProjects')
          ->name('mainpage');

      Route::get('/projects/filter', 'ProjectsController@filterProjects')
          ->name('filter');
      
      Route::post('/add-project', 'ProjectsController@addOrEditProject')
             ->name('add');

   });

   Route::name('team.')->group(function(){

      Route::get('/team', 'TeamController@showList')
            ->name('mainpage');

      Route::get('/team/get-all', 'TeamController@getAll')
            ->name('get-all');

      Route::post('/report/store', 'TeamController@storeReport')
            ->name('store-report');

      Route::get('/employee/reports/filter', 'TeamController@filterReports')
            ->name('filter-report');

      Route::patch('/employee/reports/store', 'TeamController@storeProjectReport')
            ->name('filter-report');
   });


    Route::get('/payouts', 'MainPanelController@showPayouts')
          ->name('payouts');

    Route::get('/cashflow', 'MainPanelController@showCashFlow')
          ->name('cashflow');
    
    Route::get('/gantt', 'MainPanelController@showGantt')
          ->name('gantt');

    Route::get('/income', 'MainPanelController@showIncome')
          ->name('income');

    Route::get('/uploader', 'MainPanelController@uploader')
          ->name('uploader');

});




