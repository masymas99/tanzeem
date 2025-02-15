<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
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

// route::post('employees/create', [EmployeeController::class, 'store'])->name('employees.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('employees', EmployeeController::class);

});

require __DIR__.'/auth.php';
