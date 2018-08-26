<?php

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

//Route::get('/', function () {
 //   return view('welcome');
//});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard.dashboard');

Route::get('/', function () {

	if(Auth::guest()){
        return view('auth.login');
    }

   else{
   		if(Auth::user()->hasRole('ROLE_ADMIN')){
   			//$link = "dashboard";
   			//return View::make('dashboard.admin')->with('var',$link);
        	return View::make('home');
   		}
   		else{
   			//return view('dashboard');
   			return View::make('dashboard.dashboard');
   		}
   //	
   		/*if (Route::currentRouteName() == 'admin'){
	        return view('admin.home');
		
	    }
	    elseif(Route::currentRouteName() == 'superadmin')
	    {
	    	return view('superadmin.home');
	    }*/
   }
		
   
})->name('index');



Route::get('/dashboard/assigns/{id}','DashboardController@update');
Route::get('/home/payed/{id}','HomeController@update');