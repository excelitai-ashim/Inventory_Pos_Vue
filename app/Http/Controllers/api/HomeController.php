<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\Expenses;



class HomeController extends Controller  
{
    
    public function TodaySell(){

        $date=date('d/m/Y');
        $sell=Order::where( 'order_date',$date)->sum('total');
      
        return response()->json($sell);
    }

    public function TodayIncome(){

        $date=date('d/m/Y');
        $income=Order::where( 'order_date',$date)->sum('pay');
      
        return response()->json($income);
    }
    public function TodayDue(){

        $date=date('d/m/Y');
        $due=Order::where( 'order_date',$date)->sum('due');
      
        return response()->json($due);
    }
    public function TodayExpense(){

        $date=date('d/m/Y');
        $expenses=Expenses::where( 'expenses_date',$date)->sum('amount');
      
        return response()->json($expenses);
    }
    public function StockOut(){

        
        $expenses=Product::where( 'product_quantity','<','1')->get();
      
        return response()->json($expenses);
    }


} 
