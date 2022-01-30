<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expenses;


class ExpensesController extends Controller
{
    
    public function index()
    {
        $expense=Expenses::orderBy('id','DESC')->get();

      
        return response()->json($expense);
    }

   
    public function store(Request $request)
    {

         $request->validate([
            'details' => 'required|max:255',
            'amount'=> 'required'
           ]);

           $date=date('d/m/Y');

           Expenses::create([   
            'details'   => $request->details,  
            'amount'   => $request->amount,
            'expenses_date' => $date,

          

        ]);
    }

   
    public function show($id)
    {
        $expense=Expenses::findorfail($id);

        
        return response()->json($expense);
    }

   


   
    public function update(Request $request, $id)
    {
        $request->validate([
            'details' => 'required|max:255',
            'amount'=> 'required'
           ]);
        Expenses::findOrFail($id)->update([
            'details'   => $request->details,  
            'amount'   => $request->amount,
           
        ]);
    }

  
    public function destroy($id)
    {
        Expenses::find($id)->delete();

    }
}
