<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\SuppliereResource;
use App\Models\Supplier;
use Image;

class SupplierController extends Controller
{
    
    public function index()
    {
        $suppliers=SuppliereResource::collection(Supplier::all());
                    

        return response()->json($suppliers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'name'=> 'required|max:255',
            'email'    => 'required|unique:suppliers|max:255',
            'phone'=> 'required|unique:suppliers',   
            'address'=> 'required',
            'photo'=> 'required',
            'shopName'=> 'required',

        ]);



            if($request->photo){
                $photo= $request->photo;
                $position = strpos($photo, ';');
                $sub=substr($photo, 0 ,$position);
                $ext=explode('/', $sub)[1];
                $name=time().".".$ext;
                $img=Image::make($photo)->resize(240,200);
                $upload_path='backend/supplier/';
                $image_url=$upload_path.$name;
                $img->save($image_url);

                Supplier::create([   
                    'name'   => $request->name,
                    'email'   => $request->email,
                    'phone'  => $request->phone,
                    'address'=> $request->address,
                    'shopName'   => $request->shopName,
                    'photo'  =>  $image_url,

                ]);
                    

            }else{
                Supplier::create([   
                    'name'   => $request->name,
                    'email'   => $request->email,
                    'phone'  => $request->phone,
                    'address'=> $request->address,
                    'shopName'   => $request->shopName,
                    'photo'  =>  "No Image !",

                ]);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $supplier=new SuppliereResource(Supplier::find($id)) ;

        return response()->json($supplier);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $supplier=Supplier::where('id',$id)->first();
            


                
       
        $image = $supplier->photo;
        if($request->hasFile('photo') && $request->photo->isValid()){
            if(file_exists(public_path($image))){
                unlink(public_path($image));
            }
            $ext = $request->photo->getClientOriginalExtension();
            $image_new_name = time().".". $ext;
            $img=Image::make($request->photo)->resize(240,200);
            $image_url="backend/employee/".$image_new_name;
            $img->save(public_path($image_url));
            $image =$image_url;
        }

        Supplier::findOrFail($id)->update([

            'name'   => $request->name,
            'email'   => $request->email,
            'phone'  => $request->phone,
            'address'=> $request->address,
            'shopName'   => $request->shopName,
            'photo'  =>  $image,

        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        {
            $employee=Supplier::find($id);
            $photo=$employee->photo;
            
            if($photo){
                unlink($photo);
                Supplier::find($id)->delete();

            }else{
                Supplier::find($id)->delete();

            }

}
    }
}
