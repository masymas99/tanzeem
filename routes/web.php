<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HolidayController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('employees', EmployeeController::class);
});

// راوتس الاجازات
Route::get('/holidays', [HolidayController::class, 'index'])->name('holidays.index');
Route::get('/holidays/{id}/edit', [HolidayController::class, 'edit'])->name('holidays.edit');
Route::put('/holidays/{id}', [HolidayController::class, 'update'])->name('holidays.update');
Route::post('/holidays', [HolidayController::class, 'store'])->name('holidays.store');
Route::delete('/holidays/{id}', [HolidayController::class, 'destroy'])->name('holidays.destroy'); // تمت إضافة هذا السطر

require __DIR__.'/auth.php';
