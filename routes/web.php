<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $totalEmployees = Employee::count();
    $activeEmployees = Employee::where('status', 'active')->count();
    $inactiveEmployees = Employee::where('status', 'inactive')->count();
    $departments = Department::all();
    $recentEmployees = Employee::orderBy('joining_date', 'desc')->take(5)->get();

    return view('dashboard', compact('totalEmployees', 'activeEmployees', 'inactiveEmployees', 'departments', 'recentEmployees'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // Employee Routes accessible by all authenticated users (e.g., index, show)
    Route::get('employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('employees/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('employees', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('employees/{employee}', [EmployeeController::class, 'show'])->name('employees.show');


    // Admin-specific routes
    Route::middleware(['admin'])->group(function () {
        // Employee Admin Routes (edit, update, delete)
        // Route::get('employees/create', [EmployeeController::class, 'create'])->name('employees.create'); // Moved above
        // Route::post('employees', [EmployeeController::class, 'store'])->name('employees.store'); // Moved above
        Route::get('employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
        Route::put('employees/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
        Route::delete('employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');

        // Export routes
        Route::get('/employees-export/{type}', [EmployeeController::class, 'export'])
            ->name('employees.export');

        // Department Routes
        Route::get('departments', [DepartmentController::class, 'index'])->name('departments.index');
        Route::post('departments', [DepartmentController::class, 'store'])->name('departments.store');
    });
});

require __DIR__.'/auth.php';
