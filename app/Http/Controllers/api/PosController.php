<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResources;
use App\Models\Product;
use Image;

class PosController extends Controller
{
    public function getProductViaCategory($category_id){
        $products=ProductResources::collection(Product::where('category_id',$category_id)->get());   
        return response()->json($products);                
    } 
}
