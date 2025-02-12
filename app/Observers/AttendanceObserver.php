<?php

namespace App\Observers;

use App\Models\Attendance;
use App\Models\Salary;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AttendanceObserver
{
    public function created(Attendance $attendance)
    {
        Log::info("تم تسجيل حضور للموظف: " . $attendance->employee_id);
        $this->calculateSalary($attendance->employee_id);
    }

    
    public function updated(Attendance $attendance)
    {
        Log::info("تم تحديث الحضور للموظف: " . $attendance->employee_id);
        $this->calculateSalary($attendance->employee_id);
    }

    
    public function deleted(Attendance $attendance)
    {
        Log::info("تم حذف سجل حضور للموظف: " . $attendance->employee_id);
        $this->calculateSalary($attendance->employee_id);
    }

    public function calculateSalary($employee_id)
{
    $employee = Employee::find($employee_id);
    if (!$employee) {
        Log::error("لم يتم العثور على الموظف ID: " . $employee_id);
        return;
    }

    $salary = Salary::firstOrNew(['employee_id' => $employee_id]);
    $salary->salary = $employee->salary ?? 0;

    Log::info("حساب الراتب للموظف: " . $employee->name);

    
    $currentDate = Carbon::now();
    $total_days_in_month = $currentDate->daysInMonth;
    $year = $currentDate->year;
    $month = $currentDate->month;

    
    $fridayCount = 0;
    for ($day = 1; $day <= $total_days_in_month; $day++) {
        $date = Carbon::create($year, $month, $day);
        if ($date->isFriday()) {
            $fridayCount++;
        }
    }

   
    $total_working_days = $total_days_in_month - $fridayCount;

    
    $attendance_days = Attendance::where('employee_id', $employee_id)
        ->whereMonth('date', $month)
        ->count();

    
    $absence_days = $total_working_days - $attendance_days;

   
    $overtime_hours = Attendance::where('employee_id', $employee_id)
        ->whereMonth('date', $month)
        ->sum(DB::raw("IFNULL(GREATEST(TIME_TO_SEC(TIMEDIFF(check_out_time, '16:00:00')) / 3600, 0), 0)"));

    $deduction_hours = Attendance::where('employee_id', $employee_id)
        ->whereMonth('date', $month)
        ->sum(DB::raw("IFNULL(GREATEST(TIME_TO_SEC(TIMEDIFF('09:00:00', check_in_time)) / 3600, 0), 0)"));
    $overtime_rate = 50;  
    $deduction_rate = 30;  
    $absence_penalty = 400; 

    $total_overtime = max($overtime_hours * $overtime_rate, 0);
    $total_deduction = max(($deduction_hours * $deduction_rate) + ($absence_days * $absence_penalty), 0);

   
    $net_salary = max(($employee->salary + $total_overtime) - $total_deduction, 0);

    
    $salary->total_attendance = $attendance_days;
    $salary->total_absence = $absence_days;
    $salary->total_overtime_hours = $overtime_hours;
    $salary->total_deduction_hours = $deduction_hours;
    $salary->total_overtime = $total_overtime;
    $salary->total_deduction = $total_deduction;
    $salary->net_salary = $net_salary;
    $salary->save();

    Log::info("تم تحديث الراتب للموظف: " . $employee->name);
}

}
