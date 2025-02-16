<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AttenndanceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OfficialHolidayController;
use App\Http\Controllers\ProfileController;
<<<<<<< HEAD
use App\Http\Controllers\SalaryController;
=======
>>>>>>> 1a5b09c (Setting and WeeklyHoliday Done)
use App\Http\Controllers\SettingController;
use App\Http\Controllers\WeeklyHolidayController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::resource('employees', EmployeeController::class);
// route::get('employees/', [EmployeeController::class, 'index'])->name('employees.index');
// route::get('employees/create', [EmployeeController::class, 'create'])->name('employees.create');

<<<<<<< HEAD
// route::post('employees/create', [EmployeeController::class, 'store'])->name('employees.store');

=======
>>>>>>> 1a5b09c (Setting and WeeklyHoliday Done)
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



    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::get('/settings/create', [SettingController::class, 'create'])->name('settings.create');
    Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');
    Route::get('/settings/{setting}/edit', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings/{setting}', [SettingController::class, 'update'])->name('settings.update');
    Route::delete('/settings/{setting}', [SettingController::class, 'destroy'])->name('settings.destroy');



    Route::get('/weekly-holidays', [WeeklyHolidayController::class, 'index'])->name('weeklyHolidays.index');
    Route::get('/weekly-holidays/create', [WeeklyHolidayController::class, 'create'])->name('weeklyHolidays.create');
    Route::get('/weeklyHolidays/{weeklyHoliday}/edit', [WeeklyHolidayController::class, 'edit'])->name('weeklyHolidays.edit');
    Route::put('/weeklyHolidays/{weeklyHoliday}', [WeeklyHolidayController::class, 'update'])->name('weeklyHolidays.update');
    Route::post('/weekly-holidays', [WeeklyHolidayController::class, 'store'])->name('weeklyHolidays.store');
    Route::delete('/weekly-holidays/{weeklyHoliday}', [WeeklyHolidayController::class, 'destroy'])->name('weeklyHolidays.destroy');


    // Route::resource('settings', SettingController::class);
    // Route::resource('weeklyHoliday', SettingController::class);
    Route::resource('employees', EmployeeController::class);
<<<<<<< HEAD


});

=======
   });

>>>>>>> 1a5b09c (Setting and WeeklyHoliday Done)
require __DIR__ . '/auth.php';
