<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResources;
use App\Models\Category;
use App\Models\Product;

use Image;

class CategoryController extends Controller
{
   
    public function index()
    {
        $category=CategoryResources::collection(Category::all());            
         return response()->json($category);
    }

  
    public function store(Request $request)
    {
        $request->validate([
            'category_name'    => 'required|unique:categories|max:255',
            
        ]);

        Category::create([   
            'category_name'   => $request->category_name,
            ]);
    }

    
    public function show($id)
    {
        $category=new CategoryResources(Category::find($id)) ;

            return response()->json($category);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name'    => 'required|unique:categories|max:255',
            
        ]);
        Category::findOrFail($id)->update([
            'category_name' => $request->category_name,
           
        ]);
}

    

   
    public function destroy($id)
    {
        Category::find($id)->delete();

        $Products=Product::where('category_id',$id)->get();

        foreach ($Products as $Product) {
       
            $Product->delete();
            
          }

 

       
    }
}
