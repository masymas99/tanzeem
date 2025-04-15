<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;


class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::paginate(5);
        return view('employee.index', compact('employees'));
    }

    public function create()
    {
        return view('employee.create');
    }

public function store(Request $request)
{
    try {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required|numeric|digits:11',
            'address' => 'required|string|max:500',
            'gender' => 'required|in:male,female',
            'dob' => 'required|date|before:-18 years',
            'nationality' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'nid_number' => 'required|numeric|digits:14|unique:employees,nid_number',
            'joining_date' => 'required|date|after_or_equal:dob',
            'salary' => 'required|numeric|min:3000|max:50000',
            'work_start_time' => 'required|date_format:H:i',
            'work_end_time' => 'required|date_format:H:i|after:work_start_time',
        ], [
            'dob.before' => 'يجب أن يكون عمر الموظف 18 عامًا على الأقل',
            'nid_number.unique' => 'رقم البطاقة الوطنية مسجل مسبقًا',
            'email.unique' => 'البريد الإلكتروني مسجل مسبقًا'
        ]);

        $employee = new Employee([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'address' => $request->get('address'),
            'gender' => $request->get('gender'),
            'dob' => $request->get('dob'),
            'nationality' => $request->get('nationality'),
            'position' => $request->get('position'),
            'nid_number' => $request->get('nid_number'),
            'joining_date' => $request->get('joining_date'),
            'salary' => $request->get('salary'),
            'work_start_time' => $request->get('work_start_time'),
            'work_end_time' => $request->get('work_end_time'),
        ]);

        $employee->save();

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');

    } catch (ValidationException $e) {
        return back()->withErrors($e->errors())->withInput();
    }




}
public function show($id)
{
    $employee = Employee::find($id);
    return view('employee.show', compact('employee'));
}
public function edit(Employee $employee)
{
    return view('employee.edit', compact('employee'));

}

public function update(Request $request, Employee $employee)
{

    $validated=$request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:employees,email,'.$employee->id,
        'phone' => 'required|numeric|digits:11',
        'address' => 'required',
        'gender' => 'required',
        'dob' => 'required|date',
        'nationality' => 'required',
        'position' => 'required',
        'nid_number' => 'required|numeric|digits:14|unique:employees,nid_number,'.$employee->id,
        'joining_date' => 'required|date',
        'salary' => 'required|numeric',
        'work_start_time' => 'required',
        'work_end_time' => 'required',
    ]);

    $employee->update([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'phone' => $validated['phone'],
        'address' => $validated['address'],
        'gender' => $validated['gender'],
        'dob' => $validated['dob'],
        'nationality' => $validated['nationality'],
        'position' => $validated['position'],
        'nid_number' => $validated['nid_number'],
        'joining_date' => $validated['joining_date'],
        'salary' => $validated['salary'],
        'work_start_time' => $validated['work_start_time'],
        'work_end_time' => $validated['work_end_time'],
    ]);

    return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');

}
public function destroy($id)
{
    $employee = Employee::find($id);
    if ($employee) {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
    return redirect()->route('employees.index')->with('error', 'Employee not found.');
    }
}

