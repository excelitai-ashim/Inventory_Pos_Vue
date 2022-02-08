<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;  
use App\Http\Controllers\api\EmployeeController;
use App\Http\Controllers\api\SupplierController;
use App\Http\Controllers\api\CustomerController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\ExpensesController;
use App\Http\Controllers\api\SalaryController;
use App\Http\Controllers\api\CartController;
use App\Http\Controllers\api\PosController;
use App\Http\Controllers\api\OrderController;
use App\Http\Controllers\api\HomeController;




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

// Supplier Resource Route
Route::apiResource('/customer',CustomerController::class);
Route::post('/customer/{customer}/update',[CustomerController::class,'update']);

// Category Resource Route
Route::apiResource('/category',CategoryController::class);
Route::post('/category/{category}/update',[CategoryController::class,'update']);

// Product Resource Route
Route::apiResource('/product',ProductController::class);
Route::post('/product/{product}/update',[ProductController::class,'update']);
Route::Post('/stock/update/{id}',[ProductController::class,'StockUpdate']);


// expense Resource Route
Route::apiResource('/expense',ExpensesController::class);
Route::post('/expense/{expense}/update',[ExpensesController::class,'update']);


Route::post('/salary/paid/{id}',[SalaryController::class,'Paid']);
Route::Get('/allSalary',[SalaryController::class,'AllSalary']);
Route::Get('/monthSalary/{id}',[SalaryController::class,'viewmonthSalary']);
Route::Get('/editSalary/{id}',[SalaryController::class,'EditSalary']);
Route::Post('/salary/update/{id}',[SalaryController::class,'SalaryUpdate']);

// Pos Controller
Route::get('/getting/product/{category_id}',[PosController::class,'getProductViaCategory']);

// Cart Controller
Route::get('/addTocart/{product_id}',[CartController::class,'addToCart']);
Route::get('/cart/product',[CartController::class,'CartProduct']);
Route::get('/remove/cart/{id}',[CartController::class,'removeCart']);

Route::get('/increment/{id}',[CartController::class,'Increment']);
Route::get('/decrement/{id}',[CartController::class,'decrement']);
Route::get('/vats',[CartController::class,'Vats']);

Route::post('/orderdone',[PosController::class,'OrderDone']);

//order Controller
Route::get('/orders',[OrderController::class,'TodayOrder']);
Route::get('/order/details/{id}',[OrderController::class,'OrderDetails']);
Route::get('/order/orderdetails/{id}',[OrderController::class,'OrderDetailsAll']);

Route::post('/search/date/',[OrderController::class,'SearchOrderDate']);
Route::post('/search/month/',[OrderController::class,'SearchMonth']);

//Home Controller  HomeController  

Route::get('/today/sell/',[HomeController::class,'TodaySell']);
Route::get('/today/income/',[HomeController::class,'TodayIncome']);
Route::get('/today/due/',[HomeController::class,'TodayDue']);
Route::get('/today/expense/',[HomeController::class,'TodayExpense']);
Route::get('/stockOutProducts',[HomeController::class,'StockOut']);


























