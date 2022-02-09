<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetails;
use DateTime;


class OrderController extends Controller
{
    public function TodayOrder()
    {
    	$date=date('d/m/Y');
        $order=Order::with('customer')->where( 'order_date',$date)->orderBy('orders.id','DESC')->get();

    
    	return response()->json($order);
    }

    public function OrderDetails($id)
    {

        $orders=Order::with('customer')->where( 'id',$id)->first();

       

    
    	  return response()->json($orders);               
    }

    public function OrderDetailsAll($id)
    {
    

        $details=OrderDetails::with('product')->where('order_id',$id)->get();

    //    dd($details);
    	  return response()->json($details); 
    }

    public function SearchOrderDate(Request $request){     
    	$orderdate=$request->date;
        
        $newDate=new DateTime($orderdate);
        $done= $newDate->format('d/m/Y');
       
        $orders=Order::with('customer','orderDetails','orderDetails.product')->where( 'order_date',$done)->get();
       
    	return response()->json($orders);
    }

    public function SearchMonth(request $request){
    	$month=$request->month;
        $orders=Order::with('customer','orderDetails','orderDetails.product')->where( 'order_month',$month)->get();
       
    	return response()->json($orders);
    
    }
}


