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
Route::prefix('patients')->group(function () {
    Route::get('/', [PatientController::class, 'index']);
    Route::get('/{patient}', [PatientController::class, 'show']);
    Route::post('/', [PatientController::class, 'store']);
    Route::put('/{patient}', [PatientController::class, 'update']);
    Route::delete('/{patient}', [PatientController::class, 'destroy']);
});