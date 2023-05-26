<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'employees'], function () {
    Route::get('/',[EmployeeController::class,'employeeIndex'])->name('employees.index');
    Route::get('/edit/{id?}', [EmployeeController::class, 'getEmployee'])->name('employee.edit');
    Route::get('/get_employees',[EmployeeController::class,'getEmployees'])->name('employees.get');
    Route::post('/store',[EmployeeController::class,'store'])->name('employee.store');
    Route::delete('/delete/{id?}',[EmployeeController::class,'delete'])->name('employee.delete');
});