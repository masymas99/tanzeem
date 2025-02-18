<?php

namespace App\Observers;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\SalaryController;

class AttendanceObserver
{
    public function created(Attendance $attendance)
{
    Log::info("تم تسجيل حضور للموظف: " . $attendance->employee_id);
    $request = new Request(); 
    (new SalaryController())->calculateSalaries($request);
}

public function updated(Attendance $attendance)
{
    Log::info("تم تحديث سجل حضور للموظف: " . $attendance->employee_id);
    $request = new Request();
    (new SalaryController())->calculateSalaries($request);
}

public function deleted(Attendance $attendance)
{
    Log::info("تم حذف سجل حضور للموظف: " . $attendance->employee_id);
    $request = new Request();
    (new SalaryController())->calculateSalaries($request);
}
    
}
