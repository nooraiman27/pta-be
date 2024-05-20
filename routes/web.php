<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// php artisan route:list
// Route::resource('student', StudentController::class);
// is same with
Route::get('student', [StudentController::class, 'index'])->name('student.index');
Route::get('student/create', [StudentController::class, 'create'])->name('student.create');
Route::post('student', [StudentController::class, 'store'])->name('student.store');
// Route::get('students/{student}', [StudentController::class, 'show'])->name('students.show');
Route::get('student/{student}/edit', [StudentController::class, 'edit'])->name('student.edit');
Route::put('student/{student}', [StudentController::class, 'update'])->name('student.update');
Route::delete('student/{student}', [StudentController::class, 'destroy'])->name('student.destroy');

Route::get('student/datatable', [StudentController::class, 'datatable'])->name('student.datatable');

Route::post('student/bulkDelete', [StudentController::class, 'bulkDelete'])->name('student.bulk-delete');

Route::get('/jquery', function () {
    return view('jquery');
});
