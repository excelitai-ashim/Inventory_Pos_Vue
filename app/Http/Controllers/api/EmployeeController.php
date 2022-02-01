<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Image;


class EmployeeController extends Controller
{
           
            public function index()
            {
                    $employee=EmployeeResource::collection(Employee::all());
                    

                    return response()->json($employee);
            }

        
        
            public function store(Request $request)
            {

            

                        $request->validate([
                            'name'=> 'required|max:255',
                            'email'    => 'required|unique:employees|max:255',
                            'phone'=> 'required|unique:employees',   
                            'address'=> 'required',
                            'salary'=> 'required',
                            'photo'=> 'required',
                            'nid'=> 'required',
                            'joining_date'=> 'required',      

                        ]);


        
                            if($request->photo){
                                $photo= $request->photo;
                                $position = strpos($photo, ';');
                                $sub=substr($photo, 0 ,$position);
                                $ext=explode('/', $sub)[1];
                                $name=time().".".$ext;
                                $img=Image::make($photo)->resize(240,200);
                                $upload_path='backend/employee/';
                                $image_url=$upload_path.$name;
                                $img->save($image_url);

                                Employee::create([   
                                    'name'   => $request->name,
                                    'email'   => $request->email,
                                    'phone'  => $request->phone,
                                    'address'=> $request->address,
                                    'salary' => $request->salary,
                                    'nid'   => $request->nid,
                                    'joining_date'   => $request->joining_date,
                                    'photo'  =>  $image_url,

                                ]);
                                    


            
                
                            }else{
                                Employee::create([   
                                    'name'   => $request->name,
                                    'email'   => $request->email,
                                    'phone'  => $request->phone,
                                    'addsres'=> $request->address,
                                    'salary' => $request->salary,
                                    'nid'   => $request->nid,
                            'joining_date'   => $request->joining_date,
                                    'photo'  =>  "No Image !",

                                ]);
                            }

            }

        
            public function show($id)
            {
            $employee=new EmployeeResource(Employee::find($id)) ;

            return response()->json($employee);
            }

            
            public function update(Request $request, $id)
            {


                $request->validate([
                    'name'=> 'required|max:255',
                    'email'    => 'required|unique:employees|max:255',
                    'phone'=> 'required|unique:employees',   
                    'address'=> 'required',
                    'salary'=> 'required',
                    'photo'=> 'required',
                    'nid'=> 'required',
                    'joining_date'=> 'required',      

                ]);

                        $employee=Employee::where('id',$id)->first();
            


                
                        $image = $employee->photo;
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

                        Employee::findOrFail($id)->update([
                            'name' => $request->name,
                            'email' => $request->email,
                            'phone' => $request->phone,
                            'address' => $request->address,
                            'salary' => $request->salary,
                            'nid' => $request->nid,
                            'joining_date' => $request->joining_date,
                            'photo' =>$image
                        ]);
            }

        
            public function destroy($id)
            {
                            $employee=Employee::find($id);
                            $photo=$employee->photo;
                            
                            if($photo){
                                unlink($photo);
                                Employee::find($id)->delete();

                            }else{
                                Employee::find($id)->delete();

                            }

            }

}
