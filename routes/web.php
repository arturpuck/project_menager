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

    Route::get('/', 'MainPageController@showLoginPanel');

});

Route::namespace('Auth')->name('auth.')->group(function(){

    Route::post('/login', 'LoginController@login')->name('login');
    Route::post('/logout', 'LoginController@logout')->name('logout');

});

Route::middleware(['auth'])->group(function(){

    Route::get('/projects', 'MainPanelController@showProjects')
          ->name('projects');

    Route::get('/team', 'MainPanelController@showTeam')
          ->name('team');

    Route::get('/payouts', 'MainPanelController@showPayouts')
          ->name('payouts');

          Route::get('/cashflow', 'MainPanelController@showCashFlow')
          ->name('payouts');
    
    Route::get('/gantt', 'MainPanelController@showGantt')
          ->name('gantt');

    Route::get('/uploader', 'MainPanelController@uploader')
          ->name('uploader');

});




