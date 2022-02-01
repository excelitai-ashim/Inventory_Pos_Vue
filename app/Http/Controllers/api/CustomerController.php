<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Image;

class CustomerController extends Controller
{
   
    public function index()
    {
        $customer=CustomerResource::collection(Customer::all());
                    

            return response()->json($customer);
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required|max:255',
            'email'    => 'required|unique:customers|max:255',
            'phone'=> 'required|unique:customers',   
            'address'=> 'required',
            'photo'=> 'required',
        ]);



            if($request->photo){
                $photo= $request->photo;
                $position = strpos($photo, ';');
                $sub=substr($photo, 0 ,$position);
                $ext=explode('/', $sub)[1];
                $name=time().".".$ext;
                $img=Image::make($photo)->resize(240,200);
                $upload_path='backend/customers/';
                $image_url=$upload_path.$name;
                $img->save($image_url);

                Customer::create([   
                    'name'   => $request->name,
                    'email'   => $request->email,
                    'phone'  => $request->phone,
                    'address'=> $request->address,
                    'photo'  =>  $image_url,

                ]);

            }else{
                Customer::create([   
                    'name'   => $request->name,
                    'email'   => $request->email,
                    'phone'  => $request->phone,
                    'address'=> $request->address,
                    'photo'  =>  "No Image !",

                ]);
            }
    }

    
    public function show($id)
    {
        $customer=new CustomerResource(Customer::find($id)) ;

                return response()->json($customer);
    }

  
    public function update(Request $request, $id)
    {

        $request->validate([
            'name'=> 'required|max:255',
            'email'    => 'required|unique:customers|max:255',
            'phone'=> 'required|unique:customers',   
            'address'=> 'required',
            'photo'=> 'required',
        ]);
        $customer=Customer::where('id',$id)->first();               
        $image = $customer->photo;
        if($request->hasFile('photo') && $request->photo->isValid()){
            if(file_exists(public_path($image))){
                unlink(public_path($image));
            }
            $ext = $request->photo->getClientOriginalExtension();
            $image_new_name = time().".". $ext;
            $img=Image::make($request->photo)->resize(240,200);
            $image_url="backend/customers/".$image_new_name;
            $img->save(public_path($image_url));
            $image =$image_url;
        }

        Customer::findOrFail($id)->update([
            'name'   => $request->name,
            'email'   => $request->email,
            'phone'  => $request->phone,
            'address'=> $request->address,
            'photo'  =>  $image,
        ]);
    }

   
    public function destroy($id)
    {
        $customer=Customer::find($id);
        $photo=$customer->photo;
        
        if($photo){
            unlink($photo);
            Customer::find($id)->delete();

        }else{
            Customer::find($id)->delete();

        }
    }
}
