<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Salary;

use DB;


class SalaryController extends Controller
{

        public function Paid(Request $request,$id)
        {        
            // dd("done");

            // dd($request->all());

            $validatedData = $request->validate([
            'salary_month' => 'required',
            ]);

            $month=$request->salary_month;

            $check=Salary::where('employee_id',$id)->where('salary_month',$month)->first();
            if ($check) {
                return response()->json('salary already paid');
            }else{

                // $date=date('d/m/Y');
                // $year=date('Y');

                Salary::create([   
                    'employee_id'  => $id,
                    'amount'       => $request->salary,
                    'salary_date'  =>date('d/m/Y'),
                    'salary_month' => $month,
                    'salary_year'  => date('Y'),
                


                ]);
            
            }
        }
    

    public function AllSalary()
    {
    	$salary=Salary::select('salary_month')->groupBy('salary_month')->get();
    	return response()->json($salary);
    }

    // public function ViewSalary($id)
    // {
    // 	$month=$id;
    // 	$view=DB::table('salaries')
	//     	->join('employees','salaries.employee_id','employees.id')
	//     	->select('employees.name','salaries.*')
	//     	->where('salaries.salary_month',$month)
	//     	->get();
	//     return response()->json($view);	
    // }
    // public function EditSalary($id)
    // {
    // 	$view=DB::table('salaries')
	//     	->join('employees','salaries.employee_id','employees.id')
	//     	->select('employees.name','employees.email','salaries.*')
	//     	->where('salaries.id',$id)
	//     	->first();
	//     return response()->json($view);	
    // }

    // public function SalaryUpdate(Request $request,$id)
    // {
    // 	     $data=array();
	//     	 $data['employee_id']=$request->employee_id;
	//     	 $data['amount']=$request->amount;
	//     	 $data['salary_month']=$request->salary_month;
	//     	 DB::table('salaries')->where('id',$id)->update($data);
    // }

    // public function StockUpdate(Request $request,$id)
    // {
    // 	$validatedData = $request->validate([
    //      'product_quantity' => 'required',
    //     ]);
    // 	$data=array();
    // 	$data['product_quantity']=$request->product_quantity;
    // 	DB::table('products')->where('id',$id)->update($data);
    // }
}
