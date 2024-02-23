<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebStudentController;

// Display a listing of students
Route::get('students', [WebStudentController::class, 'index'])->name('students.index');

// Show form for creating a new student
Route::get('students/create', [WebStudentController::class, 'create'])->name('students.create'); 

// Handle student creation (receives POST data)
Route::post('students', [WebStudentController::class, 'store'])->name('students.store');

// Display a single student
Route::get('students/{student}', [WebStudentController::class, 'show'])->name('students.show');

// Show form for editing a student
Route::get('students/{student}/edit', [WebStudentController::class, 'edit'])->name('students.edit');

// Handle updating a student (receives PUT/PATCH data)
Route::put('students/{student}', [WebStudentController::class, 'update'])->name('students.update');

// Handle deleting a student
Route::delete('students/{student}', [WebStudentController::class, 'destroy'])->name('students.destroy');
