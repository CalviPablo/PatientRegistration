<?php

use App\Http\Controllers\PatientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Patients routes
Route::get('/patients', [PatientController::class, 'index']);
Route::get('/patients/{patient}', [PatientController::class, 'show']);
Route::post('/patients', [PatientController::class,'store']);
Route::put('/patients/{patient}', [PatientController::class,'update']);
Route::delete('/patients/{patient}', [PatientController::class,'destroy']);