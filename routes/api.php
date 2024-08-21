<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\GolonganController;
use App\Http\Controllers\EmployeeExportController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Users
Route::post('register', [UserController::class,'register']);

//Golongans
Route::get('golongan', [GolonganController::class,'index']);
Route::get('golongan/{Id}', [GolonganController::class, 'getById']);

//Jabatans
Route::get('jabatan', [JabatanController::class,'index']);
Route::get('jabatan/{Id}', [JabatanController::class,'getById']);

//Employees
Route::get('employee', [EmployeeController::class,'index']);
Route::get('employee/{Id}', [EmployeeController::class,'getById']);
Route::post('employee', [EmployeeController::class,'store']);
Route::put('employee/edit/{Id}', [EmployeeController::class,'update']);
Route::delete('employee/delete/{Id}', [EmployeeController::class,'destroy']);

//Export
Route::get('export-employees', [EmployeeExportController::class, 'export']);

//Filter
Route::get('employee-filter/{id}',[EmployeeController::class, 'filterByJabatan']);

//Search
Route::get('employee-search', [EmployeeController::class, 'search']);

