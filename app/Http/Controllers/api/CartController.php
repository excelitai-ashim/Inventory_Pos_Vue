<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

 use DB;

class CartController extends Controller
{
    public function addTocart(Request $request,$id){

        $product=Product::where('id',$id)->first();
   
   
       // $check=DB::table('pos')->where('pro_id',$id)->first();
   
       // if ($check) {
       //         $increment=DB::table('pos')->where('pro_id',$id)->increment('pro_quantity');
   
       //         $pos=DB::table('pos')->where('pro_id',$id)->first();
       //         $subtotal=$pos->pro_quantity * $pos->product_price;
       //         DB::table('pos')->where('pro_id',$id)->update(['sub_total' => $subtotal]);
   
       // }else{
       //     $data=array();
       //     $data['pro_id']=$id;
       //     $data['pro_name']=$product->product_name;
       //     $data['pro_quantity']=1;
       //     $data['product_price']=$product->selling_price;
       //     $data['sub_total']=$product->selling_price;
       //     DB::table('pos')->insert($data);
       // }
   
    //    $data=array();
    //        $data['pro_id']=$id;
    //        $data['pro_name']=$product->product_name;
    //        $data['pro_quantity']=1;
    //       $data['product_price']=$product->selling_price;
    //       $data['sub_total']=$product->selling_price;

    Cart::create([   
        'pro_id'   => $id,
        'pro_name'   => $product->product_name,
        'pro_quantity'  =>1,
        'product_price'=> $product->selling_price,
        'sub_total'  =>  $product->selling_price,

    ]);
   
       
       return response()->json("Done");
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
}
