<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;  
use App\Http\Controllers\api\EmployeeController;
use App\Http\Controllers\api\SupplierController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\ExpensesController;
use App\Http\Controllers\api\SalaryController;








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

// Category Resource Route
Route::apiResource('/category',CategoryController::class);
Route::post('/category/{category}/update',[CategoryController::class,'update']);

// Product Resource Route
Route::apiResource('/product',ProductController::class);
Route::post('/product/{product}/update',[ProductController::class,'update']);

// expense Resource Route
Route::apiResource('/expense',ExpensesController::class);
Route::post('/expense/{expense}/update',[ExpensesController::class,'update']);


// Route::Post('/salary/paid/{id}','Api\SalaryController@Paid');
Route::post('/salary/paid/{id}',[SalaryController::class,'Paid']);
//Route::Get('/salary','Api\SalaryController@AllSalary');
Route::Get('/salary',[SalaryController::class,'AllSalary']);
//Route::Get('/salary/view/{id}','Api\SalaryController@ViewSalary');
Route::Get('/salary/view/{id}',[SalaryController::class,'ViewSalary']);
//Route::Get('/edit/salary/{id}','Api\SalaryController@EditSalary');
Route::Get('/edit/salary/{id}',[SalaryController::class,'EditSalary']);
//Route::Post('/salary/update/{id}','Api\SalaryController@SalaryUpdate');
Route::Post('/salary/update/{id}',[SalaryController::class,'SalaryUpdate']);
//Route::Post('/stock/update/{id}','Api\SalaryController@StockUpdate');
Route::Post('/stock/update/{id}',[SalaryController::class,'StockUpdate']);
