<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResources;
use App\Models\Product;
use Image;


class ProductController extends Controller
{
   
    public function index()
    {  
       // $product=ProductResources::collection(Product::with(['category_name','supplier_name'])->get());
        $product=ProductResources::collection(Product::all());                   
        return response()->json($product);
    }

    public function getProductViaCategory($category_id){
        $products=ProductResources::collection(Product::where('category_id',$category_id)->get());   
        return response()->json($products);                
    } 

    public function store(Request $request)
    {
        
        $request->validate([
            'product_name' => 'required|max:255',
            'product_code' => 'required|unique:products|max:255',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'buying_price' => 'required',
            'root' => 'required',
            'selling_price' => 'required',
            'buying_date' => 'required',
            'product_quantity' => 'required',      

        ]);

            if($request->image){
                $photo= $request->image;
                $position = strpos($photo, ';');
                $sub=substr($photo, 0 ,$position);
                $ext=explode('/', $sub)[1];
                $name=time().".".$ext;
                $img=Image::make($photo)->resize(240,200);
                $upload_path='backend/product/';
                $image_url=$upload_path.$name;
                $img->save($image_url);

                Product::create([   
                    'category_id'     => $request->category_id,
                    'product_name'    => $request->product_name,
                    'product_code'    => $request->product_code,
                    'root'            => $request->root,
                    'buying_price'    => $request->buying_price,
                    'selling_price'   => $request->selling_price,
                    'supplier_id'     => $request->supplier_id,
                    'buying_date'     => $request->buying_date,
                    'image'           =>  $image_url,
                    'product_quantity'=> $request->product_quantity,


                ]);
                    

            }else{
                Product::create([   
                    'category_id'     => $request->category_id,
                    'product_name'    => $request->product_name,
                    'product_code'    => $request->product_code,
                    'root'            => $request->root,
                    'buying_price'    => $request->buying_price,
                    'selling_price'   => $request->selling_price,
                    'supplier_id'     => $request->supplier_id,
                    'buying_date'     => $request->buying_date,
                    'product_quantity'=> $request->product_quantity,


                ]);
            }
    }

   
    public function show($id)
    {
        $product=new ProductResources(Product::find($id)) ;

                return response()->json($product);
    }

   
    public function update(Request $request, $id)
    {
            
        $product=Product::where('id',$id)->first();
            
                
        $image = $product->image;
        if($request->hasFile('image') && $request->image->isValid()){
            if(file_exists(public_path($image))){
                unlink(public_path($image));
            }
            $ext = $request->image->getClientOriginalExtension();
            $image_new_name = time().".". $ext;
            $img=Image::make($request->image)->resize(240,200);
            $image_url="backend/product/".$image_new_name;
            $img->save(public_path($image_url));
            $image =$image_url;
        }

        Product::findOrFail($id)->update([
            'category_id'     => $request->category_id,
            'product_name'    => $request->product_name,
            'product_code'    => $request->product_code,
            'root'            => $request->root,
            'buying_price'    => $request->buying_price,
            'selling_price'   => $request->selling_price,
            'supplier_id'     => $request->supplier_id,
            'buying_date'     => $request->buying_date,
            'product_quantity'=> $request->product_quantity,     
            'image' =>$image
        ]);

                
        
    }

    
    public function destroy($id)
    {
             
        $product=Product::find($id);
        
        
        $photo=$product->image;
        
        if($photo){
            unlink($photo);
            Product::find($id)->delete();

        }else{
            Product::find($id)->delete();

        }
    }

       public function StockUpdate(Request $request,$id)
    {

        $validatedData = $request->validate([
            'product_quantity' => 'required',
            ]);

            Product::findOrFail($id)->update([
                'product_quantity'     => $request->product_quantity,
               
            ]);
    }
}
