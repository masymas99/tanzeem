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
    /**
     * عند إضافة بيانات الحضور
     */
    public function created(Attendance $attendance)
    {
        Log::info("تم تسجيل حضور للموظف: " . $attendance->employee_id);
        $this->calculateSalary($attendance->employee_id);
    }

    /**
     * عند تحديث بيانات الحضور
     */
    public function updated(Attendance $attendance)
    {
        Log::info("تم تحديث الحضور للموظف: " . $attendance->employee_id);
        $this->calculateSalary($attendance->employee_id);
    }

    /**
     * عند حذف بيانات الحضور
     */
    public function deleted(Attendance $attendance)
    {
        Log::info("تم حذف سجل حضور للموظف: " . $attendance->employee_id);
        $this->calculateSalary($attendance->employee_id);
    }

    /**
     * حساب الراتب بناءً على الحضور والغياب
     */
    public function calculateSalary($employee_id)
    {
        // جلب بيانات الموظف
        $employee = Employee::find($employee_id);
        if (!$employee) {
            Log::error("لم يتم العثور على الموظف ID: " . $employee_id);
            return;
        }

        // جلب أو إنشاء سجل الراتب للموظف
        $salary = Salary::firstOrNew(['employee_id' => $employee_id]);
        $salary->salary = $employee->salary ?? 0;

        Log::info("حساب الراتب للموظف: " . $employee->name);

        // حساب عدد أيام الشهر
        $total_days_in_month = Carbon::now()->daysInMonth;

        // حساب عدد أيام الحضور والغياب
        $attendance_days = Attendance::where('employee_id', $employee_id)
                                     ->whereMonth('date', now()->month)
                                     ->count();

        $absence_days = $total_days_in_month - $attendance_days;

        // حساب ساعات الإضافي والخصم مع التأكد من أنها لا تكون NULL
        $overtime_hours = Attendance::where('employee_id', $employee_id)
            ->whereMonth('date', now()->month)
            ->sum(DB::raw("IFNULL(GREATEST(TIME_TO_SEC(TIMEDIFF(check_out_time, '16:00:00')) / 3600, 0), 0)"));

        $deduction_hours = Attendance::where('employee_id', $employee_id)
            ->whereMonth('date', now()->month)
            ->sum(DB::raw("IFNULL(GREATEST(TIME_TO_SEC(TIMEDIFF('09:00:00', check_in_time)) / 3600, 0), 0)"));

        // تحديد القيم المالية للإضافي والخصومات
        $overtime_rate = 50;  // كل ساعة إضافي بـ 50 جنيه
        $deduction_rate = 30;  // كل ساعة تأخير يخصم 30 جنيه
        $absence_penalty = 400; // كل يوم غياب يخصم 400 جنيه

        // حساب إجمالي الإضافي والخصم
        $total_overtime = max($overtime_hours * $overtime_rate, 0);
        $total_deduction = max(($deduction_hours * $deduction_rate) + ($absence_days * $absence_penalty), 0);

        // حساب الراتب الصافي
        $net_salary = max(($employee->salary + $total_overtime) - $total_deduction, 0);

        // تحديث بيانات الراتب
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
