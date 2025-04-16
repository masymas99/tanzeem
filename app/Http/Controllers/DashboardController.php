<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Salary;
use App\Models\Attendance;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // جلب جميع بيانات الموظفين
        $employees = \App\Models\Employee::all();
        
        // حساب مجموع الرواتب الأساسية
        $basicSalaries = $employees->sum('salary');
        
        // حساب مجموع الرواتب الإجمالية
        $totalSalaries = $employees->sum('total_salary');
        
        // تجهيز البيانات للعرض
        $stats = [
            'basicSalaries' => $basicSalaries,
            'totalSalaries' => $totalSalaries,
        ];

        // Get current month and year
        $currentMonth = now()->month;
        $currentYear = now()->year;

        // Basic Statistics
        $stats = [
            'basicSalaries' => $basicSalaries,
            'totalSalaries' => $totalSalaries,
            'totalEmployees' => Employee::count(),
            'totalSalaries' => Salary::sum('salary'),
            'yearlySalaries' => Salary::where('year', $currentYear)
                                ->sum('salary'),
            'totalDeductions' => Salary::sum('total_deduction'),
            'yearlyDeductions' => Salary::where('year', $currentYear)
                                ->sum('total_deduction'),
            'netSalary' => Salary::where('year', $currentYear)
                                ->sum('net_salary'),
            // Monthly Attendance Statistics (using salaries table)
            'mostPresent' => Salary::select('employee_id', 
                \DB::raw('total_attendance as attendance_count'))
                ->where('month', now()->month)
                ->where('year', now()->year)
                ->orderByDesc('total_attendance')
                ->first(),
            'mostAbsent' => Salary::select('employee_id', 
                \DB::raw('total_absence as absence_count'))
                ->where('month', now()->month)
                ->where('year', now()->year)
                ->orderByDesc('total_absence')
                ->first(),
            // Monthly Salary Statistics
            'totalDeductions' => Salary::where('month', now()->month)
                                ->where('year', now()->year)
                                ->sum('total_deduction'),
            'totalOvertime' => Salary::where('month', now()->month)
                                ->where('year', now()->year)
                                ->sum('total_overtime'),
            'totalSalaries' => Salary::where('month', now()->month)
                                ->where('year', now()->year)
                                ->sum('salary'),
            'netSalary' => Salary::where('month', now()->month)
                                ->where('year', now()->year)
                                ->sum('net_salary'),
            // Calculate attendance statistics based on check-in times
            'lateCount' => Attendance::whereDate('date', now())
                                    ->where('check_in_time', '>', '09:00:00')
                                    ->whereNotNull('check_in_time')
                                    ->count(),
            'absentCount' => Attendance::whereDate('date', now())
                                     ->whereNull('check_in_time')
                                     ->count(),
            'presentCount' => Attendance::whereDate('date', now())
                                      ->where('check_in_time', '<=', '09:00:00')
                                      ->whereNotNull('check_in_time')
                                      ->count()
        ];

        // Salary Distribution Chart Data
        $salaryDistribution = [
            'labels' => ['مرتب أساسي', 'الخصومات', 'ساعات الإضافية', 'صافي الراتب'],
            'data' => [
                $stats['totalSalaries'],
                $stats['totalDeductions'],
                $stats['totalOvertime'],
                $stats['netSalary']
            ],
            'backgroundColor' => [
                'rgb(54, 162, 235)',
                'rgb(255, 99, 132)',
                'rgb(75, 192, 192)',
                'rgb(255, 205, 86)'
            ]
        ];

        // Attendance Chart Data
        $attendanceChart = [
            'labels' => ['حضور', 'غياب', 'تأخير'],
            'data' => [
                $stats['presentCount'],
                $stats['absentCount'],
                $stats['lateCount']
            ],
            'backgroundColor' => [
                'rgb(75, 192, 192)',
                'rgb(255, 99, 132)',
                'rgb(255, 205, 86)'
            ]
        ];

        // Monthly Attendance Stats
        $monthlyAttendance = Attendance::select(
            \DB::raw("CASE 
                WHEN check_in_time IS NULL THEN 'absent'
                WHEN check_in_time > '09:00:00' THEN 'late'
                ELSE 'present'
            END as status"),
            \DB::raw('COUNT(*) as count'),
            \DB::raw('MONTH(date) as month')
        )
        ->whereYear('date', $currentYear)
        ->groupBy('status', 'month')
        ->get()
        ->groupBy('month');

        return view('dashboard', compact('stats', 'salaryDistribution', 'attendanceChart', 'monthlyAttendance'));
    }
}
