<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;   
use App\Models\Product;
use App\Models\Vat;


class CartController extends Controller
{
    public function addTocart(Request $request,$id){

        
        $product=Product::where('id',$id)->first();
        $check=Cart::where('pro_id',$id)->first();
       
        if($product->product_quantity>0 ){
            if ($check) {
                $remainQuantity = $product->product_quantity - $check->pro_quantity;
                if( $remainQuantity  > 0 ){
                    $increment=Cart::where('pro_id',$id)->increment('pro_quantity');
                    $subtotal=$product->pro_quantity * $product->product_price;
        
                    Cart::where('pro_id',$id)->update([
                    'sub_total' => $subtotal 
                    ]);
                }
            }
            else{
               
                Cart::create([   
                    'pro_id'   => $id,
                    'pro_name'   => $product->product_name,
                    'pro_quantity'  =>1,
                    'product_price'=> $product->selling_price,
                    'sub_total'  =>  $product->selling_price,
            
                ]);
            }
            return response()->json("Done");
        }
        $message="Product Quantity is out of stock";
        return response()->json($message,404);
   }

   public function CartProduct()
   {
       $cart=Cart::all();
       return response()->json($cart);
   }

   public function removeCart($id){
    Cart::where('id',$id)->delete();
    return response('done');
}


public function Increment($id)
{
       
        
    $product=Product::where('id',$id)->first();
    $check=Cart::where('pro_id',$id)->first();

    if($product->product_quantity>0 ){
        if ($check) {
            $remainQuantity = $product->product_quantity - $check->pro_quantity;
            if( $remainQuantity  > 0 ){
                $increment=Cart::where('pro_id',$id)->increment('pro_quantity');
                $subtotal=$product->pro_quantity * $product->product_price;
    
                $check->update([
                'sub_total' => $subtotal 
                ]);
                return response('done');
            }
            $message="Product Quantity is out of stock";
            return response()->json($message,404); 
        }
        $message="Product Not Exist  in Carts";
        return response()->json($message,404); 
    }
    $message="Product Quantity is out of stock";
    return response()->json($message,404); 

    
}

public function decrement($id)
{
    $decrement=Cart::where('pro_id',$id)->decrement('pro_quantity');
    $product=Cart::where('pro_id',$id)->first();
    $subtotal=$product->pro_quantity * $product->product_price;
    
        Cart::where('pro_id',$id)->update([
        'sub_total' => $subtotal 
        ]);

    return response('done');
}


public function Vats()
{
    $vat=Vat::first();
    return response()->json($vat);
}
}
