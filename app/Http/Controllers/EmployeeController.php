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
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required|numeric|digits:11',
            'address' => 'required',
            'gender' => 'required|in:male,female',
            'dob' => 'required|date|before:-18 years',
            'nationality' => 'required',
            'position' => 'required',
            'nid_number' => 'required|numeric|digits:14|unique:employees,nid_number',
            'joining_date' => 'required|date|after_or_equal:dob',
            'salary' => 'required|numeric|min:3000|max:50000',
            'work_start_time' => 'required|date_format:H:i',
            'work_end_time' => 'required|date_format:H:i|after:work_start_time',
        ], [
            'name.required' => 'الاسم مطلوب',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'يجب أن يكون البريد الإلكتروني صحيحاً',
            'email.unique' => 'هذا البريد الإلكتروني مستخدم بالفعل',
            'phone.required' => 'رقم الهاتف مطلوب',
            'phone.numeric' => 'يجب أن يكون رقم الهاتف أرقام فقط',
            'phone.digits' => 'يجب أن يكون رقم الهاتف مكوناً من 11 رقم',
            'address.required' => 'العنوان مطلوب',
            'gender.required' => 'النوع مطلوب',
            'gender.in' => 'النوع يجب أن يكون ذكر أو أنثى',
            'dob.required' => 'تاريخ الميلاد مطلوب',
            'dob.before' => 'يجب أن يكون عمر الموظف 18 عاماً على الأقل',
            'nationality.required' => 'الجنسية مطلوبة',
            'position.required' => 'الوظيفة مطلوبة',
            'nid_number.required' => 'رقم البطاقة مطلوب',
            'nid_number.numeric' => 'يجب أن يكون رقم البطاقة أرقام فقط',
            'nid_number.digits' => 'يجب أن يكون رقم البطاقة مكوناً من 14 رقم',
            'nid_number.unique' => 'هذا رقم البطاقة مستخدم بالفعل',
            'joining_date.required' => 'تاريخ التعاقد مطلوب',
            'joining_date.after_or_equal' => 'تاريخ التعاقد يجب أن يكون بعد تاريخ الميلاد',
            'salary.required' => 'الراتب مطلوب',
            'salary.numeric' => 'يجب أن يكون الراتب رقم',
            'salary.min' => 'الحد الأدنى للراتب هو 3000 جنيه',
            'salary.max' => 'الحد الأقصى للراتب هو 50000 جنيه',
            'work_start_time.required' => 'وقت بداية العمل مطلوب',
            'work_end_time.required' => 'وقت نهاية العمل مطلوب',
            'work_end_time.after' => 'وقت نهاية العمل يجب أن يكون بعد وقت بداية العمل'
        ]);

        Employee::create($validated);

        return redirect()->route('employees.create')->with('success', 'تم إضافة الموظف بنجاح');
    }

    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employee.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        return view('employee.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'phone' => 'required|numeric|digits:11',
            'address' => 'required',
            'gender' => 'required|in:male,female',
            'dob' => 'required|date|before:-18 years',
            'nationality' => 'required',
            'position' => 'required',
            'nid_number' => 'required|numeric|digits:14|unique:employees,nid_number,' . $employee->id,
            'joining_date' => 'required|date|after_or_equal:dob',
            'salary' => 'required|numeric|min:3000|max:50000',
            'work_start_time' => 'required|date_format:H:i',
            'work_end_time' => 'required|date_format:H:i|after:work_start_time',
        ], [
            'name.required' => 'الاسم مطلوب',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'يجب أن يكون البريد الإلكتروني صحيحاً',
            'email.unique' => 'هذا البريد الإلكتروني مستخدم بالفعل',
            'phone.required' => 'رقم الهاتف مطلوب',
            'phone.numeric' => 'يجب أن يكون رقم الهاتف أرقام فقط',
            'phone.digits' => 'يجب أن يكون رقم الهاتف مكوناً من 11 رقم',
            'address.required' => 'العنوان مطلوب',
            'gender.required' => 'النوع مطلوب',
            'gender.in' => 'النوع يجب أن يكون ذكر أو أنثى',
            'dob.required' => 'تاريخ الميلاد مطلوب',
            'dob.before' => 'يجب أن يكون عمر الموظف 18 عاماً على الأقل',
            'nationality.required' => 'الجنسية مطلوبة',
            'position.required' => 'الوظيفة مطلوبة',
            'nid_number.required' => 'رقم البطاقة مطلوب',
            'nid_number.numeric' => 'يجب أن يكون رقم البطاقة أرقام فقط',
            'nid_number.digits' => 'يجب أن يكون رقم البطاقة مكوناً من 14 رقم',
            'nid_number.unique' => 'هذا رقم البطاقة مستخدم بالفعل',
            'joining_date.required' => 'تاريخ التعاقد مطلوب',
            'joining_date.after_or_equal' => 'تاريخ التعاقد يجب أن يكون بعد تاريخ الميلاد',
            'salary.required' => 'الراتب مطلوب',
            'salary.numeric' => 'يجب أن يكون الراتب رقم',
            'salary.min' => 'الحد الأدنى للراتب هو 3000 جنيه',
            'salary.max' => 'الحد الأقصى للراتب هو 50000 جنيه',
            'work_start_time.required' => 'وقت بداية العمل مطلوب',
            'work_end_time.required' => 'وقت نهاية العمل مطلوب',
            'work_end_time.after' => 'وقت نهاية العمل يجب أن يكون بعد وقت بداية العمل'
        ]);

        $employee->update($validated);

        return redirect()->route('employees.index')->with('success', 'تم تحديث بيانات الموظف بنجاح');
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'تم حذف الموظف بنجاح');
    }


}