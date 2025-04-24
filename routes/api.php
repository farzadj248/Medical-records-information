<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MedicalRecordController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/document',[MedicalRecordController::class,'geInformation']);
Route::post('/document',[MedicalRecordController::class,'updateInformati']);
Route::post('/document/uploadFile',[MedicalRecordController::class,'uploadFile']);
Route::delete('/document/file/{id}/delete',[MedicalRecordController::class,'deleteFile']);
