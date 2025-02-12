<?php
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalaryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\HolidayController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('employees.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

   
    Route::put('/salaries/{id}/update', [SalaryController::class, 'update'])->name('salaries.update');


    Route::get('/salaries', [SalaryController::class, 'index'])->name('salaries.index');
    Route::get('/salaries/{id}/edit', [SalaryController::class, 'edit'])->name('salaries.edit');
    Route::post('/salaries/{id}/update', [SalaryController::class, 'update'])->name('salaries.update');
    Route::get('/salaries/{id}/print', [SalaryController::class, 'print'])->name('salaries.print');
    Route::resource('employees', EmployeeController::class);

    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');
    Route::put('/attendance/{id}', [AttendanceController::class, 'update'])->name('attendance.update');
    Route::delete('/attendance/{id}', [AttendanceController::class, 'destroy'])->name('attendance.destroy');
    // راوتس الاجازات
Route::get('/holidays', [HolidayController::class, 'index'])->name('holidays.index');
Route::get('/holidays/{id}/edit', [HolidayController::class, 'edit'])->name('holidays.edit');
Route::put('/holidays/{id}', [HolidayController::class, 'update'])->name('holidays.update');
Route::post('/holidays', [HolidayController::class, 'store'])->name('holidays.store');
Route::delete('/holidays/{id}', [HolidayController::class, 'destroy'])->name('holidays.destroy'); // تمت إضافة هذا السطر
});

require __DIR__.'/auth.php';
