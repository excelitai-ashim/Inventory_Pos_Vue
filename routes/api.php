<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;  
use App\Http\Controllers\api\EmployeeController;
use App\Http\Controllers\api\SupplierController;




Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class,'login']);
    Route::post('signup', [AuthController::class,'signup']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class,'me']);

});

// Employee Resource Route
 Route::apiResource('/employee',EmployeeController::class);
Route::post('/employee/{employee}/update',[EmployeeController::class,'update']);

// Supplier Resource Route
Route::apiResource('/supplier',SupplierController::class);
Route::post('/supplier/{supplier}/update',[SupplierController::class,'update']);