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

        if ($request->has('year')) {
            $query->whereYear('created_at', $request->year);
        }

        if ($request->has('month')) {
            $query->whereMonth('created_at', $request->month);
        }

        $salaries = $query->orderBy('id', 'desc')->paginate(10);

        return view('salaries.index', compact('salaries'));
    }
}
