<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Image;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee=Employee::all();

        return response()->json( $employee);
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
            'photo'  => $request->salary,
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
        'photo'  => $request->salary,
         'nid'   => $request->nid,
'joining_date'   => $request->joining_date,
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
