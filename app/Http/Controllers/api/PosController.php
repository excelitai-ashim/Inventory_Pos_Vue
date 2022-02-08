<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResources;
use App\Models\Product;
use App\Models\Order;
use App\Models\Cart;
use App\Models\OrderDetails;
use Image;

class PosController extends Controller
{
    public function getProductViaCategory($category_id){
        $products=ProductResources::collection(Product::where('category_id',$category_id)->get());   
        return response()->json($products);                
    } 

    public function OrderDone(Request $request)
    {


    	 $validatedData = $request->validate([
           'customer_id' => 'required',
           'payby' => 'required',
         ]);

         
        $order= Order::create([   
            'customer_id'   => $request->customer_id,
            'qty'   => $request->qty,
            'sub_total'  => $request->subtotal,
            'vat'=> $request->vat,
            'total' => $request->total,
            'payby'   => $request->payby,
            'pay'   => $request->pay,
            'due'   => $request->due,
            'order_date'   => date('d/m/Y'),
            'order_month'  => date('F'),
            'order_year'=> date('Y'),   

        ]);

         

        $carts=Cart::all();
         
          
         foreach ($carts as $cart) {

        OrderDetails::create([   
            'order_id'   => $order->id,
            'product_id'   => $cart->pro_id,
            'pro_quantity'  => $cart->pro_quantity,
            'product_price'=> $cart->product_price,
            'sub_total' => $cart->pro_quantity * $cart->product_price,
            

        ]);
        $productQuantity=Product::select('product_quantity')->where('id',$cart->pro_id)->first();
        
        $currentProductQuentity=(int)$productQuantity->product_quantity - $cart->pro_quantity;
      
        $product=Product::where('id',$cart->pro_id)->update([
            'product_quantity' =>$currentProductQuentity,
            ]);

            //for table all data delete

             Cart::truncate();

    }
      

                        
     }
}
