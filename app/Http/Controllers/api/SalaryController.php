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
    	$salary=Salary::select('salary_month','salary_year')->groupBy('salary_month','salary_year')->get();
      
    	return response()->json($salary);
    }

    public function viewmonthSalary($id)
    {
    	$month=$id;
        $salary_month=Salary::with('employee')->where('salary_month',$month)->get();

        // dd($view);

    	// $view=DB::table('salaries')
	    // 	->join('employees','salaries.employee_id','employees.id')
	    // 	->select('employees.name','salaries.*')
	    // 	->where('salaries.salary_month',$month)
	    // 	->get();
	     return response()->json($salary_month);	
    }
    public function EditSalary($id)
    {
    	

        $salary_month=Salary::with('employee')->where('id',$id)->first();
        
	    return response()->json($salary_month);	
    }

    public function SalaryUpdate(Request $request,$id)
    {
        $validatedData = $request->validate([
            'salary_month' => 'required',
            ]);


        Salary::findOrFail($id)->update([
            'amount' => $request->amount,
            'salary_month' => $request->salary_month,
           
            
        ]);
    	   


    }

 
}
