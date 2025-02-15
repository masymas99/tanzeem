<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salary;
use App\Models\Employee;

class SalaryController extends Controller
{
    public function index(Request $request)
    {
        $query = Salary::with('employee');
    
        // فلتر السنه
        if ($request->has('year') && $request->year != '') {
            $query->whereYear('created_at', $request->year);
        }
    
        // فلتر الشهر
        if ($request->has('month') && $request->month != '') {
            $query->whereMonth('created_at', $request->month);
        }
    
        // فلتر موظف
        if ($request->has('search') && $request->search != '') {
            $query->whereHas('employee', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }
        if ($request->has('employee_id') && $request->employee_id != '') {
            $query->where('employee_id', $request->employee_id);
        }
    
        $salaries = $query->orderBy('id', 'desc')->paginate(10);
        $employeeNames = Employee::orderBy('name')->pluck('name', 'id');

        return view('salaries.index', compact('salaries', 'employeeNames'));
       

    }
    public function edit($id)
    {
        $salary = Salary::findOrFail($id);
        return view('salaries.edit', compact('salary'));
    }

 
    public function update(Request $request, $id)
{
    $salary = Salary::findOrFail($id);
    
    $salary->update($request->all());

    return redirect()->route('salaries.index')->with('success', 'تم تعديل المرتب بنجاح');
}


  
    public function print($id)
    {
        $salary = Salary::with('employee')->findOrFail($id);
        return view('salaries.print', compact('salary'));
    }
}
