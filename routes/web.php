<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OfficialHolidayController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\WeeklyHolidayController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [
    \App\Http\Controllers\DashboardController::class, 'index'
])->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('employees', EmployeeController::class);
// route::get('employees/', [EmployeeController::class, 'index'])->name('employees.index');
// route::get('employees/create', [EmployeeController::class, 'create'])->name('employees.create');

// route::post('employees/create', [EmployeeController::class, 'store'])->name('employees.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('employees', EmployeeController::class);

    //  shimaa-> attendance

    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');
    Route::put('/attendance/{id}', [AttendanceController::class, 'update'])->name('attendance.update');
    Route::delete('/attendance/{id}', [AttendanceController::class, 'destroy'])->name('attendance.destroy');
    Route::get('/attendance/ai-query', [AttendanceController::class, 'showAiQuery'])->name('attendance.ai-query');

    // API routes for AI queries
    Route::post('/api/attendance/query', [AttendanceController::class, 'processAttendanceQuery']);
    Route::post('/api/attendance/leave-query', [AttendanceController::class, 'processLeaveQuery']);

    // Chat interface routes
    Route::get('/chat', [ChatController::class, 'showChat'])->name('chat');
    Route::post('/api/chat', [ChatController::class, 'processMessage']);
    Route::get('/toggle-chat', function () {
        return view('attendance.toggle-chat');
    })->name('toggle-chat');


    // mohamed-> official holiday

    Route::get('/holidays', [OfficialHolidayController::class, 'index'])->name('holidays.index');
    Route::get('/holidays/{id}/edit', [OfficialHolidayController::class, 'edit'])->name('holidays.edit');
    Route::put('/holidays/{id}', [OfficialHolidayController::class, 'update'])->name('holidays.update');
    Route::post('/holidays', [OfficialHolidayController::class, 'store'])->name('holidays.store');
    Route::delete('/holidays/{id}', [OfficialHolidayController::class, 'destroy'])->name('holidays.destroy');


    // settings routes
    Route::resource('settings', SettingController::class);

    // weekly holiday routes
    Route::resource('weeklyHolidays', WeeklyHolidayController::class);


    // salaries routes


    Route::put('/salaries/{id}/update', [SalaryController::class, 'update'])->name('salaries.update');


    Route::get('/salaries', [SalaryController::class, 'index'])->name('salaries.index');
    Route::get('/salaries/{id}/edit', [SalaryController::class, 'edit'])->name('salaries.edit');
    Route::post('/salaries/{id}/update', [SalaryController::class, 'update'])->name('salaries.update');
    Route::get('/salaries/{id}/print', [SalaryController::class, 'print'])->name('salaries.print');
    Route::post('/salaries/calculate', [SalaryController::class, 'calculateSalaries'])->name('salaries.calculate');
    Route::post('/salaries', [SalaryController::class, 'store'])->name('salaries.store');



    Route::resource('employees', EmployeeController::class);
});

require __DIR__ . '/auth.php';
