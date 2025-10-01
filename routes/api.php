<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PartnerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/partners', [PartnerController::class, 'index']);
    Route::get('/partners/{id}', [PartnerController::class, 'show']);

    Route::get('/clinics', [ClinicController::class, 'index']);

    Route::get('/doctors', [DoctorController::class, 'index']);
    Route::post('/doctors', [DoctorController::class, 'store']);
    Route::put('/doctors/{id}', [DoctorController::class, 'update']);

    Route::post('/logout', [AuthController::class, 'logout']);
});
