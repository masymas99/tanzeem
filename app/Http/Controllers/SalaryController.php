<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salary;
use App\Models\Employee;
use App\Models\Setting;
use App\Models\Attendance;
use App\Models\OfficialHoliday;
use App\Models\WeeklyHoliday;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class SalaryController extends Controller
{
    public function index(Request $request)
    {
        $query = Salary::with('employee')
            ->when($request->year, function($q) use ($request) {
                return $q->where('year', $request->year);
            })
            ->when($request->month, function($q) use ($request) {
                return $q->where('month', $request->month);
            })
            ->when($request->employee_id, function($q) use ($request) {
                return $q->where('employee_id', $request->employee_id);
            })
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc');
        $salaries = $query->paginate(10);
        $employeeNames = Employee::orderBy('name')->pluck('name', 'id');
    
        return view('salaries.index', compact('salaries', 'employeeNames'));
    }


    public function calculateSalaries(Request $request)
    {
        // بتحدد السنه
        $year = $request->input('year', now()->year);

        // بتحدد الشهر
        $months = Attendance::whereYear('date', $year)
            ->selectRaw('MONTH(date) as month')
            ->distinct()
            
            ->pluck('month');
          
          

        if ($months->isEmpty()) {
            return response()->json(['error' => 'لا توجد بيانات حضور لهذه السنة'], 400);
        }

        //بيحسب  مرتب كل شهر 
        foreach ($months as $currentMonth) {
            $this->calculateSalariesForMonth($currentMonth, $year);
        }

        return response()->json(['message' => 'تم حساب المرتبات للأشهر التي بها بيانات حضور بنجاح']);
    }

    // بيحسب مرتب شهر وسنه محدد
    protected function calculateSalariesForMonth($currentMonth, $currentYear)
    {
        $employees = Employee::all();
        $settings = Setting::first();

        if (!$settings) {
            Log::error('لم يتم العثور على إعدادات الرواتب!');
            return;
        }

        // التاكد من صحة التاريخ
        if (!checkdate($currentMonth, 1, $currentYear)) {
            Log::error('تاريخ غير صالح!', ['month' => $currentMonth, 'year' => $currentYear]);
            return;
        }

        $daysInMonth = Carbon::create($currentYear, $currentMonth)->daysInMonth;

        // حساب  الإجازات الأسبوعية
        $weeklyHolidays = WeeklyHoliday::pluck('day')->toArray();
        $totalWeeklyHolidays = 0;
        $startDate = Carbon::create($currentYear, $currentMonth, 1)->startOfMonth();
        $endDate = Carbon::create($currentYear, $currentMonth, 1)->endOfMonth();

        // التأكد من استخدام نسخة من التاريخ لتجنب التلاعب على نفس الكائن
        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            if (in_array(strtolower($date->format('l')), $weeklyHolidays)) {
                $totalWeeklyHolidays++;
            }
        }

        // حساب  الإجازات الرسمية
        $officialHolidays = OfficialHoliday::whereMonth('date', $currentMonth)
            ->whereYear('date', $currentYear)
            ->count();

        $totalWorkingDays = $daysInMonth - $totalWeeklyHolidays - $officialHolidays;

        foreach ($employees as $employee) {
            // حساب الحضور للموظف في الشهر المحدد
            $attendances = Attendance::where('employee_id', $employee->id)
                ->whereMonth('date', $currentMonth)
                ->whereYear('date', $currentYear)
                ->get();

            $totalAttendance = $attendances->count();
            $totalAbsence = max(($totalWorkingDays - $totalAttendance), 0);


            $overtimeMinutes = 0;
            $deductionMinutes = 0;

            foreach ($attendances as $attendance) {
                $officialStartTime = Carbon::parse($employee->work_start_time);
                $officialEndTime = Carbon::parse($employee->work_end_time);
                $checkInTime = Carbon::parse($attendance->check_in_time);
                $checkOutTime = Carbon::parse($attendance->check_out_time);

                // حساب التأخير
                if ($checkInTime->gt($officialStartTime)) {
                    $deductionMinutes += $officialStartTime->diffInMinutes($checkInTime);
                }

                // حساب الانصراف المبكر
                if ($checkOutTime->lt($officialEndTime)) {
                    $deductionMinutes += $officialEndTime->diffInMinutes($checkOutTime);
                }

                // حساب الوقت الإضافي
                if ($checkOutTime->gt($officialEndTime)) {
                    $overtimeMinutes += $officialEndTime->diffInMinutes($checkOutTime);
                }
            }

            $overtimeHours = round($overtimeMinutes / 60, 2);
            $deductionHours = round($deductionMinutes / 60, 2);

            $overtimeAmount = round($overtimeHours * $settings->addH, 2);
            $deductionAmount = round(($deductionHours * $settings->desH) + ($totalAbsence * ($employee->salary / $totalWorkingDays)), 2);

            $netSalary = max(round($employee->salary + $overtimeAmount - $deductionAmount, 2), 0);

           
            Salary::updateOrCreate(
                [
                    'employee_id' => $employee->id,
                    'month' => $currentMonth,
                    'year' => $currentYear
                ],
                [
                    'salary' => $employee->salary,
                    'total_attendance' => $totalAttendance,
                    'total_absence' => $totalAbsence,
                    'total_overtime_hours' => $overtimeHours,
                    'total_deduction_hours' => $deductionHours,
                    'total_overtime' => $overtimeAmount,
                    'total_deduction' => $deductionAmount,
                    'net_salary' => $netSalary
                ]
            );
        }
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
