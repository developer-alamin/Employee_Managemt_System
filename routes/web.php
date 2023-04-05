<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;
use App\Http\Controllers\departController;

use App\Http\Controllers\employeeController;




Route::get('/',[adminController::class,'login']);

Route::post('/userlogin',[adminController::class,'userlogin']);


Route::post('/createDepart',[departController::class,'createDepart']);
Route::get('/showDepart',[departController::class,'showDepart']);
Route::post('/departUpShow',[departController::class,'departUpShow']);
Route::post('/departUpdated',[departController::class,'departUpdate']);
Route::post('/departDelete',[departController::class,'departDelete']);

Route::post('/createEmployee',[employeeController::class,'createEmployee']);
Route::get('/showEmployee',[employeeController::class,'showEmployee']);
Route::post('/employeeUpShow',[employeeController::class,'employeeUpShow']);
Route::post('/employeeUpdate',[employeeController::class,'employeeUpdate']);
Route::post('/employeeDelete',[employeeController::class,'employeeDelete']);



Route::prefix('admin')->group(function () {
	Route::get('/',[adminController::class,'admin'])->middleware('login');
	
	Route::get('/department',[departController::class,'depart'])->middleware('login');
	Route::get('/adddepartment',[departController::class,'adddepartment'])->middleware('login');


	Route::get('/addEmployee',[employeeController::class,'addemployee'])->middleware('login');
	Route::get('/viewemployee',[employeeController::class,'viewemployee'])->middleware('login');

	Route::get('/logout',[adminController::class,'logout'])->middleware('login');


});